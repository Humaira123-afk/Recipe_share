@extends('layouts.app')
@section('title','Add Recipe')
@section('content')

<style>
/* DISABLE SCROLL ON BODY */
body {
    overflow: hidden; /* Screen scroll nahi hogi */
}

/* NAVBAR */
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
    inset: 0; /* Full screen cover */
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f3f4f6;
    padding-top: 60px; /* Space for navbar */
}

/* RECIPE CARD - Fixed Height if needed */
.recipe-card {
    width: 100%;
    max-width: 480px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 24px 32px;
    border: 1px solid #e5e7eb;
    box-sizing: border-box;
}

.recipe-card h1 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    color: #f97316;
    margin-bottom: 20px;
    text-transform: uppercase;
}

/* FORM ELEMENTS - Compact */
.recipe-card label {
    display: block;
    font-weight: 700;
    font-size: 11px;
    margin-bottom: 4px;
    color: #374151;
    text-transform: uppercase;
}

.recipe-card input[type="text"],
.recipe-card textarea {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 0;
    padding: 8px 10px;
    font-size: 13px;
    margin-bottom: 12px;
    box-sizing: border-box;
    outline: none;
}

.recipe-card textarea {
    resize: none; /* User resize nahi kar sake ga taake layout na tute */
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
    <div class="recipe-card">
        <h1>Add Recipe</h1>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Title</label>
            <input type="text" name="title"  required>

            <label>Ingredients</label>
            <textarea name="ingredients" rows="2" required></textarea>

            <label>Instructions</label>
            <textarea name="steps" rows="2"  required></textarea>

            <label>Category</label>
            <input type="text" name="category"  required>

            <label>Image</label>
            <input type="file" name="image" style="font-size: 12px; margin-bottom: 15px;">

            <div class="form-actions">
                <button type="submit" class="btn-form primary-btn">Save Recipe</button>
                <a href="{{ route('dashboard') }}" class="btn-form secondary-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection