<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class ProposalController extends Controller
{
    public function indexRequests()
    {
        $proposal = new Proposal();
        $user_id = Auth::id();
        return view('users.requests')->with(['proposals' => $proposal->getProposals($user_id)]);
    }
    
    public function storeRequest(Request $request)
    {
        $proposal = new Proposal();
        $input_request = $request['offer'];
        
        $request->validate([
            'offer.want_item' => 'required',
            'offer.give_item' => 'required',
        ]);
        
        $proposal->fill($input_request)->save();
        
        if ($request->hasFile('images')){
            $images = $request->file('images');
            foreach ($images as $image) {
                 $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                // Imageモデルにデータを保存
                $proposal->images()->create([
                    'image_url' => $image_url,
                    ]);
                }
        }
        
        return redirect('/');
    }
    
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
        if ($proposal->status == 'requesting'){
            $proposal->status = 'dealing';
            $proposal->save();
            return view('posts.deal')->with([
                'proposal' => $proposal,
                'review_score' => $proposal->user->averageScore(),
                ]);
        }elseif ($request->has(['chat'])) {
            //messageをchatsテーブルに保存
            $input_chat = $request['chat'];
            $proposal->chats()->create([
                        'user_id' => $input_chat['user_id'],
                        'message' => $input_chat['message'],
                    ]);
            return redirect("/posts/" . $proposal->id . "/deal");
        }else{
            //取引がキャンセルされたときの処理
            $proposal->status = 'rejected';
            $proposal->save();
            return redirect('/');
        }
    }
    
    public function showDealing(Proposal $proposal)
    {
        return view('posts.deal')->with([
            'proposal' => $proposal,
            'review_score' => $proposal->user->averageScore(),
            ]);
    }
    
    public function indexDealing()
    {
        $proposal = new Proposal();
        return view('users.dealing')->with(['dealings' => $proposal->getDealings()]);
    }
}
