@extends('layouts.app')
@section('title', $recipe->title)

@section('content')

<style>
/* DISABLE PAGE SCROLL */
body {
    overflow: hidden;
    margin: 0;
    padding: 0;
}

/* NAVBAR - Fixed */
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
    font-size: 12px;
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
.recipe-detail-card {
    width: 90%;
    max-width: 800px;
    background-color: white;
    border-radius: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    max-height: 85vh;
    overflow: hidden;
}

/* SCROLLABLE CONTENT AREA - Gray Scrollbar */
.detail-content {
    flex: 1;
    overflow-y: auto;
    padding: 30px;
}

.detail-content::-webkit-scrollbar { width: 6px; }
.detail-content::-webkit-scrollbar-track { background: #f1f1f1; }
.detail-content::-webkit-scrollbar-thumb { background: #d1d5db; } /* Simple Gray Scroll */

/* IMAGE */
.recipe-hero-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-bottom: 4px solid #f97316;
    margin-bottom: 20px;
}

.recipe-title {
    font-size: 28px;
    font-weight: 800;
    color: #111827;
    text-transform: uppercase;
    margin: 0 0 10px 0;
}

/* ACTION BAR (Like & Save) */
.action-bar {
    display: flex;
    gap: 12px;
    margin-bottom: 25px;
    align-items: center;
}

.btn-sharp {
    padding: 10px 20px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    border: none;
    border-radius: 0;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-orange { background: #f97316; color: white; }
.btn-dark { background: #374151; color: white; }
.btn-outline { background: white; color: #374151; border: 1px solid #d1d5db; }
.btn-red { background: #ef4444; color: white; }

/* SECTIONS */
.section-label {
    font-size: 12px;
    font-weight: 800;
    color: #f97316;
    text-transform: uppercase;
    margin: 20px 0 10px 0;
    display: block;
}
.content-box {
    font-size: 14px;
    color: #374151;
    line-height: 1.6;
    white-space: pre-wrap;
    background: #f9fafb;
    padding: 15px;
    border: 1px solid #f3f4f6;
}

/* MODAL */
#likesModal {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 2000;
}
.modal-content {
    background: white;
    width: 100%;
    max-width: 350px;
    padding: 25px;
}
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('welcome') }}" class="brand">RecipeShare</a>
        <div class="nav-links">
            <a href="{{ route('recipes.index') }}" class="nav-link">Recipes</a>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="page-center">
    <div class="recipe-detail-card">
        <div class="detail-content">
            
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" class="recipe-hero-img">
            @endif

            <h1 class="recipe-title">{{ $recipe->title }}</h1>
            
            <div style="font-size: 11px; color: #6b7280; font-weight: 700; text-transform: uppercase; margin-bottom: 20px;">
                {{ $recipe->category }} | BY: {{ $recipe->user->name ?? 'USER' }} | {{ $recipe->created_at->format('d M, Y') }}
            </div>

            <div class="action-bar">
                <form action="{{ route('recipes.like', $recipe->id) }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-sharp btn-orange">LIKE</button>
                </form>

                @auth
                    <form action="{{ route('recipes.save', $recipe->id) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-sharp btn-dark">
                            {{ auth()->user()->savedRecipes()->where('recipe_id', $recipe->id)->exists() ? 'UNSAVE' : 'SAVE' }}
                        </button>
                    </form>
                @endauth

                <span style="font-size: 11px; font-weight: 800; cursor: pointer; color: #f97316; text-decoration: underline;" onclick="openLikesModal()">
                    {{ $recipe->likes->count() }} LIKES
                </span>
            </div>

            @auth
                @if(auth()->id() === $recipe->user_id)
                    <div class="action-bar" style="border-top: 1px solid #f3f4f6; padding-top: 15px;">
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn-sharp btn-outline">EDIT RECIPE</a>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('DELETE THIS RECIPE?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sharp btn-red">DELETE</button>
                        </form>
                    </div>
                @endif
            @endauth

            <span class="section-label">Ingredients</span>
            <div class="content-box">{{ $recipe->ingredients }}</div>

            <span class="section-label">Directions</span>
            <div class="content-box">{{ $recipe->steps }}</div>

            <span class="section-label" style="margin-top: 40px;">Comments ({{ $recipe->comments->count() }})</span>
            @foreach($recipe->comments as $comment)
                <div style="background: #f9fafb; padding: 12px; margin-bottom: 10px; border-left: 3px solid #f97316;">
                    <div style="display:flex; justify-content:space-between; margin-bottom: 5px;">
                        <strong style="font-size: 12px;">{{ $comment->user->name }}</strong>
                        <small style="font-size: 10px; color: #9ca3af;">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p style="font-size: 13px; margin: 0;">{{ $comment->body }}</p>
                </div>
            @endforeach

            @auth
            <form action="{{ route('recipes.comment', $recipe->id) }}" method="POST" style="background: #fff7ed; padding: 15px; margin-top: 20px;">
                @csrf
                <textarea name="body" rows="2" placeholder="WRITE A COMMENT..." required style="width:100%; border:1px solid #ddd; padding:10px; font-size:13px; border-radius:0; outline:none;"></textarea>
                <button type="submit" class="btn-sharp btn-orange" style="margin-top:10px;">POST COMMENT</button>
            </form>
            @endauth
        </div>
    </div>
</div>

<div id="likesModal" onclick="closeLikesModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <h3 style="margin:0 0 15px 0; font-size: 14px; border-bottom: 2px solid #f97316; padding-bottom: 10px; text-transform: uppercase;">Liked By</h3>
        <div style="max-height: 200px; overflow-y: auto;">
            @forelse($recipe->likes as $like)
                <div style="padding: 8px 0; border-bottom: 1px solid #f3f4f6; font-size: 13px; font-weight: 600;">{{ $like->user->name }}</div>
            @empty
                <div style="text-align: center; color: #9ca3af; padding: 15px;">No likes yet</div>
            @endforelse
        </div>
        <button onclick="closeLikesModal()" class="btn-sharp btn-dark" style="width: 100%; margin-top: 20px; justify-content: center;">CLOSE</button>
    </div>
</div>

<script>
function openLikesModal() { document.getElementById('likesModal').style.display = 'flex'; }
function closeLikesModal() { document.getElementById('likesModal').style.display = 'none'; }
</script>

@endsection