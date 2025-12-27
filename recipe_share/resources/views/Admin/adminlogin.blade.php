@extends('layouts.app')
@section('title', 'Admin Login')

@section('content')

<style>
/* DISABLE PAGE SCROLL */
body { overflow: hidden; margin: 0; padding: 0; }

/* NAVBAR */
.navbar { position: fixed; top: 0; left: 0; width: 100%; background-color: #f97316; color: white; z-index: 1000; height: 60px; display: flex; align-items: center; }
.navbar-container { max-width: 1200px; margin: 0 auto; width: 100%; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; box-sizing: border-box; }
.brand { font-size: 20px; font-weight: 800; text-decoration: none; color: white !important; text-transform: uppercase; }

/* CENTERED LOGIN BOX */
.login-wrapper { position: fixed; inset: 0; background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; padding-top: 60px; }
.login-card { width: 100%; max-width: 380px; background-color: white; border-radius: 0; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 35px; border: 1px solid #e5e7eb; }
.login-card h2 { font-size: 20px; font-weight: 700; text-align: center; color: #f97316; margin-bottom: 25px; text-transform: uppercase; }

/* FORM STYLING - Simple Style */
.form-group { margin-bottom: 18px; }
.form-label { display: block; font-size: 13px; color: #4b5563; margin-bottom: 6px; } /* Simple Label */
.form-input { width: 100%; border: 1px solid #d1d5db; padding: 10px; font-size: 14px; border-radius: 0; outline: none; box-sizing: border-box; }
.form-input:focus { border-color: #f97316; }

.login-btn { width: 100%; background-color: #f97316; color: white; font-weight: 600; padding: 12px; border: none; cursor: pointer; text-transform: uppercase; font-size: 13px; }
.back-link { display: block; text-align: center; margin-top: 15px; font-size: 12px; color: #6b7280; text-decoration: none; }
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
    </div>
</nav>

<div class="login-wrapper">
    <div class="login-card">
        <h2>Admin Login</h2>
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email"  class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password"  class="form-input" required>
            </div>
            <button type="submit" class="login-btn">Login to Dashboard</button>
        </form>
        <a href="{{ route('welcome') }}" class="back-link">Back to Homepage</a>
    </div>
</div>
@endsection