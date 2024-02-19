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
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'status',
        'user_id',
        'state_id',
        ];
        
    public function getLatest($wants=null, $gives=null, $area=null, $limit_count = 20)
    {
        $query = Post::with(['images', 'gives', 'wants'])->where('status', 'trading')->orderBy('created_at', 'DESC');

        if ($area) {
            $query = $query->whereHas('user', function ($query) use ($area) {
                $query->where('area_id', $area);
            });
        }
       // want検索フォームにキーワードが入力されたら
        if ($wants) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($wants, 's');

            // 単語を半角スペースで区切り、配列にする
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            // 単語をループで回し、wantsリレーション先のアイテム名と部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query = $query->whereHas('gives', function ($query) use ($value) {
                       $query->where('name', 'like', '%'.$value.'%');
                   });
            }
        }
        //give検索フォームにキーワードが入力されたら
        if ($gives) {
            $spaceConversion = mb_convert_kana($gives, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched as $value) {
                $query = $query->whereHas('wants', function ($query) use ($value) {
                       $query->where('name', 'like', '%'.$value.'%');
                   });
            }
        }
        
        return $posts = $query->paginate($limit_count);
    }

    // ユーザーのマイリストからそのグッズを求めている出品のリストを返す
    public function getRecommends()
    {
        $mygoods = Auth::user()->mygoods()->pluck('name')->all();
        $recommends = collect();
        
        foreach($mygoods as $goods) {
            $spaceConversion = mb_convert_kana($goods, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            $query = Post::with(['images', 'gives', 'wants'])->where('status', 'trading')->orderBy('created_at', 'DESC');

            foreach($wordArraySearched as $word) {
                $query = $query->whereHas('wants', function($query) use ($word) {
                    $query->where('name', 'like', '%'.$word.'%');
                });
            }

            $recommends = $recommends->union($query->get());
        }

        return $recommends;
    }
        
    //いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool 
    {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
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
     public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
