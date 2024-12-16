<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (url()->previous() != url()->current()) {

            Session::put('beforeregister', url()->previous());

            // Redirect::setIntendedUrl(url()->previous());

        } elseif (url()->previous() == url()->current()) {

            Session::put('beforeregister', redirect()->intended(route('admin.dashboard', absolute: false)));
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:25', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'phone' => preg_replace('/[^0-9+]/', '', $request->phone),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role_id = 5;

        $user->roles()->attach($role_id);

        $role = Role::where('roles.id', $role_id)->with('permissions')->first();

        $permissions = $role->permissions->pluck('id')->toArray();

        $user->permissions()->sync($permissions);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('pages.registered');
    }
}
