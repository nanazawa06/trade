<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Area;
use App\Models\State;
use App\Models\Item;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post, Area $area)
    {
        return view('posts.index')->with([
           'posts' => $post->get(),
           'areas' => $area->get(),
           ]);
    }
    
     public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }

    public function create(State $state)
    {
        return view('posts.create')->with(['states' => $state->get()]);
    }

    public function store(Post $post, Request $request)
    {
        //user_idとdescriptionをpostsテーブルに保存
        $post = new Post();
        $post->description = $request->input('description');
        $user = $request->user();
        $post->user_id = $user->id;
        $post->state_id = $request->input('state_id');
        $post->save();
        
        //画像をimagesテーブルに保存
        
            $images = $request->file('images');
            //dd($images);
            //foreach ($images as $image) {
                 $image_url = Cloudinary::upload($images->getRealPath())->getSecurePath();
                // Imageモデルにデータを保存
                $post->images()->create([
                    'image_url' => $image_url,
                ]);
                //}
        
        //欲しいグッズ一覧をitemsテーブルに保存
        
        $wants = $request['wants'];
        foreach ($wants as $item_name)
        {
            $want = Item::firstOrCreate(['name' => $item_name]);
            $post->wants()->attach($want->id);
        }
        return redirect('/posts/' . $post->id);
    }
    
    public function message(Post $post, Chat $chat, Request $request)
    {
         //messageをchatsテーブルに保存
        $iput_chat = $request['chat'];
        $chat->fill($input_chat)->save();
        /* 
        $chat->message = $request('message');
        $chat->user_id = $user->id;
        $chat->post_id = $request('post_id');
        $chat->save();
        */
        return redirect("/posts/" . $post->id);
    }
}
