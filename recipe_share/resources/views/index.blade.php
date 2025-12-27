@extends('layouts.app')
@section('title','All Recipes')

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
    letter-spacing: 1px;
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
    padding: 5px 10px;
}

.nav-link:hover {
    background: rgba(255,255,255,0.1);
}

/* CENTERED PAGE WRAPPER */
.page-center {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 60px; /* Space for navbar */
}

/* CARD - Compact & Sharp */
.recipes-card {
    width: 90%;
    max-width: 800px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 30px;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    max-height: 80vh; /* Card screen se bahar nahi jayega */
}

.recipes-card h1 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    color: #f97316;
    margin: 0 0 20px 0;
    text-transform: uppercase;
}

/* TOP BAR (Search & Add) */
.top-bar {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 20px;
}

.search-form {
    display: flex;
    flex: 1;
}

.search-input {
    flex: 1;
    border: 1px solid #d1d5db;
    padding: 8px 12px;
    border-radius: 0;
    outline: none;
    font-size: 13px;
}

.search-btn {
    background-color: #f97316;
    color: white;
    border: 1px solid #f97316;
    padding: 8px 15px;
    cursor: pointer;
    font-weight: bold;
}

.add-btn {
    background-color: #f97316;
    color: white;
    padding: 8px 15px;
    text-decoration: none;
    font-weight: bold;
    font-size: 12px;
    text-transform: uppercase;
    display: flex;
    align-items: center;
}

/* TABLE AREA - Scrollable only inside card */
.table-area {
    flex: 1;
    overflow-y: auto; /* Sirf table scroll hogi agar data zyada hai */
    border: 1px solid #f3f4f6;
    margin-bottom: 20px;
}

.recipes-table {
    width: 100%;
    border-collapse: collapse;
}

.recipes-table th {
    position: sticky;
    top: 0;
    background-color: #f9fafb;
    color: #374151;
    font-weight: 700;
    font-size: 11px;
    text-transform: uppercase;
    border-bottom: 2px solid #f97316;
    padding: 12px;
    text-align: left;
    z-index: 10;
}

.recipes-table td {
    padding: 12px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 13px;
    color: #4b5563;
}

.action-link {
    color: #f97316;
    text-decoration: none;
    font-weight: 700;
    font-size: 11px;
    text-transform: uppercase;
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
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
        <div class="nav-links">
            <a href="{{ route('recipes.index') }}" class="nav-link">Recipes</a>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-center">
    <div class="recipes-card">
        <h1>All Recipes</h1>

        <div class="top-bar">
            <form action="{{ route('recipes.index') }}" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="SEARCH..." value="{{ request('search') }}">
                <button type="submit" class="search-btn">GO</button>
            </form>

            @auth('web')
                <a href="{{ route('recipes.create') }}" class="add-btn">Add New</a>
            @endauth
        </div>

        <div class="table-area">
            @if($recipes->isEmpty())
                <p style="text-align:center; padding: 20px; color:#9ca3af;">No recipes found.</p>
            @else
                <table class="recipes-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)
                        <tr>
                            <td style="font-weight: 600; color: #111827;">{{ $recipe->title }}</td>
                            <td style="color: black;">{{ $recipe->category }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="action-link">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="back-btn">Back to Dashboard</a>
    </div>
</div>

@endsection