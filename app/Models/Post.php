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
    
    public function store(Request $request)
    {
        //user_idとdescriptionをpostsテーブルに保存
        
        $post = new Post();
        $post->description = $request->input('description');
        $user = $request->user();
        $post->user_id = $user->id;
        $post->state_id = $request->input('state_id');
        $post->save();
        
        //画像をimagesテーブルに保存
        if ($request->hasFile('images')) 
        {
            $images = $request->file('images');
            foreach ($images as $image) {
                 $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                // Imageモデルにデータを保存
                $post->images()->create([
                    'image_url' => $image_url,
                ]);
                }
        }
        
        //欲しいグッズ一覧をitemsテーブルに保存
        
        $wants = $request['wants'];
        foreach ($wants as $item_name)
        {
            $want = Item::firstOrCreate(['name' => $item_name]);
            $post->wants()->attach($want->id);
        }
        
        //譲りたいグッズ一覧をitemsテーブルに保存
        $gives = $request['gives'];
        foreach ($gives as $item_name)
        {
            $give = Item::firstOrCreate(['name' => $item_name]);
            $post->gives()->attach($give->id);
        }
        return redirect("/posts/" . $post->id);
    }
    
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
        return $this->hasMany(Chat::class);
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
