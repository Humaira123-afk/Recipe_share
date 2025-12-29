<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Save;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
   
    public function welcome() {
        return view('welcome');
    }
    

    public function index(Request $request) {
        $search = $request->input('search');
        $recipes = Recipe::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('category', 'like', "%{$search}%");
        })->latest()->get();

        return view('index', compact('recipes')); 
    }


    public function show($id) {
        $recipe = Recipe::with(['user', 'likes', 'comments.user'])->findOrFail($id); 
        return view('view', compact('recipe')); 
    }

   
    
    public function savedRecipes() {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        
        $recipes = Recipe::whereIn('id', function($query) use ($user) {
            $query->select('recipe_id')->from('saves')->where('user_id', $user->id);
        })->latest()->get();

        return view('index', compact('recipes'));
    }

    public function saveRecipe($id) {
        if (!Auth::check()) return redirect()->route('login');

        $exists = Save::where('user_id', Auth::id())->where('recipe_id', $id)->first();
        if (!$exists) {
            Save::create(['user_id' => Auth::id(), 'recipe_id' => $id]);
        } else {
            $exists->delete();
        }
        return back();
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'steps' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('recipes', 'public') 
            : null;

        Recipe::create([
            'title' => $request->title,
            'ingredients' => $request->ingredients,
            'steps' => $request->steps,
            'category' => $request->category,
            'image' => $imagePath,
            'user_id' => Auth::id(), 
        ]);

        return redirect()->route('recipes.index')->with('success', 'Recipe added!');
    }

    public function edit($id) {
        $recipe = Recipe::findOrFail($id);
        if (Auth::guard('admin')->check() || (Auth::check() && $recipe->user_id === Auth::id())) {
            return view('edit', compact('recipe'));
        }
        return redirect()->route('recipes.index')->with('error', 'No permission!');
    }

    public function update(Request $request, $id) {
        $recipe = Recipe::findOrFail($id);
        if (Auth::guard('admin')->check() || (Auth::check() && $recipe->user_id === Auth::id())) {
            $request->validate([
                'title' => 'required',
                'ingredients' => 'required',
                'steps' => 'required',
                'category' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $data = $request->except(['_token', '_method', 'image']);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('recipes', 'public');
            }

            $recipe->update($data);
            return redirect()->route('recipes.index')->with('success', 'Recipe updated!');
        }
        return redirect()->route('recipes.index')->with('error', 'Unauthorized!');
    }

    public function destroy($id) {
        $recipe = Recipe::findOrFail($id);
        if (Auth::check() && Auth::id() === $recipe->user_id) {
            $recipe->delete();
            return redirect()->route('recipes.index')->with('success', 'Recipe deleted!');
        }
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function like($id) {
        if (!Auth::check()) return redirect()->route('login');
        
        $exists = Like::where('user_id', Auth::id())->where('recipe_id', $id)->first();
        if (!$exists) {
            Like::create(['user_id' => Auth::id(), 'recipe_id' => $id]);
        } else {
            $exists->delete();
        }
        return back();
    }

    public function comment(Request $request, $id) {
        if (!Auth::check()) return redirect()->route('login');
        
        $request->validate(['body' => 'required']);
        Comment::create([
            'user_id' => Auth::id(),
            'recipe_id' => $id,
            'body' => $request->body
        ]);
        return back();
    }

   
    public function adminIndex() {
        $recipes = Recipe::with('user')->latest()->get();
        $recipes_count = $recipes->count();
        $users_count = User::count(); 
        return view('Admin.admindashboard', compact('recipes', 'recipes_count', 'users_count'));
    }

    public function adminRecipes() {
        $recipes = Recipe::with('user')->latest()->get();
        return view('Admin.manage_recipes', compact('recipes'));
    }

    public function adminUsers() {
        $users = User::all();
        return view('Admin.manageusers', compact('users'));
    }

    public function destroyUser($id) {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User deleted!');
    }

    public function adminDestroyRecipe($id) {
        Recipe::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Recipe deleted by Admin!');
    }

    
    public function suggest() {
        return view('suggest');
    }

 
public function generate(Request $request)
{
    if (!$request->ingredients || trim($request->ingredients) === '') {
        return redirect()->route('recipes.suggest')
                         ->with('error', 'You have to type ingredients first!');
    }

    $userIngredients = collect(explode(',', strtolower($request->ingredients)))
        ->map(fn($i) => trim($i));

    $recipes = json_decode(file_get_contents(storage_path('app/recipes.json')), true);

    $results = [];

    foreach ($recipes as $recipe) {
        $recipeIngredients = collect($recipe['ingredients'])
            ->map(fn($i) => strtolower(trim($i)));

        $matchedCount = $recipeIngredients->intersect($userIngredients)->count();

        if ($matchedCount >= 2) {
            $results[] = [
                'title' => $recipe['title'],
                'ingredients' => $recipe['ingredients'], 
                'steps' => $recipe['steps'],
                'match' => round(($matchedCount / $recipeIngredients->count()) * 100),
                'matched_count' => $matchedCount
            ];
        }
    }

    $results = collect($results)->sortByDesc('match')->values()->all();

    return view('suggest', compact('results', 'userIngredients'));
}


}



