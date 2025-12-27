<nav class="bg-orange-500 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center py-3 px-4">
        <a href="{{ route('dashboard') }}" class="font-bold text-xl">RecipeShare</a>
        <div class="space-x-4">
            @auth
                <a href="{{ route('recipes.index') }}" class="hover:underline">Browse Recipes</a>
                <a href="{{ route('recipes.create') }}" class="hover:underline">Share Recipe</a>
                <a href="{{ route('recipes.saved') }}" class="hover:underline">My Saves</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </div>
    </div>
</nav>