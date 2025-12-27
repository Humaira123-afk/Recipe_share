@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-orange-500 text-white shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-lg">RecipeShare</a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Dashboard</a>
            <a href="{{ route('admin.recipes') }}" class="px-3 py-1 rounded bg-orange-700 hover:bg-orange-600 transition">Manage Recipes</a>
            <a href="{{ route('admin.users') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Manage Users</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1 rounded bg-red-500 hover:bg-red-600 transition text-white font-semibold">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="pt-20 max-w-7xl mx-auto px-4">

    <h1 class="text-2xl font-bold text-orange-500 mb-6 border-b-2 border-orange-500 inline-block pb-1">
        All Submitted Recipes
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-4 overflow-auto">
        <table class="min-w-full border-collapse">
            <thead class="bg-orange-50">
                <tr>
                    <th class="text-left text-orange-500 uppercase font-bold px-5 py-3 text-sm">ID</th>
                    <th class="text-left text-orange-500 uppercase font-bold px-5 py-3 text-sm">Recipe Title</th>
                    <th class="text-left text-orange-500 uppercase font-bold px-5 py-3 text-sm">Author</th>
                    <th class="text-left text-orange-500 uppercase font-bold px-5 py-3 text-sm">Category</th>
                    <th class="text-left text-orange-500 uppercase font-bold px-5 py-3 text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes as $recipe)
                <tr class="border-b">
                    <td class="px-5 py-4 text-gray-600">#{{ $recipe->id }}</td>
                    <td class="px-5 py-4">{{ $recipe->title }}</td>
                    <td class="px-5 py-4">{{ $recipe->user->name ?? 'Unknown' }}</td>
                    <td class="px-5 py-4"><span class="font-bold text-black uppercase text-xs">{{ $recipe->category }}</span></td>
                    <td class="px-5 py-4 flex gap-4">
                        <a href="{{ route('recipes.show', $recipe->id) }}" target="_blank" class="text-orange-500 font-bold text-xs uppercase hover:underline">View</a>
                        <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Delete this recipe?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-bold text-xs uppercase hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-400 py-16">No recipes found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
