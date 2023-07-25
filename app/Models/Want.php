<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Post;

class Want extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'wants');
    }
    public function Items()
    {
        return $this->belongsTo(Item::class, 'wants');
    }
}
