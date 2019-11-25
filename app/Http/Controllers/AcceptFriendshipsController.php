<?php

namespace App\Http\Controllers;

use App\Models\Friendships;
use App\User;
use Illuminate\Http\Request;

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
