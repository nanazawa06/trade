<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Image;
use App\Models\Give;
use App\Models\Proposal;
use App\Models\State;
use App\Models\Want;
use App\Models\Chat;

class Post extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function state()
    {
        return $this->hasOne(State::class);
    }
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    public function wants()
    {
        return $this->hasMany(Want::class);
    }
    public function gives()
    {
        return $this->hasMany(Give::class);
    }
}
