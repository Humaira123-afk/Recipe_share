<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title', 'ingredients', 'steps', 'category', 'image', 'user_id'];

    // Relationships
    public function user() { 
        return $this->belongsTo(User::class); 
    }

    public function likes() { 
        return $this->hasMany(Like::class); 
    }

    public function comments() { 
        return $this->hasMany(Comment::class); 
    }
}