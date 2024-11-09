<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Jobs\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ForgotResource;
use App\Notifications\NotifyAdminNewRegistered;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\RegisteredUserNotification;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'forgot_password']]);
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
        $user->otp_code = randomNumber();
        $user->save();

        // $this->recordActivity($request, 'updated profile');

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

        $user = User::where(function (Builder $query) {
            $username = mb_strtolower($this->string('username'));
            $query->where('email', $username)
                ->orWhere('phone', $username)
                ->orWhere(DB::raw('LOWER(name)'), $username);
        })
            ->where('is_active', true)
            ->withTrashed()->first();

        if ($user && $user->trashed()) {
            // $this->recordActivity($request, 'logined failed', $user);

            return response()->json([
                'status' => false,
                'message' => 'Your account has been deleted.',
            ], 403);
        }

        // if ($user && $user->blocked_at) {
        //     // $this->recordActivity($request, 'logined failed', $user);

        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Your account has been blocked.',
        //     ], 403);
        // }

        if ($user && Hash::check($request->password, $user->password)) {
            // $user->last_login_at = now();
            // $user->save();

            // $this->recordActivity($request, 'logined successfully', $user);

            return response()->json([
                'status' => true,
                'message' => 'Login successfully',
                'data' => $user,
                'token' => $user->createToken('ApiToken')->plainTextToken,
            ]);
        }

        // if ($user) {
        //     $this->recordActivity($request, 'logined failed', $user);
        // }

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
        $user->otp_code = $this->randomNumber();
        $user->password = Hash::make($request->password);
        $user->save();

        $user = $user->find($user->id);

        $this->recordActivity($request, 'registered new account', $user);

        // Notify to new user
        $user->notify(new RegisteredUserNotification($user, $request->password));
        // Notify to admin
        $this->admin()->notify(new NotifyAdminNewRegistered($user));

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user,
            'token' => $user->createToken('ApiToken')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $this->recordActivity($request, 'logged out');

        Auth::user()->tokens()->delete();

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

        $otp_code = fake()->randomNumber();

        $user->update(['otp_code' => $otp_code]);

        // $this->recordActivity($request, 'forgot password', $user);

        dispatch(new VerifyEmail($user->name, $otp_code))->delay(now()->addMinutes(1));

        // Mail::send('mail.verify', ['name' => $user->name, 'otp' => $otp_code], function ($message) {
        //     $message->sender('no-reply@asianinventory.com', 'Asian Inventory');
        //     $message->to($user->email, $user->name);
        //     $message->subject('Please verify your account');
        //     $message->priority(3);
        // });

        return response()->json([
            'status' => true,
            'data' => new ForgotResource($user),
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

        $this->recordActivity($request, 'changed password');

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
            'otp_code' => $this->randomNumber(),
            'password' => Hash::make($request->password),
        ]);

        $user = User::find($user->id);

        $this->recordActivity($request, 'reset password', $user);

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