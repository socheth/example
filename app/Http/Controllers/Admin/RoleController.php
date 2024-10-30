<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('role.viewAny', Role::class);

        return view('admin.roles.index', ['roles' => Role::query()->latest('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('role.create', Role::class);

        $permissions = Permission::all();

        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('role.create', Role::class);

        $request->validate([
            'name' => 'required',
            'level' => 'required',
            'permissions' => 'required',
        ]);

        $newRole = Role::create($request->all());

        $newRole->permissions()->sync($request->permissions);

        session()->flash('message', 'Your role has been created!');

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        Gate::authorize('role.view', $role);

        $permissions = Permission::all();

        $users = User::hasAnyRoles([$role->name])->get();

        return view('admin.roles.show', ['role' => $role, 'permissions' => $permissions, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('role.update', $role);

        $permissions = Permission::all();

        return view('admin.roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('role.update', $role);

        $request->validate([
            'name' => 'required',
            'level' => 'required',
            'permissions' => 'required',
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        session()->flash('message', 'Your role has been updated!');

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('role.delete', $role);

        $role->delete();

        session()->flash('message', 'Your role has been deleted!');

        return redirect()->route('admin.roles.index');
    }
}