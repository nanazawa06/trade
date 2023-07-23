<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Post;

class Give extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'gives');
    }
    public function Items()
    {
        return $this->belongsToMany(Item::class, 'gives');
    }
}
