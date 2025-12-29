<?php

namespace App\Strategies;
use App\Models\User;

interface SuggestionStrategy 
{
    public function suggest(User $user);
}
