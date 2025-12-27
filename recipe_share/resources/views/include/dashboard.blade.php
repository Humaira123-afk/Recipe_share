@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<nav class="fixed top-0 left-0 w-full bg-orange-500 text-white shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-lg">RecipeShare</a>
        <div>
            <span class="px-3 py-1 rounded font-semibold">Dashboard</span>
        </div>
    </div>
</nav>

<div class="fixed inset-0 flex items-center justify-center bg-gray-100 pt-16">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 text-center">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <div class="w-20 h-20 mx-auto bg-orange-500 text-white rounded-full flex items-center justify-center mb-4 text-2xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
            <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p>
        </div>

        <div class="space-y-4">
            <a href="{{ route('recipes.index') }}" class="block w-full bg-orange-500 text-white font-bold py-2 rounded">
                Browse All Recipes
            </a>
            <a href="{{ route('recipes.create') }}" class="block w-full bg-white border-2 border-orange-500 text-orange-500 font-bold py-2 rounded">
                Share New Recipe
            </a>
            
            <!-- Suggest Recipe Button -->
            <a href="{{ route('recipes.suggest') }}" class="block w-full bg-white border-2 border-orange-500 text-orange-500 font-bold py-2 rounded">
                Suggest Recipe
            </a>

            <a href="{{ route('recipes.saved') }}" class="block w-full bg-white border-2 border-orange-500 text-orange-500 font-bold py-2 rounded">
                My Saved Posts
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full bg-white border-2 border-orange-500 text-red-600 font-bold py-2 rounded">
                    Logout Account
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
