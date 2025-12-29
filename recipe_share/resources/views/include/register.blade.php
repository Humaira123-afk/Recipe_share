@extends('layouts.app') {{-- Common layout --}}

@section('content')

<style>
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

.navbar a {
    color: white;
    text-decoration: none;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 0; 
}


.page-wrapper {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f3f4f6;
    padding-top: 64px;
}


.register-card {
    width: 100%;
    max-width: 450px;
    background-color: white;
    border-radius: 0; /* Sharp edges */
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    padding: 32px 24px;
    text-align: center;
    border: 1px solid #e5e7eb;
}

.register-card h2 {
    font-size: 24px;
    font-weight: 800;
    color: #f97316; 
    margin-bottom: 24px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}


.msg-box {
    padding: 10px;
    border-radius: 0;
    margin-bottom: 16px;
    font-size: 14px;
    text-align: left;
    border-left: 4px solid;
}

.msg-error {
    background-color: #fee2e2;
    color: #b91c1c;
    border-left-color: #dc2626;
}


.register-card label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    font-size: 13px;
    text-align: left;
    color: #374151;
}

.register-card input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 0;
    padding: 10px;
    font-size: 14px;
    margin-bottom: 15px;
    box-sizing: border-box;
    outline: none !important;
    background-color: #ffffff;
    transition: none;
}

.register-card input:focus {
    border-color: #f97316 !important;
    box-shadow: none !important;
}

.btn-primary {
    display: block;
    width: 100%;
    background-color: #f97316 !important;
    color: white !important;
    font-weight: bold;
    padding: 12px;
    border-radius: 0; 
    border: none;
    cursor: pointer;
    text-transform: uppercase;
    transition: none !important;
    outline: none !important;
}

.btn-primary:hover, 
.btn-primary:active, 
.btn-primary:focus {
    background-color: #f97316 !important;
    color: white !important;
    box-shadow: none !important;
}

.register-footer {
    margin-top: 20px;
    font-size: 13px;
    color: #6b7280;
}

.register-footer a {
    color: #f97316;
    text-decoration: none;
    font-weight: bold;
}

.register-footer a:hover {
    text-decoration: underline;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}">RecipeShare</a>
        <div>

            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</nav>


<div class="page-wrapper">
    <div class="register-card">

        <h2>Register</h2>

        @if($errors->any())
            <div class="msg-box msg-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div>
                <label>FULL NAME</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label>EMAIL ADDRESS</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>PASSWORD</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label>CONFIRM PASSWORD</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn-primary">Create Account</button>
        </form>

        <p class="register-footer">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
</div>

@endsection