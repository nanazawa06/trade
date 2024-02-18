<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mygoods;
use Illuminate\Support\Facades\Auth;

class MygoodsController extends Controller
{
		// マイリストを取得
		public function getMygoods()
		{
				$mygoods = Auth::user()->mygoods;
				return response()->json($mygoods);
		}

    //マイリストにグッズ名追加
    public function addMygoods(Request $request)
    {
				$item = $request[0];
				$user_id = Auth::id();
				Auth::user()->mygoods()->create([
				'user_id' => $user_id,
				'name' => $item
					]);
				$mygoods = Auth::user()->mygoods;
				return response()->json($mygoods);
    }
	
    // マイリストからアイテム削除する
    public function deleteMygoods(Request $request)
    {
				$user_id = Auth::id();
				$item = $request[0];
				Mygoods::where('user_id', $user_id)->where('name', $item)->delete();
				$mygoods = Auth::user()->mygoods;
				return response()->json($mygoods);
    }
}
