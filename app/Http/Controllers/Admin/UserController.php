<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('user.viewAny', User::class);

        return view('admin.users.index', [
            'users' => User::query()->latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('user.create', User::class);

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('user.create', User::class);

        $request = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image'],
            'role' => ['required'],
            'is_active' => ['nullable'],
            'is_admin' => ['nullable'],
        ]);

        if (request('photo')) {
            $request['photo'] = request('photo')->store('avatars', 'public');
            $request['photo'] = asset('storage/' . $request['photo']);
        }

        $request['is_active'] ??= false;
        $request['is_admin'] ??= false;
        $request['phone'] = preg_replace('/[^0-9+]/', '', $request['phone']);
        $request['creator_id'] = auth()->user()->id;
        $request['slug'] = Str::slug($request['name']);
        $request['password'] = Hash::make($request['password']);

        $user_id = User::create($request)->id;

        DB::table('role_user')->insert([
            'role_id' => $request['role'],
            'user_id' => $user_id,
        ]);

        DB::statement("INSERT INTO permission_user (SELECT permission_id, $user_id FROM permission_role WHERE role_id = $request[role])");

        return back()->with('status', 'user-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('user.view', $user);

        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('user.update', $user);

        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('user.update', $user);

        $request = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id),],
            'phone' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id),],
            'password' => ['nullable', 'string', 'min:8'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image'],
            'role' => ['required'],
            'is_active' => ['nullable'],
            'is_admin' => ['nullable'],
        ]);

        if (request('photo')) {
            $request['photo'] = request('photo')->store('avatars', 'public');
            $request['photo'] = asset('storage/' . $request['photo']);
        }

        $request['is_active'] ??= false;
        $request['is_admin'] ??= false;
        $request['phone'] = preg_replace('/[^0-9+]/', '', $request['phone']);
        $request['slug'] = Str::slug($request['name']);
        $request['password'] = request('password') ? Hash::make(request('password')) : $user->password;

        $user->update($request);

        DB::table('role_user')->where('user_id', $user->id)->updateOrInsert([
            'role_id' => $request['role'],
            'user_id' => $user->id,
        ]);

        return back()->with('status', 'user-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('user.delete', $user);

        $user->delete();

        session()->flash('message', 'Your user has been deleted!');

        return redirect()->route('admin.users.index');
    }
}