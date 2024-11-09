<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;

Route:: as('pages.')->group(function () {

    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    Route::view('about', 'pages.about')->name('about');
    Route::view('contact', 'pages.contact')->name('contact');

    Route::get('registered', fn() => view('pages.registered-inform'))->middleware('auth')->name('registered');
});

Route::get('lang', [LanguageController::class, 'change'])->name("change.lang");

Route::resource('jobs', App\Http\Controllers\JobController::class)->only(['index', 'show']);
Route::get('/jobs/{slug}/{id}', [App\Http\Controllers\JobController::class, 'showBySlug'])->name('jobs.slug');
Route::resource('posts', App\Http\Controllers\PostController::class)->only(['index', 'show']);
Route::get('/posts/{slug}/{id}', [App\Http\Controllers\PostController::class, 'showBySlug'])->name('posts.slug');
Route::resource('companies', App\Http\Controllers\CompanyController::class)->only(['index', 'show']);
Route::get('/companies/{slug}/{id}', [App\Http\Controllers\CompanyController::class, 'showBySlug'])->name('companies.slug');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('index');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/assign/permissions/{user}/edit', [UserController::class, 'editPermissions'])->name('assign.permissions.edit')->middleware('is_super_admin');
    Route::patch('/assign/permissions/{user}/update', [UserController::class, 'updatePermissions'])->name('assign.permissions.update')->middleware('is_super_admin');
    Route::delete('/users/roles/{user}/{role}', [UserController::class, 'removeRoleFromUser'])->name('users.roles.remove')->middleware('is_super_admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('jobs', JobController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->middleware('is_super_admin');
    Route::resource('permissions', PermissionController::class)->middleware('is_super_admin');

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index')->name('posts.index');
        Route::get('/posts/create', 'create')->name('posts.create');
        Route::get('/posts/{post}', 'show')->name('posts.show');
        Route::post('/posts', 'store')->name('posts.store');
        Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
        Route::put('/posts/{post}', 'update')->name('posts.update');
        Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    });

});

Route::get('/google/login', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    $googleUser->getId();
    $googleUser->getNickname();
    $googleUser->getName();
    $googleUser->getEmail();
    $googleUser->getAvatar();

    // $user = User::updateOrCreate([
    //     'google_id' => $googleUser->id,
    // ], [
    //     'name' => $googleUser->name,
    //     'email' => $googleUser->email,
    //     'google_token' => $googleUser->token,
    //     'google_refresh_token' => $googleUser->refreshToken,
    // ]);

    // Auth::login($user);

    // return redirect('/admin/dashboard');
});

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('google')->user();

//     // OAuth 2.0 providers...
//     $token = $user->token;
//     $refreshToken = $user->refreshToken;
//     $expiresIn = $user->expiresIn;

//     // OAuth 1.0 providers...
//     $token = $user->token;
//     $tokenSecret = $user->tokenSecret;

//     // All providers...
//     $user->getId();
//     $user->getNickname();
//     $user->getName();
//     $user->getEmail();
//     $user->getAvatar();
// });

require __DIR__ . '/auth.php';