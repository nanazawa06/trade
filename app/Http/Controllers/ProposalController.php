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
        return view('posts.show_request')->with(['proposal' => $proposal]);
    }
    
    public function messageToDeal(Proposal $proposal, Request $request)
    {
        //messageをchatsテーブルに保存
        $input_chat = $request['chat'];
        $proposal->chats()->create([
                    'user_id' => $input_chat['user_id'],
                    'message' => $input_chat['message'],
                ]);
        return redirect("/posts/" . $proposal->id . "/deal");
    }
    
    public function startDeal(Proposal $proposal, Request $request)
    {
        $proposal->status = 'dealing';
        $proposal->save();
        return view('posts.deal')->with([
            'proposal' => $proposal
            ]);
    }
    
    public function showDealing(Proposal $proposal)
    {
        return view('posts.deal')->with([
            'proposal' => $proposal
            ]);
    }
    
    public function indexDealing()
    {
        $user_id = Auth::id();
        $proposals = Proposal::where('user_id', $user_id)->where('status', 'dealing')->get();
        return view('users.dealing')->with(['dealings' => $proposals]);
    }
}
