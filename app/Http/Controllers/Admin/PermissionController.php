<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('permission.viewAny', Permission::class);

        return view('admin.permissions.index', ['permissions' => Permission::query()->latest('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('permission.create', Permission::class);

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('permission.create', Permission::class);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Permission::create($request->all());

        session()->flash('message', 'Your permission has been created!');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        Gate::authorize('permission.view', $permission);

        $users = User::HasAnyPermissions([$permission->name])->get();

        return view('admin.permissions.show', ['permission' => $permission, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        Gate::authorize('permission.update', $permission);

        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        Gate::authorize('permission.update', $permission);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $permission->update($request->all());

        session()->flash('message', 'Your permission has been updated!');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        Gate::authorize('permission.delete', $permission);

        $permission->delete();

        session()->flash('message', 'Your permission has been deleted!');

        return redirect()->route('admin.permissions.index');
    }
}