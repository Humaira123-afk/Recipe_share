@extends('layouts.app') {{-- Common layout --}}

@section('content')
<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-orange-500 text-white shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-lg">RecipeShare</a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Dashboard</a>
            <a href="{{ route('admin.recipes') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Manage Recipes</a>
            <a href="{{ route('admin.users') }}" class="px-3 py-1 rounded hover:bg-orange-600 transition">Manage Users</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1 rounded bg-red-500 hover:bg-red-600 transition text-white">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="pt-20 max-w-7xl mx-auto px-4">

    @if(request()->is('*dashboard'))
        <h1 class="text-2xl font-bold text-orange-500 mb-6 border-b-4 border-orange-500 inline-block">Dashboard Overview</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <a href="{{ route('admin.recipes') }}" class="bg-white border p-4 rounded shadow hover:shadow-md transition">
                <h3 class="text-gray-600 uppercase text-xs font-semibold">Total Recipes</h3>
                <p class="text-orange-500 text-2xl font-bold">{{ $recipes_count ?? count($recipes) }}</p>
            </a>
            <a href="{{ route('admin.users') }}" class="bg-white border p-4 rounded shadow hover:shadow-md transition">
                <h3 class="text-gray-600 uppercase text-xs font-semibold">Total Users</h3>
                <p class="text-orange-500 text-2xl font-bold">{{ $users_count ?? (isset($users) ? count($users) : 0) }}</p>
            </a>
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-auto">
        <div class="p-4 border-b">
            <h2 class="text-gray-800 font-semibold text-lg">
                @if(request()->is('*dashboard')) Recent Submissions
                @elseif(request()->is('*recipes*')) All Recipes
                @else All Users
                @endif
            </h2>
        </div>

        @if(!request()->is('*users*'))
        <table class="min-w-full border-collapse">
            <thead class="bg-orange-50">
                <tr>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">ID</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Recipe Title</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Author</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Category</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes as $recipe)
                <tr class="border-b">
                    <td class="p-3">#{{ $recipe->id }}</td>
                    <td class="p-3">{{ $recipe->title }}</td>
                    <td class="p-3">{{ $recipe->user->name ?? 'Unknown' }}</td>
                    <td class="p-3 category-text">{{ $recipe->category }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('recipes.show', $recipe->id) }}" target="_blank" class="text-orange-500 font-semibold uppercase hover:underline text-sm">View</a>
                        <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Delete this recipe?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold uppercase hover:underline text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-3">No recipes found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @else
        <table class="min-w-full border-collapse">
            <thead class="bg-orange-50">
                <tr>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">User ID</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Full Name</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Email Address</th>
                    <th class="p-3 text-left text-orange-500 font-bold uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b">
                    <td class="p-3">#{{ $user->id }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold uppercase hover:underline text-sm">Delete User</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center p-3">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
