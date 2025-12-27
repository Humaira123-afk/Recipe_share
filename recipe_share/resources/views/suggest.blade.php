@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Suggest Recipes</h1>

    {{-- Error message if no ingredients provided --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Ingredients input form --}}
    <form action="{{ route('recipes.generate') }}" method="POST">
        @csrf
        <input type="text" name="ingredients" 
               value="{{ old('ingredients') }}" 
               placeholder="Enter ingredients separated by comma" 
               class="border p-2 rounded w-full mb-2">
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Generate</button>
    </form>

    {{-- Suggestions --}}
    @if(isset($results))
        <h2 class="text-xl font-semibold mt-6">Suggestions:</h2>
        @forelse($results as $recipe)
            <div class="border p-3 rounded mt-2 bg-gray-50">
                {{-- Recipe title + match % --}}
                <h3 class="font-bold">{{ $recipe['title'] }} ({{ $recipe['match'] }}% match)</h3>

                {{-- Full ingredients --}}
                <p class="font-semibold mt-2">Ingredients:</p>
                <ul class="list-disc list-inside mb-2">
                    @foreach($recipe['ingredients'] as $ingredient)
                        <li>{{ $ingredient }}</li>
                    @endforeach
                </ul>

                {{-- Recipe steps --}}
                <p class="font-semibold">Steps:</p>
                <p>{{ $recipe['steps'] }}</p>
            </div>
        @empty
            <p class="mt-2">No recipes found with your ingredients.</p>
        @endforelse
    @endif
</div>
@endsection
