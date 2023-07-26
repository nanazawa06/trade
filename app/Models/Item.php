<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
        ];
        
    public function wants()
    {
        return $this->belongsToMany(Post::class, 'wants');
    }
    public function gives()
    {
        return $this->belongsToMany(Post::class, 'gives');
    }
}
