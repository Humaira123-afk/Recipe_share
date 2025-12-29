@extends('layouts.app')
@section('title','Edit Recipe')

@section('content')

<style>
/* DISABLE SCROLL ON BODY */
body {
    overflow: hidden;
}

/* NAVBAR - Fixed & Sharp */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #f97316;
    color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    z-index: 100;
}

.navbar-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.brand {
    font-size: 20px;
    font-weight: 800;
    text-decoration: none;
    color: #ffffff !important;
    text-transform: uppercase;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-link, .logout-btn {
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    background: none;
    border: none;
    cursor: pointer;
}

/* CENTERED WRAPPER (No Scroll) */
.page-center {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f3f4f6;
    padding-top: 60px;
}

/* EDIT CARD - Sharp */
.edit-card {
    width: 100%;
    max-width: 480px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 24px 32px;
    border: 1px solid #e5e7eb;
    box-sizing: border-box;
}

.edit-card h1 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    color: #f97316;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* FORM ELEMENTS */
.edit-card label {
    display: block;
    font-weight: 700;
    font-size: 11px;
    margin-bottom: 4px;
    color: #374151;
    text-transform: uppercase;
}

.edit-card input[type="text"],
.edit-card textarea {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 0;
    padding: 8px 10px;
    font-size: 13px;
    margin-bottom: 12px;
    box-sizing: border-box;
    outline: none;
}

.edit-card textarea {
    resize: none;
}

/* IMAGE PREVIEW - Sharp */
.edit-card img {
    display: block;
    margin-bottom: 10px;
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 0;
    border: 2px solid #f97316;
}

/* BUTTONS - Perfectly Aligned */
.form-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 10px;
}

.btn-form {
    width: 100%;
    box-sizing: border-box;
    font-weight: 800;
    padding: 12px 0;
    border-radius: 0;
    font-size: 13px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    border: 2px solid #f97316;
    cursor: pointer;
    transition: none !important;
}

.primary-btn {
    background-color: #f97316 !important;
    color: white !important;
}

.secondary-btn {
    background-color: white !important;
    color: #f97316 !important;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
        <div class="nav-links">
            <a href="{{ route('recipes.index') }}" class="nav-link">Recipes</a>
            <a href="{{ route('recipes.suggest') }}" class="nav-link">Suggest</a>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-center">
    <div class="edit-card">
        <h1>Edit Recipe</h1>

        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 8px; margin-bottom: 12px; border-left: 4px solid #dc2626; font-size: 12px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $recipe->title) }}" required>

            <label>Ingredients</label>
            <textarea name="ingredients" rows="2" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>

            <label>Steps</label>
            <textarea name="steps" rows="2" required>{{ old('steps', $recipe->steps) }}</textarea>

            <label>Category</label>
            <input type="text" name="category" value="{{ old('category', $recipe->category) }}" required>

            <label>Current Image</label>
            <div style="display: flex; align-items: flex-end; gap: 10px;">

                @if($recipe->image)
                    <img src="{{ asset('storage/'.$recipe->image) }}">
                @endif
                
                <input type="file" name="image" style="font-size: 11px; margin-bottom: 12px;">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-form primary-btn">Update Recipe</button>
                <a href="{{ route('recipes.index') }}" class="btn-form secondary-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection