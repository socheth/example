<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        if (request()->hasFile('photo')) {
            $imagePath = request('photo')->store('avatars', 'public');
            $request['photo'] = asset('storage/' . $imagePath);

            // $imageName = request('photo')->getClientOriginalName();
            // $imagePath = 'uploads/' . $imageName;
            // Storage::disk('s3')->put($imagePath, file_get_contents(request('photo')));
            // $request['photo'] = Storage::disk('s3')->url($imagePath);
        }

        $request['is_active'] ??= false;
        $request['is_admin'] ??= false;
        $request['phone'] = preg_replace('/[^0-9+]/', '', $request['phone']);
        $request['creator_id'] = auth()->user()->id;
        $request['slug'] = Str::slug($request['name']);
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request);

        $user->roles()->attach($request['role']);

        $role = Role::where('roles.id', $request['role'])->with('permissions')->first();

        $permissions = $role->permissions->pluck('id')->toArray();

        $user->permissions()->sync($permissions);

        return back()->with('status', 'user-created');
    }

    public function editPermissions(User $user)
    {
        Gate::authorize('user.update', $user);

        $permissions = Permission::all();

        return view('admin.users.permissions', ['user' => $user, 'permissions' => $permissions]);
    }

    public function updatePermissions(Request $request, User $user)
    {
        Gate::authorize('user.update', $user);

        $request->validate([
            'permissions' => 'required|array',
        ]);

        $user->permissions()->sync($request->permissions);

        return back()->with('status', 'permissions-updated');
    }

    public function removeRoleFromUser(User $user, Role $role)
    {
        Gate::authorize('role.update', $role);

        $user->roles()->detach($role->id);

        return back()->with('status', 'role-removed');
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

        $permissions = Permission::all();

        return view('admin.users.edit', ['user' => $user, 'permissions' => $permissions]);
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

        if (request()->hasFile('photo')) {
            $imagePath = request('photo')->store('avatars', 'public');
            $request['photo'] = asset('storage/' . $imagePath);

            // $imageName = request('photo')->getClientOriginalName();
            // $imagePath = 'uploads/' . $imageName;
            // Storage::disk('s3')->put($imagePath, file_get_contents(request('photo')));
            // $request['photo'] = Storage::disk('s3')->url($imagePath);
        }

        $request['is_active'] ??= false;
        $request['is_admin'] ??= false;
        $request['phone'] = preg_replace('/[^0-9+]/', '', $request['phone']);
        $request['slug'] = Str::slug($request['name']);
        $request['password'] = request('password') ? Hash::make(request('password')) : $user->password;

        $user->update($request);

        $user->roles()->sync($request['role']);

        $role = Role::where('roles.id', $request['role'])->with('permissions')->first();

        $permissions = $role->permissions->pluck('id')->toArray();

        $user->permissions()->sync($permissions);

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