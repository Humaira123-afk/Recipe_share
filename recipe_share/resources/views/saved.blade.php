@extends('layouts.app')
@section('title','Saved Recipes')

@section('content')
<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-orange-500 text-white shadow-md z-50 h-[64px]">
    <div class="max-w-7xl mx-auto px-4 h-full flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-lg">RecipeShare</a>
        <div>
            @guest
                <a href="{{ route('login') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Login</a>
                <a href="{{ route('register') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Register</a>
            @endguest
        </div>
    </div>
</nav>

<!-- Full screen wrapper -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-100 pt-16">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-8 overflow-hidden" style="min-height: 600px;">

        <h1 class="text-2xl font-bold text-center text-orange-500 mb-6">Saved Recipes</h1>

        @if($savedRecipes->isEmpty())
            <p class="text-center text-gray-600 mb-4">
                There are no saved recipes. <a href="{{ route('recipes.index') }}" class="text-orange-500 hover:underline">Explore now!</a>
            </p>
        @else
            <div class="overflow-auto" style="max-height: 400px;">
                @foreach($savedRecipes as $save)
                    @if($save->recipe)
                        <div class="flex items-center gap-4 mb-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                            @if($save->recipe->image)
                                <img src="{{ asset('storage/' . $save->recipe->image) }}" class="w-24 h-24 object-cover rounded-lg">
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-800">{{ $save->recipe->title }}</h3>
                                <p class="text-gray-600 mb-2">Category: {{ $save->recipe->category }}</p>
                                <div class="flex gap-2 flex-wrap">
                                    <a href="{{ route('recipes.show', $save->recipe->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded font-bold hover:bg-orange-600 transition">Open</a>
                                    <form action="{{ route('recipes.save', $save->recipe->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded font-bold hover:bg-gray-700 transition">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="bg-orange-500 text-white px-4 py-2 rounded font-bold hover:bg-orange-600 transition">Back to Dashboard</a>
        </div>

    </div>
</div>
@endsection
