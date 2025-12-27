@extends('layouts.app')
@section('title', 'Manage Recipes')

@section('content')

<style>
/* DISABLE PAGE SCROLL */
body {
    overflow: hidden;
    margin: 0;
    padding: 0;
}

/* NAVBAR - Fixed & Sharp */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #f97316;
    color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    z-index: 1000;
    height: 60px;
    display: flex;
    align-items: center;
}

.navbar-container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-sizing: border-box;
}

.brand {
    font-size: 20px;
    font-weight: 800;
    text-decoration: none;
    color: white !important;
    text-transform: uppercase;
}

.nav-links {
    display: flex;
    gap: 15px;
    align-items: center;
}

.nav-link, .logout-btn {
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    background: none;
    border: none;
    cursor: pointer;
}

/* CENTERED PAGE WRAPPER */
.page-center {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 60px;
}

/* MAIN CARD */
.admin-card {
    width: 95%;
    max-width: 1000px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 25px;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    max-height: 85vh;
}

/* TABLE AREA - Internal Scroll */
.table-area {
    flex: 1;
    overflow-y: auto;
    border: 1px solid #f3f4f6;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th {
    position: sticky;
    top: 0;
    background: #f9fafb;
    color: #374151;
    font-size: 11px;
    text-transform: uppercase;
    padding: 15px;
    text-align: left;
    border-bottom: 2px solid #f97316;
    z-index: 10;
}

.admin-table td {
    padding: 15px;
    font-size: 13px;
    border-bottom: 1px solid #f3f4f6;
    color: #4b5563;
}

/* ACTION BUTTONS */
.btn-del {
    color: #ef4444;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600; /* Made simpler */
    background: none;
    border: none;
    cursor: pointer;
}

.btn-view {
    color: #f97316;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600; /* Made simpler */
    text-decoration: none;
}

/* SCROLLBAR */
.table-area::-webkit-scrollbar { width: 6px; }
.table-area::-webkit-scrollbar-track { background: #f1f1f1; }
.table-area::-webkit-scrollbar-thumb { background: #d1d5db; }
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">Admin Panel</a>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Overview</a>
            <a href="{{ route('admin.recipes') }}" class="nav-link">Recipes</a>
            <a href="{{ route('admin.users') }}" class="nav-link">Users</a>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-center">
    <div class="admin-card">
        
        <h2 style="font-size: 16px; font-weight: 700; text-transform: uppercase; margin-bottom: 20px; color: #111827;">
            All Submitted Recipes
        </h2>

        @if(session('success'))
            <div style="background: #f0fdf4; color: #166534; padding: 10px; font-size: 12px; margin-bottom: 15px; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-area">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recipes as $recipe)
                    <tr>
                        <td style="color: #9ca3af;">#{{ $recipe->id }}</td>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ $recipe->user->name ?? 'Unknown' }}</td>
                        <td>{{ $recipe->category }}</td> <td style="text-align:right;">
                            <div style="display: flex; justify-content: flex-end; gap: 15px;">
                                <a href="{{ route('recipes.show', $recipe->id) }}" target="_blank" class="btn-view">View</a>
                                <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Delete this recipe?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-del">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 40px; color: #9ca3af;">No recipes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection