@extends('layouts.app')
@section('title','Add Recipe')
@section('content')

<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-orange-500 text-white shadow-md z-50 h-[64px]">
    <div class="max-w-7xl mx-auto px-4 h-full flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-lg">RecipeShare</a>
        <a href="{{ route('dashboard') }}" class="px-3 py-1 rounded font-semibold">Dashboard</a>
    </div>
</nav>

<!-- FULL SCREEN FIXED WRAPPER (NO SCROLL) -->
<div class="fixed inset-0 bg-gray-100 flex justify-center items-center overflow-hidden"
     style="padding-top:64px;">

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow-lg p-6 w-[600px] max-h-[85vh] overflow-hidden">

        <h1 class="text-2xl font-bold text-center text-orange-500 mb-4">
            Add Recipe
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('recipes.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-2">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text"
                       name="title"
                       class="w-full border rounded px-2 py-1 text-sm"
                       required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Ingredients</label>
                <textarea rows="2"
                          name="ingredients"
                          class="w-full border rounded px-2 py-1 text-sm resize-none"
                          required></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Steps</label>
                <textarea rows="2"
                          name="steps"
                          class="w-full border rounded px-2 py-1 text-sm resize-none"
                          required></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Category</label>
                <input type="text"
                       name="category"
                       class="w-full border rounded px-2 py-1 text-sm"
                       required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Recipe Image</label>
                <input type="file" name="image" class="w-full text-sm">
            </div>

            <button class="w-full bg-orange-500 text-white font-bold py-2 rounded text-sm">
                Save Recipe
            </button>

            <a href="{{ route('dashboard') }}"
               class="block w-full text-center bg-gray-200 py-2 rounded text-sm font-bold">
                Back to Dashboard
            </a>
        </form>

    </div>
</div>

@endsection
