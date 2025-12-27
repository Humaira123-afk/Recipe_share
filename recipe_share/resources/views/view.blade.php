@extends('layouts.app')
@section('title', $recipe->title)

@section('content')
<div class="flex justify-center py-12 px-4">
    <div class="bg-white rounded-xl shadow-md w-full max-w-3xl p-6">

        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-56 sm:h-64 object-cover rounded-lg mb-5">
        @endif

        <h1 class="text-2xl font-bold text-orange-500 mb-3">{{ $recipe->title }}</h1>

        <div class="text-gray-600 text-sm flex flex-wrap gap-4 mb-5">
            <span><i class="fa fa-tag"></i> {{ $recipe->category }}</span>
            <span><i class="fa fa-user"></i> {{ $recipe->user->name ?? 'User' }}</span>
            <span><i class="fa fa-calendar"></i> {{ $recipe->created_at->format('M d, Y') }}</span>
        </div>

        <h3 class="font-semibold text-gray-700 mb-1">Ingredients</h3>
        <p class="bg-gray-50 p-4 rounded mb-5 whitespace-pre-wrap text-gray-800 leading-relaxed">{{ $recipe->ingredients }}</p>

        <h3 class="font-semibold text-gray-700 mb-1">Directions</h3>
        <p class="bg-gray-50 p-4 rounded mb-5 whitespace-pre-wrap text-gray-800 leading-relaxed">{{ $recipe->steps }}</p>

        <div class="flex flex-wrap items-start gap-4 mb-8">

            <div class="flex flex-col items-center">
                <form action="{{ route('recipes.like', $recipe->id) }}" method="POST">
                    @csrf
                    <button class="px-5 py-2.5 bg-orange-500 text-white rounded-lg font-bold hover:bg-orange-600 transition flex items-center gap-2 shadow-sm">
                        <i class="fa fa-thumbs-up"></i> Like
                    </button>
                </form>
                <span class="text-gray-500 text-xs mt-1.5 cursor-pointer hover:text-orange-500 transition" onclick="openLikesModal()">
                    {{ $recipe->likes->count() }} {{ $recipe->likes->count() == 1 ? 'like' : 'likes' }}
                </span>
            </div>

            @auth('web')
            <div class="flex flex-col">
                <form action="{{ route('recipes.save', $recipe->id) }}" method="POST">
                    @csrf
                    <button class="px-5 py-2.5 bg-slate-700 text-white rounded-lg font-bold hover:bg-slate-800 transition flex items-center gap-2 shadow-sm">
                        <i class="fa {{ auth()->user()->savedRecipes()->where('recipe_id', $recipe->id)->exists() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i> Save
                    </button>
                </form>
            </div>

            @if(auth()->id() === $recipe->user_id)
                <div class="flex gap-2">
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition border border-gray-200">
                        Edit
                    </a>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Delete this recipe?')">
                        @csrf @method('DELETE')
                        <button class="px-5 py-2.5 bg-red-50 text-red-600 rounded-lg font-bold hover:bg-red-600 hover:text-white transition border border-red-200">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
            @endauth
        </div>

        <div id="likesModal" class="fixed inset-0 bg-black/60 hidden justify-center items-center z-50 backdrop-blur-sm">
            <div class="bg-white p-6 rounded-xl max-w-sm w-full shadow-2xl relative mx-4">
                <span class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 cursor-pointer text-2xl" onclick="closeLikesModal()">&times;</span>
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Liked by</h3>
                <ul class="space-y-3 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($recipe->likes as $like)
                        @if($like->user)
                            <li class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition">
                                <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
                                    <i class="fa fa-user"></i>
                                </div>
                                <span class="font-medium text-gray-700">{{ $like->user->name }}</span>
                            </li>
                        @endif
                    @empty
                        <li class="text-gray-400 text-center py-4">No likes yet</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <hr class="my-8 border-gray-100">

        <h4 class="text-lg font-bold mb-5 flex items-center gap-2">
            <i class="fa fa-comments text-gray-400"></i>
            Comments ({{ $recipe->comments->count() }})
        </h4>

        <div class="space-y-4 mb-8">
            @foreach($recipe->comments as $comment)
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm transition hover:border-orange-200">
                    <div class="flex justify-between items-start mb-2">
                        <strong class="text-orange-600 font-semibold">{{ $comment->user->name ?? 'Deleted User' }}</strong>
                        <small class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>

        @auth('web')
        <form action="{{ route('recipes.comment', $recipe->id) }}" method="POST" class="space-y-4 bg-orange-50 p-5 rounded-xl">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-orange-800 mb-1">Join the conversation</label>
                <textarea name="body" rows="3" placeholder="What do you think about this recipe?" required 
                class="w-full p-3 border border-orange-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition"></textarea>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="bg-orange-500 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-orange-600 shadow-md transition transform active:scale-95">
                    Post Comment
                </button>
                <a href="{{ route('recipes.index') }}" class="bg-white text-gray-600 border border-gray-200 px-6 py-2.5 rounded-lg font-bold hover:bg-gray-50 transition">
                    Back to Feed
                </a>
            </div>
        </form>
        @else
        <p class="text-center text-gray-500 bg-gray-50 p-4 rounded-lg">Please <a href="{{ route('login') }}" class="text-orange-500 font-bold underline">login</a> to leave a comment.</p>
        @endauth

    </div>
</div>

<script>
function openLikesModal() {
    const modal = document.getElementById('likesModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden'; // Prevent scroll
}

function closeLikesModal() {
    const modal = document.getElementById('likesModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto'; // Re-enable scroll
}

window.addEventListener('click', function(e) {
    const modal = document.getElementById('likesModal');
    if(e.target === modal){
        closeLikesModal();
    }
});
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ed8936; border-radius: 10px; }
</style>
@endsection