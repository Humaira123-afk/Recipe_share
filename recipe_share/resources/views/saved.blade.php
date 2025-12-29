@extends('layouts.app')
@section('title','Saved Recipes')

@section('content')

<style>

body {
    overflow: hidden;
    margin: 0;
    padding: 0;
}

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #f97316;
    color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    z-index: 1000;
    height: 60px;
    display: flex;
    align-items: center;
}

.navbar-container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-sizing: border-box;
}

.brand {
    font-size: 20px;
    font-weight: 800;
    text-decoration: none;
    color: white !important;
    text-transform: uppercase;
}

.nav-links {
    display: flex;
    gap: 15px;
    align-items: center;
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

.page-center {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 60px;
}

.saved-card {
    width: 90%;
    max-width: 800px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 30px;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    max-height: 85vh;
}

.saved-card h1 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    color: #f97316;
    margin: 0 0 20px 0;
    text-transform: uppercase;
}

.saved-list-area {
    flex: 1;
    overflow-y: auto;
    padding-right: 5px;
}

.recipe-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 15px;
    border: 1px solid #f3f4f6;
    margin-bottom: 12px;
    background: #ffffff;
}

.recipe-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 1px solid #e5e7eb;
}

.recipe-info {
    flex: 1;
}

.recipe-info h3 {
    margin: 0;
    font-size: 16px;
    color: #111827;
    text-transform: uppercase;
}

.recipe-info p {
    margin: 5px 0 10px 0;
    font-size: 12px;
    color: #6b7280;
}

.btn-group {
    display: flex;
    gap: 10px;
}

.btn-action {
    padding: 8px 15px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid #f97316;
    cursor: pointer;
    border-radius: 0;
}

.btn-open {
    background-color: #f97316;
    color: white;
}

.btn-remove {
    background-color: white;
    color: #374151;
    border-color: #d1d5db;
}

.back-btn {
    text-align: center;
    border: 1px solid #f97316;
    color: #f97316;
    padding: 10px;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
    margin-top: 20px;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
        <div class="nav-links">
            <a href="{{ route('recipes.index') }}" class="nav-link">Recipes</a>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            @auth
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>

<div class="page-center">
    <div class="saved-card">
        <h1>Saved Recipes</h1>

        <div class="saved-list-area">
            @if($savedRecipes->isEmpty())
                <p style="text-align:center; padding: 40px; color:#9ca3af;">You haven't saved any recipes yet.</p>
            @else
                @foreach($savedRecipes as $save)
                    @if($save->recipe)
                        <div class="recipe-item">
                            @if($save->recipe->image)
                                <img src="{{ asset('storage/' . $save->recipe->image) }}" class="recipe-image">
                            @else
                                <div class="recipe-image" style="background: #f3f4f6; display:flex; align-items:center; justify-content:center; font-size:10px; color:#9ca3af;">NO IMG</div>
                            @endif

                            <div class="recipe-info">
                                <h3>{{ $save->recipe->title }}</h3>
                                <p>CATEGORY: {{ $save->recipe->category }}</p>
                                
                                <div class="btn-group">
                                    <a href="{{ route('recipes.show', $save->recipe->id) }}" class="btn-action btn-open">Open</a>
                                    
                                    <form action="{{ route('recipes.save', $save->recipe->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        <button type="submit" class="btn-action btn-remove">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="back-btn">Back to Dashboard</a>
    </div>
</div>

@endsection