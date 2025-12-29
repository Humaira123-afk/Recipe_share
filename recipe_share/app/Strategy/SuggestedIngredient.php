<?php
namespace App\Strategies;
use App\Models\User;

class SuggestedIngredient implements Strategy
{
    public function suggest(User $user)
    {
        return "Suggested Ingredient";
    }
}
