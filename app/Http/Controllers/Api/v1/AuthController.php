<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'forgot_password']]);
    }

    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $request->user(),
        ]);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = $request->user();
        $user->name = $request->name ?? '';
        $user->phone = $request->phone ?? '';
        $user->email = $request->email ?? '';
        $user->address = $request->address ?? '';
        $user->picture = $request->picture ?? '';
        $user->save();

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'Profile updated successfully',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where(function (Builder $query) use ($request) {
            $username = mb_strtolower($request->username);
            $query->where('email', $username)
                ->orWhere('phone', $username)
                ->orWhere(DB::raw('LOWER(name)'), $username);
        })
            ->withTrashed()->first();

        if ($user && $user->trashed()) {

            return response()->json([
                'status' => false,
                'message' => 'Your account has been deleted.',
            ], 403);
        }

        if ($user && $user->is_active == false) {

            return response()->json([
                'status' => false,
                'message' => 'Your account has been blocked.',
            ], 403);
        }

        if ($user && Hash::check($request->password, $user->password)) {

            return response()->json([
                'status' => true,
                'message' => 'Login successfully',
                'data' => $user,
                'token' => $user->createToken('ApiToken')->plainTextToken,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid username or password.',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = new User;
        $user->id = time();
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;
        $user->otp_code = randomNumber();
        $user->password = Hash::make($request->password);
        $user->save();

        $user = $user->find($user->id);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user,
            'token' => $user->createToken('ApiToken')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke all tokens...
        $request->user()->tokens()->delete();

        // Revoke the current token
        // $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ]);
    }

    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::query()->where('email', $request->email)->withTrashed()->first();

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Your account not found.',
            ], 404);
        }

        if ($user->trashed()) {
            return response()->json([
                'status' => false,
                'message' => 'Your account has been deleted.',
            ], 403);
        }

        if ($user && $user->blocked_at) {
            return response()->json([
                'status' => false,
                'message' => 'Your account has been blocked.',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $user,
            'token' => $user->createToken('ApiToken')->plainTextToken,
        ], 200);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = $request->user();
        $user->update([
            'otp_code' => fake()->randomNumber(),
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'otp' => 'required|string|digits:6',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('id', $request->id)
            ->where(DB::raw('SHA2(otp_code, 256)'), $request->otp)
            ->withTrashed()->first();

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Your data invalid.',
            ], 404);
        }

        if ($user->trashed()) {
            return response()->json([
                'status' => false,
                'message' => 'Your account has been deleted.',
            ], 403);
        }

        if ($user && $user->blocked_at) {
            return response()->json([
                'status' => false,
                'message' => 'Your account has been blocked.',
            ], 403);
        }

        $user->update([
            'otp_code' => randomNumber(),
            'password' => Hash::make($request->password),
        ]);

        $user = User::find($user->id);

        if ($user && Hash::check($request->password, $user->password)) {

            return response()->json([
                'status' => true,
                'message' => 'Reset password successfully',
                'data' => $user,
                'token' => $user->createToken('ApiToken')->plainTextToken,
            ]);
        }
    }

}
