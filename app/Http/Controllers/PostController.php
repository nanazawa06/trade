<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Post;
use App\Models\Area;
use App\Models\State;
use App\Models\Item;
use Cloudinary;
use App\Models\Like;
use App\Models\Chat;
use App\Models\Review;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $wants = $request->input('want');
        $gives = $request->input('give');
        $area_id = $request->input('area');
        $areas = Area::all();
        $post = new Post();
        return view('posts.index')->with([
           'posts' => $post->getlatest($want=$wants, $give=$gives,$area=$area_id),
           'areas' => $areas,
           ]);
    }
    
     public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'likes' => $post->likes()->count(),
            'review_score' => $post->user->averageScore()
            ]);
    }

    public function create()
    {
        $state = State::all();
        return view('posts.create')->with(['states' => $state]);
    }

    public function store(PostRequest $request)
    {
        $post = new Post();
        
        //user_idとdescriptionをpostsテーブルに保存
        $post->description = $request->input('description');
        $user = $request->user();
        $post->user_id = $user->id;
        $post->state_id = $request->input('state_id');
        $post->save();
        
        //画像をimagesテーブルに保存
        if ($request->hasFile('images')){
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
        
        $gives = $request['gives'];
        foreach ($gives as $item_name)
        {
            $give = Item::firstOrCreate(['name' => $item_name]);
            $post->gives()->attach($give->id);
        }
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        $states = State::all();
        return view('posts.edit')->with([
            'post' => $post,
            'states' => $states
            ]);
    }
    
    public function update(Request $request, Post $post)
    {
        //出品の編集を反映
        if ($request->input('state_id')){
            $request->validate([
                'description' => 'nullable|max:500',
                'state_id' => 'required',
                'images.*' => 'mimes:jpg,png,gif|required|min:1',
                'gives.*' => 'required|max:30',
                'wants.*' => 'required|max:30',
                ]);
            //user_idとdescriptionをpostsテーブルに保存
            $post->description = $request->input('description');
            $user = $request->user();
            $post->user_id = $user->id;
            $post->state_id = $request->input('state_id');
            $post->save();
            
            //画像をimagesテーブルに保存
            if ($request->hasFile('images')){
                $images = $request->file('images');
                $num = 0;
                foreach ($images as $image) {
                     $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    // Imageモデルにデータを保存
                    $image = $post->images[$num];
                    $image->image_url = $image_url;
                    $image->save();
                    $num++;
                    }
                    
            }
                    
            //欲しいグッズ一覧をitemsテーブルに保存
            $wants = $request['wants'];
            $wantIds = [];
            foreach ($wants as $item_name) {
                $want = Item::firstOrCreate(['name' => $item_name]);
                $wantIds[] = $want->id;
            }
            
            $post->wants()->sync($wantIds);
            
            $gives = $request['gives'];
            $giveIds = [];
            foreach ($gives as $item_name) {
                $give = Item::firstOrCreate(['name' => $item_name]);
                $giveIds[] = $give->id;
            }
            
            $post->gives()->sync($giveIds);
        }
        elseif ($request->has(['chat'])){
             //messageをchatsテーブルに保存
            $request->validate([
                'chat.message' => 'max:200'
                ]);
            $input_chat = $request['chat'];
            $post->chats()->create([
                        'user_id' => $input_chat['user_id'],
                        'message' => $input_chat['message'],
                    ]);
        }else{
            //出品を停止する
            $post->status = 'finished';
            $post->save();
            return redirect('/');
        }
        
        
        return redirect('/posts/' . $post->id);
    }
    
    public function review(ReviewRequest $request)
    {
        $input_review = $request['review'];
        $existingReview = Review::where('proposal_id', $input_review['proposal_id'])
                            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'レビューは投稿済みです');
        }
        
        $review = new Review();
        $review->fill($input_review)->save();
        $proposal = Proposal::find($input_review['proposal_id'])->first();
        $proposal->status = 'finished';
        $proposal->save();
        return redirect('/');
    }
    
    public function like(Request $request)
    {
        
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $post_id = $request->post_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.
    
        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }

}
