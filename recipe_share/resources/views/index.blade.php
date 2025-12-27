@extends('layouts.app')
@section('title','All Recipes')

@section('content')
<!-- Full screen wrapper -->
<div class="flex justify-center py-12 px-4">
    <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg p-8 overflow-hidden" style="min-height: 650px;">

        <h1 class="text-2xl font-bold text-center text-orange-500 mb-6">All Recipes</h1>

        <!-- Header Actions -->
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
            @auth('web')
                <a href="{{ route('recipes.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded font-bold hover:bg-orange-600 transition">Add New Recipe</a>
            @endauth

            <form action="{{ route('recipes.index') }}" method="GET" class="flex">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="border rounded-l px-3 py-2 outline-none">
                <button type="submit" class="bg-white border border-l-0 px-3 py-2 rounded-r cursor-pointer hover:bg-gray-100 transition">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Table -->
        @if($recipes->isEmpty())
            <p class="text-center text-gray-600">No recipes found.</p>
        @else
            <div class="overflow-auto" style="max-height: 400px;">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 border">Title</th>
                            <th class="p-3 border">Category</th>
                            <th class="p-3 border">Date Posted</th>
                            <th class="p-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)
                        <tr>
                            <td class="p-3 border">{{ $recipe->title }}</td>
                            <td class="p-3 border">{{ $recipe->category }}</td>
                            <td class="p-3 border">{{ $recipe->created_at->format('d M, Y') }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-orange-500 font-bold hover:underline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Back button -->
        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="bg-orange-500 text-white px-4 py-2 rounded font-bold hover:bg-orange-600 transition">Back to Dashboard</a>
        </div>

    </div>
</div>
@endsection
