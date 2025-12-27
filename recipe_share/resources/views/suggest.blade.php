@extends('layouts.app')
@section('title','Suggest Recipes')

@section('content')

<style>
/* DISABLE PAGE SCROLL */
body {
    overflow: hidden;
    margin: 0;
    padding: 0;
}

/* NAVBAR - Clean & Fixed */
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

/* CENTERED PAGE WRAPPER */
.page-center {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 60px;
}

/* CARD - Sharp */
.suggest-card {
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

.suggest-card h1 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    color: #f97316;
    margin: 0 0 20px 0;
    text-transform: uppercase;
}

/* INPUT FORM */
.input-group {
    display: flex;
    gap: 0;
    margin-bottom: 20px;
}

.suggest-input {
    flex: 1;
    border: 1px solid #d1d5db;
    padding: 12px;
    font-size: 14px;
    border-radius: 0;
    outline: none;
}

.generate-btn {
    background-color: #f97316;
    color: white;
    border: 1px solid #f97316;
    padding: 0 25px;
    font-weight: 800;
    cursor: pointer;
    text-transform: uppercase;
    font-size: 13px;
}

/* RESULTS AREA - Scrollable */
.results-area {
    flex: 1;
    overflow-y: auto;
    border-top: 1px solid #f3f4f6;
    padding-top: 15px;
}

.recipe-box {
    background-color: #fafafa;
    border: 1px solid #eeeeee;
    padding: 20px;
    margin-bottom: 15px;
}

.recipe-box h3 {
    margin: 0 0 10px 0;
    color: #111827;
    font-size: 16px;
    text-transform: uppercase;
    border-bottom: 1px solid #f97316;
    display: inline-block;
    padding-bottom: 2px;
}

.match-tag {
    color: #16a34a;
    font-weight: 700;
    font-size: 12px;
}

.section-title {
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    color: #374151;
    margin-top: 10px;
}

/* FOOTER BUTTON */
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

.error-msg {
    background-color: #fee2e2;
    color: #b91c1c;
    padding: 10px;
    font-size: 13px;
    margin-bottom: 15px;
    border-left: 4px solid #dc2626;
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
    <div class="suggest-card">
        <h1>Suggest Recipes</h1>

        @if(session('error'))
            <div class="error-msg">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('recipes.generate') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="ingredients" 
                       value="{{ old('ingredients') }}" 
                       placeholder="Chicken , eggs separate with commas" 
                       class="suggest-input" required>
                <button type="submit" class="generate-btn">Generate</button>
            </div>
        </form>

        <div class="results-area">
            @if(isset($results))
                @forelse($results as $recipe)
                    <div class="recipe-box">
                        <h3>{{ $recipe['title'] }} <span class="match-tag">({{ $recipe['match'] }}% MATCH)</span></h3>

                        <div class="section-title">Ingredients:</div>
                        <p style="font-size: 13px; color: #4b5563; margin: 5px 0;">
                            {{ implode(', ', $recipe['ingredients']) }}
                        </p>

                        <div class="section-title">Steps:</div>
                        <p style="font-size: 13px; color: #4b5563; margin: 5px 0; line-height: 1.5;">
                            {{ $recipe['steps'] }}
                        </p>
                    </div>
                @empty
                    <p style="text-align:center; color:#9ca3af; padding: 20px;">No recipes found with these ingredients.</p>
                @endforelse
            @else
                <p style="text-align:center; color:#9ca3af; padding: 20px;">Enter ingredients above to find matching recipes.</p>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="back-btn">Back to Dashboard</a>
    </div>
</div>

@endsection