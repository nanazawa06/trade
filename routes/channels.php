<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Chat;
use App\Models\Post;
use App\Models\Proposal;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});
Broadcast::channel('postChat.{postId}', function ($postId, $user=null) {
    return true;
});
Broadcast::channel('proposalChat.{proposalId}', function ($proposalId, $user=null) {
    return true;
});