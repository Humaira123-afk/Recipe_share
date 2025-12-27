@extends('layouts.app')
@section('title','Edit Recipe')

@section('content')

<div class="flex justify-center py-12 px-4">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-6">

        <h1 class="text-2xl font-bold text-center text-orange-500 mb-6">
            Edit Recipe
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold mb-1">Recipe Title</label>
                <input type="text" name="title" value="{{ old('title', $recipe->title) }}" 
                       class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Ingredients</label>
                <textarea rows="3" name="ingredients" 
                          class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 resize-none"
                          required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Steps</label>
                <textarea rows="3" name="steps" 
                          class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 resize-none"
                          required>{{ old('steps', $recipe->steps) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category', $recipe->category) }}" 
                       class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Recipe Image</label>
                @if($recipe->image)
                    <img src="{{ asset('storage/'.$recipe->image) }}" class="mb-2 w-28 rounded border">
                @endif
                <input type="file" name="image" class="w-full text-sm">
            </div>

            <button type="submit" class="w-full bg-orange-500 text-white font-bold py-2 rounded hover:bg-orange-600 transition">
                Update Recipe
            </button>

            <a href="{{ route('recipes.index') }}" 
               class="block w-full text-center bg-gray-200 py-2 rounded font-bold hover:bg-gray-300 transition">
               Cancel
            </a>
        </form>

    </div>
</div>

@endsection
