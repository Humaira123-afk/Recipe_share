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

<!-- Admin Register Card -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-100 pt-16">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">

        <h2 class="text-2xl font-bold text-center text-orange-500 mb-6">Admin Register</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 text-sm font-semibold">Full Name</label>
                <input type="text" name="name" placeholder="Full Name" class="w-full border rounded px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Admin Email</label>
                <input type="email" name="email" placeholder="Admin Email" class="w-full border rounded px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Password</label>
                <input type="password" name="password" placeholder="Password" class="w-full border rounded px-3 py-2 text-sm" required>
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white font-bold py-2 rounded hover:bg-orange-600 transition text-sm">Register Admin</button>
        </form>

        <p class="text-center mt-4 text-gray-600 text-sm">
            Already have an account? <a href="{{ route('admin.login') }}" class="text-orange-500 hover:underline">Login</a>
        </p>

    </div>
</div>
@endsection
