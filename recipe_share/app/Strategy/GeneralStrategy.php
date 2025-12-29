<?php

namespace App\Strategies;
use App\Models\User;

class GeneralStrategy implements Strategy
{
   public function suggest(User $user)
    {
     $recipes = Recipe::all();
     return "General Strategy";
}
}