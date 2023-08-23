<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Chat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'message',
        'user_id',
        'post_id',
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chatable()
    {
        return $this->morphTo();
    }
}
