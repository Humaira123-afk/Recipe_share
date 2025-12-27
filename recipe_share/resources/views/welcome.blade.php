@extends('layouts.app') {{-- Common layout --}}

@section('content')
<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-orange-500 text-white shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-lg">RecipeShare</a>
        <div>
            <a href="{{ route('login') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Login</a>
            <a href="{{ route('register') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Register</a>
        </div>
    </div>
</nav>

<!-- Welcome Card -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-100 pt-16">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 text-center">
        <h1 class="text-3xl font-bold text-orange-500 mb-4 border-b-4 border-orange-500 inline-block pb-2">Welcome</h1>
        <p class="text-gray-600 mb-6">Select your portal to continue</p>

        <a href="{{ route('login') }}" class="block w-full bg-orange-500 text-white font-bold py-2 rounded mb-3 hover:bg-orange-600 transition">User Login</a>
        <a href="{{ route('admin.login') }}" class="block w-full bg-orange-500 text-white font-bold py-2 rounded hover:bg-orange-600 transition">Admin Portal</a>
    </div>
</div>
@endsection
