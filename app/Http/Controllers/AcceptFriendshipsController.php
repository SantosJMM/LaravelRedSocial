<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Friendships;

class AcceptFriendshipsController extends Controller
{
    public function store(User $sender)
    {
        Friendships::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id()
        ])->update(['status' => 'accepted']);
    }

    public function destroy(User $sender)
    {
        Friendships::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id()
        ])->update(['status' => 'denied']);
    }
}
