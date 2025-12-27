@extends('layouts.app')
@section('title', 'Admin Register')

@section('content')

<style>
/* DISABLE PAGE SCROLL */
body {
    overflow: hidden;
    margin: 0;
    padding: 0;
}

/* NAVBAR - Fixed & Sharp */
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
}

.nav-link {
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
}

/* CENTERED REGISTER BOX */
.register-wrapper {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 60px;
}

.register-card {
    width: 100%;
    max-width: 400px;
    background-color: white;
    border-radius: 0; /* Sharp corners */
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    padding: 40px;
    border: 1px solid #e5e7eb;
}

.register-card h2 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    color: #f97316;
    margin-bottom: 25px;
    text-transform: uppercase;
}

/* FORM STYLING */
.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    font-size: 11px;
    font-weight: 800;
    color: #374151;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.form-input {
    width: 100%;
    border: 1px solid #d1d5db;
    padding: 10px;
    font-size: 14px;
    border-radius: 0; /* Sharp corners */
    outline: none;
    box-sizing: border-box;
}

.form-input:focus {
    border-color: #f97316;
}

/* BUTTON - Sharp */
.register-btn {
    width: 100%;
    background-color: #f97316;
    color: white;
    font-weight: 800;
    padding: 12px;
    border: none;
    cursor: pointer;
    text-transform: uppercase;
    font-size: 13px;
    margin-top: 10px;
}

.register-btn:hover {
    background-color: #ea580c;
}

.error-box {
    background-color: #fee2e2;
    color: #b91c1c;
    padding: 10px;
    font-size: 12px;
    margin-bottom: 20px;
    border-left: 4px solid #ef4444;
}

.login-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: #6b7280;
    text-decoration: none;
    font-weight: 600;
    text-transform: uppercase;
}

.login-link span {
    color: #f97316;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
        <div class="nav-links">
            <a href="{{ route('admin.login') }}" class="nav-link">Admin Login</a>
            <a href="{{ route('welcome') }}" class="nav-link">Home</a>
        </div>
    </div>
</nav>

<div class="register-wrapper">
    <div class="register-card">
        <h2>Admin Register</h2>

        @if($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" placeholder="ENTER FULL NAME" class="form-input" required value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Admin Email</label>
                <input type="email" name="email" placeholder="ENTER ADMIN EMAIL" class="form-input" required value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="CREATE PASSWORD" class="form-input" required>
            </div>

            <button type="submit" class="register-btn">Register Admin</button>
        </form>

        <a href="{{ route('admin.login') }}" class="login-link">
            Already have an account? <span>Login</span>
        </a>
    </div>
</div>

@endsection