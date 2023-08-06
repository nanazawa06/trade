<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Item;
use App\Models\Proposal;
use App\Models\State;
use App\Models\Chat;
use Cloudinary;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'user_id',
        'state_id',
        ];
        
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
        return $this->belongsTo(State::class);
    }
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
    public function chats()
    {
        return $this->morphMany(Chat::class, 'chatable');
    }
    public function wants()
    {
        return $this->belongsToMany(Item::class, 'wants');
    }
    public function gives()
    {
        return $this->belongsToMany(Item::class, 'gives');
    }
    
    
}
