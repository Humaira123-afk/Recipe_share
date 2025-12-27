@extends('layouts.app')

@section('content')

<style>
/* NAVBAR - Fixed & Sharp */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #f97316;
    color: #ffffff;
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
    letter-spacing: 1px;
}

.nav-links {
    display: flex;
    gap: 5px;
}

.nav-link {
    padding: 8px 12px;
    border-radius: 0;
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    transition: none !important;
}

/* PAGE WRAPPER */
.page-wrapper {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    padding-top: 64px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD - Sharp */
.welcome-card {
    width: 100%;
    max-width: 400px;
    background-color: #ffffff;
    padding: 40px 32px;
    text-align: center;
    border-radius: 0;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border: 1px solid #e5e7eb;
}

/* TEXT */
.welcome-title {
    font-size: 28px;
    font-weight: 800;
    color: #f97316;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.welcome-text {
    color: #6b7280;
    margin-bottom: 30px;
    font-size: 14px;
    font-weight: 600;
}

/* BUTTONS GROUP - TO ENSURE ALIGNMENT */
.portal-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px; /* Fixed spacing between buttons */
    width: 100%;
}

/* SHARED BUTTON STYLES */
.btn-portal {
    display: block;
    width: 100%;
    box-sizing: border-box; /* This ensures border doesn't change width */
    font-weight: bold;
    padding: 14px 0; /* Consistent height */
    border-radius: 0;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 14px;
    text-align: center;
    cursor: pointer;
    transition: none !important;
    outline: none !important;
}

/* User Login Button */
.primary-btn {
    background-color: #f97316 !important;
    color: #ffffff !important;
    border: 2px solid #f97316 !important; /* Added border to match size */
}

/* Admin Portal Button */
.admin-btn {
    background-color: white !important;
    color: #f97316 !important;
    border: 2px solid #f97316 !important;
}

/* Keep colors static on hover */
.btn-portal:hover, .btn-portal:focus {
    opacity: 1;
    box-shadow: none !important;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
        
        <div class="nav-links">
            <a href="{{ route('recipes.index') }}" class="nav-link">Recipes</a>
            <a href="{{ route('recipes.suggest') }}" class="nav-link">Suggest</a>
            <a href="{{ route('recipes.saved') }}" class="nav-link">Saved</a>
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <a href="{{ route('register') }}" class="nav-link">Register</a>
        </div>
    </div>
</nav>

<div class="page-wrapper">
    <div class="welcome-card">
        <h1 class="welcome-title">Welcome</h1>
        <p class="welcome-text">Select your portal to continue</p>

        <div class="portal-buttons">
            <a href="{{ route('login') }}" class="btn-portal primary-btn">User Login</a>
            <a href="{{ route('admin.login') }}" class="btn-portal admin-btn">Admin Portal</a>
        </div>
    </div>
</div>

@endsection