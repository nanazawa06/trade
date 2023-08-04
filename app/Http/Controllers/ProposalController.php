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
            'images.*' => 'required',
        ]);
        
        $proposal->fill($input_request)->save();
        
        $images = $request->file('images');
        foreach ($images as $image) {
             $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
            // Imageモデルにデータを保存
            $proposal->images()->create([
                'image_url' => $image_url,
                ]);
            }
        
        return redirect('/');
    }
}
