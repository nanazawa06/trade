<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Area;
use App\Models\Post;
use App\Models\Review;
use App\Models\Chat;
use App\Models\Proposal;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'area_id',
        'profile',
        'profile_icon'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function area()
    {
        return $this->belongsto(Area::class);
    }
    
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    public function posts()
    {
       return $this->hasMany(Post::class);
    }
    public function send_reviews()
    {
        return $this->hasMany(Review::class, 'sender_id');
    }
    public function receive_reviews()
    {
        return $this->hasMany(Review::class, 'receiver_id');
    }
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
