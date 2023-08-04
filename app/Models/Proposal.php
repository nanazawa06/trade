<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Chat;

class Proposal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'post_id',
        'user_id',
        'want_item',
        'give_item',
        ];
        
    public function getProposal($post_id, $user_id)
    {
        $this->where('post_id', $post_id)->where('user_id', '!=', $user_id)->delete();
        
        return $this->where('post_id', $post_id)->first();
    }
    
    public function getProposals($user_id, $limit_count=20)
    {
        $posts = User::find($user_id)->posts;
        $proposals = collect();
        foreach ($posts as $post)
        {
            $proposals = $proposals->merge($post->proposals);
        }
        return $proposals->sortByDesc('created_at');
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
}
