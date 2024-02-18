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
use App\Models\Like;
use App\Models\Mygoods;

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
    
    //ユーザー評価の平均値を取得
    public function averageScore()
    {
        $sum = 0;
        $reviews = $this->receive_reviews;
        $count = $reviews->count();
        
        return $count > 0 ? $reviews->avg('score') : 0;
    }
    
    //ユーザーの出品を取得
    public function getUserPosts()
    {
        return $this->posts()->with(['images', 'wants'])->orderBy('created_at', 'DESC')->get();
    }

    public function routeNotificationForMail()
    {
        return $this->email; // ユーザーのメールアドレスを返す
    }
    
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
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function mygoods()
    {
        return $this->hasMany(Mygoods::class);
    }
}