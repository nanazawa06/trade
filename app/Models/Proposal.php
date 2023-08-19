<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Chat;
use App\Models\Review;

class Proposal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'post_id',
        'user_id',
        'want_item',
        'give_item',
        'status',
        'message',
        ];
    
    //受け取ったリクエストを取得
    public function getProposals($user_id, $limit_count=20)
    {
        $posts = User::find($user_id)->posts;
        $proposals = collect();
        foreach ($posts as $post)
        {
            $proposals = $proposals->merge($post->proposals);
        }
        return $proposals->filter(function($proposal){return $proposal->status == 'requesting';})->sortByDesc('created_at');
    }
    
    //取引中のデータを取得
    public function getDealings()
    {
        $user_id = Auth::id();
        $proposals = collect();
        foreach (Auth::user()->posts as $post)
        {
            //自分の出品で取引中のものを取得
            $dealingRequested = $this->where('post_id', $post->id)->where('status', 'dealing')->get();
            
            $proposals = $proposals->merge($dealingRequested);
        }
        //他ユーザーの出品で取引中のものを取得
        $dealingRequest = $this->where('user_id', $user_id)->where('status', 'dealing')->get();

        return $proposals->merge($dealingRequest);
    }
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function chats()
    {
        return $this->morphMany(Chat::class, 'chatable');
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
