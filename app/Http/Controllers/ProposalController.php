<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Cloudinary;
use App\Notifications\RequestNotification;

class ProposalController extends Controller
{
    //リクエスト一覧の表示
    public function indexRequests()
    {
        $proposal = new Proposal();
        $user_id = Auth::id();
        return view('users.requests')->with(['proposals' => $proposal->getProposals($user_id)]);
    }
    
    //トレードリクエストを送る
    public function storeRequest(Request $request)
    {
        $proposal = new Proposal();
        $input_request = $request['offer'];
        
        $request->validate([
            'offer.want_item' => 'required',
            'offer.give_item' => 'required',
        ]);
        
        $proposal->fill($input_request)->save();
        
        // Imageモデルに画像を保存
        if ($request->hasFile('images')){
            $images = $request->file('images');
            foreach ($images as $image) {
                 $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $proposal->images()->create([
                    'image_url' => $image_url,
                    ]);
                }
        }
        $requested_user = $proposal->post->user;
        $requested_user->notify(new RequestNotification($proposal));
        
        return redirect('/');
    }
    
    //リクエスト詳細を表示
    public function showRequest(Proposal $proposal)
    {
        return view('posts.show_request')->with([
            'proposal' => $proposal,
            'review_score' => $proposal->user->averageScore(),
            ]);
    }
    
    public function updateDeal(Proposal $proposal, Request $request)
    {
        //リクエストが承諾されたときの処理
        //proposalsテーブルのstatusをdealingに変更する
        $proposal->status = 'dealing';
        $proposal->save();
        return view('posts.deal')->with([
            'proposal' => $proposal,
            'review_score' => $proposal->user->averageScore(),
            ]);
    }
    
    //取引をキャンセルされるとリクエストを削除
    public function deleteProposal(Proposal $proposal)
    {
        $proposal->images()->delete();
        $proposal->delete();
        return redirect('/');
    }
    
    //取引画面を表示
    public function showDealing(Proposal $proposal)
    {
        return view('posts.deal')->with([
            'proposal' => $proposal,
            'review_score' => $proposal->user->averageScore(),
            ]);
    }
    
    //取引中一覧を表示
    public function indexDealing()
    {
        $proposal = new Proposal();
        return view('users.dealing')->with(['dealings' => $proposal->getDealings()]);
    }

}
