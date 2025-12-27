@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<style>
/* NAVBAR */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #f97316;
    color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    z-index: 50;
}

.navbar-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar a, .navbar span {
    color: white;
    font-weight: 600;
    text-decoration: none;
    padding: 6px 12px;
}

.navbar span {
    background-color: rgba(255,255,255,0.2);
}

/* PAGE WRAPPER */
.page-wrapper {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 64px;
}

/* CARD */
.dashboard-card {
    width: 100%;
    max-width: 400px;
    background-color: white;
    padding: 32px 24px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

/* SUCCESS MESSAGE */
.success-msg {
    background-color: #dcfce7;
    color: #166534;
    padding: 8px;
    border-radius: 6px;
    margin-bottom: 16px;
    width: 100%;
    text-align: center;
}

/* USER AVATAR */
.user-avatar {
    width: 80px;
    height: 80px;
    background-color: #f97316;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 12px;
}

/* USER INFO */
.user-name {
    font-size: 18px;
    font-weight: bold;
    color: #111827;
    margin-bottom: 4px;
}

.user-email {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 20px;
}

/* BUTTONS CONTAINER */
.button-group {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 10px;
}

/* BASE BUTTON STYLE - FIXING ALL STATES */
.btn {
    width: 100%;
    padding: 12px 0;
    font-weight: bold;
    font-size: 14px;
    text-align: center;
    border: none;
    cursor: pointer;
    text-decoration: none;
    border-radius: 0;
    display: block;
    transition: none !important; /* No animations */
    outline: none !important;    /* No focus ring */
    box-shadow: none !important;
}

/* Primary Orange - Browse All Recipes */
.btn-primary {
    background-color: #f97316 !important;
    color: white !important;
}

/* Fixed states for Primary */
.btn-primary:hover, .btn-primary:active, .btn-primary:focus {
    background-color: #f97316 !important;
    color: white !important;
}

/* Secondary White - Other Buttons */
.btn-secondary {
    background-color: white !important;
    color: #f97316 !important;
    border: 2px solid #f97316 !important;
}

/* Fixed states for Secondary */
.btn-secondary:hover, .btn-secondary:active, .btn-secondary:focus {
    background-color: white !important;
    color: #f97316 !important;
    border: 2px solid #f97316 !important;
}

/* Logout Button */
.btn-logout {
    background-color: white !important;
    color: #dc2626 !important;
    border: 2px solid #f97316 !important;
}

.btn-logout:hover, .btn-logout:active, .btn-logout:focus {
    background-color: white !important;
    color: #dc2626 !important;
    border: 2px solid #f97316 !important;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}">RecipeShare</a>
        <span>Dashboard</span>
    </div>
</nav>

<div class="page-wrapper">
    <div class="dashboard-card">

        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-email">{{ auth()->user()->email }}</div>

        <div class="button-group">
            <a href="{{ route('recipes.index') }}" class="btn btn-primary">Browse All Recipes</a>
            <a href="{{ route('recipes.create') }}" class="btn btn-secondary">Share New Recipe</a>
            <a href="{{ route('recipes.suggest') }}" class="btn btn-secondary">Suggest Recipe</a>
            <a href="{{ route('recipes.saved') }}" class="btn btn-secondary">My Saved Posts</a>

            <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                @csrf
                <button type="submit" class="btn btn-logout">Logout Account</button>
            </form>
        </div>

    </div>
</div>

@endsection