<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecipeController;


Route::get('/', [RecipeController::class, 'welcome'])->name('welcome');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{id}', [RecipeController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('recipes.show');



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
});


Route::middleware('auth')->group(function () {

    // Dashboard & logout
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Saved recipes
    Route::get('/my-saves', [RecipeController::class, 'savedRecipes'])->name('recipes.saved');

    // Recipe CRUD (except index & show)
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);

    // Recipe interactions
    Route::post('/recipes/{id}/like', [RecipeController::class, 'like'])->name('recipes.like');
    Route::post('/recipes/{id}/comment', [RecipeController::class, 'comment'])->name('recipes.comment');
    Route::post('/recipes/{id}/save', [RecipeController::class, 'saveRecipe'])->name('recipes.save');

    // Suggest / Generate recipes
    Route::get('/recipes/suggest', [RecipeController::class, 'suggest'])->name('recipes.suggest');
    Route::post('/recipes/generate', [RecipeController::class, 'generate'])->name('recipes.generate');
});


Route::middleware('auth:admin')->prefix('admin')->group(function () {

    // Admin dashboard & logout
    Route::get('/dashboard', [RecipeController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Admin management
    Route::get('/recipes-manage', [RecipeController::class, 'adminRecipes'])->name('admin.recipes');
    Route::get('/users-manage', [RecipeController::class, 'adminUsers'])->name('admin.users');

    // Admin actions
    Route::delete('/recipes/{id}', [RecipeController::class, 'adminDestroyRecipe'])->name('admin.recipes.destroy');
    Route::delete('/users/{id}', [RecipeController::class, 'destroyUser'])->name('admin.users.destroy');
});
