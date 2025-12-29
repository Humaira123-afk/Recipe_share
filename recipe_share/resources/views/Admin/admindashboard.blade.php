@extends('layouts.app')
@section('title', 'Admin Panel')

@section('content')

<style>
body {
    overflow: hidden;
    margin: 0;
    padding: 0;
}


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

.page-center {
    position: fixed;
    inset: 0;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 60px;
}


.admin-card {
    width: 95%;
    max-width: 900px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 25px;
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    max-height: 85vh;
}


.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.stat-box {
    background: #fff7ed;
    border: 1px solid #ffedd5;
    padding: 15px;
    text-decoration: none;
    display: block;
}

.stat-box h3 {
    margin: 0;
    font-size: 11px;
    color: #9a3412;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stat-box p {
    margin: 5px 0 0 0;
    font-size: 24px;
    font-weight: 800;
    color: #f97316;
}


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
    padding: 12px;
    text-align: left;
    border-bottom: 2px solid #f97316;
    z-index: 10;
}

.admin-table td {
    padding: 12px;
    font-size: 13px;
    border-bottom: 1px solid #f3f4f6;
    color: #4b5563;
}


.btn-del {
    color: #ef4444;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 800;
    background: none;
    border: none;
    cursor: pointer;
}

.btn-view {
    color: #f97316;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
}


.table-area::-webkit-scrollbar { width: 5px; }
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
                <button type="submit" class="logout-btn" style="color: #fee2e2;">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-center">
    <div class="admin-card">
        
        <h2 style="font-size: 18px; font-weight: 800; text-transform: uppercase; margin-bottom: 20px; color: #111827;">
            @if(request()->is('*dashboard')) Dashboard Overview
            @elseif(request()->is('*recipes*')) Manage Recipes
            @else Manage Users @endif
        </h2>

        @if(request()->is('*dashboard'))
            <div class="stats-grid">
                <a href="{{ route('admin.recipes') }}" class="stat-box">
                    <h3>Total Recipes</h3>
                    <p>{{ $f ?? count($recipes) }}</p>
                </a>
                <a href="{{ route('admin.users') }}" class="stat-box">
                    <h3>Total Users</h3>
                    <p>{{ $users_count ?? (isset($users) ? count($users) : 0) }}</p>
                </a>
            </div>
        @endif

        <div class="table-area">
            <table class="admin-table">
                @if(!request()->is('*users*'))
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recipes as $recipe)
                        <tr>
                            <td style="font-weight: 600; color: #111827;">{{ $recipe->title }}</td>
                            <td>{{ $recipe->user->name ?? 'Unknown' }}</td>
                            <td style="color: black;">{{ $recipe->category }}</td>
                            <td style="text-align:right;">
                                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" target="_blank" class="btn-view">View</a>
                                    <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Delete recipe?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-del">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align:center; padding: 20px;">No recipes found.</td></tr>
                        @endforelse
                    </tbody>
                @else
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td style="font-weight: 600; color: #111827;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="text-align:right;">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-del">Delete User</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align:center; padding: 20px;">No users found.</td></tr>
                        @endforelse
                    </tbody>
                @endif
            </table>
        </div>

    </div>
</div>

@endsection