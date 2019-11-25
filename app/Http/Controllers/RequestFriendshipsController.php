<?php

namespace App\Http\Controllers;

use App\Models\Friendships;
use App\User;
use Illuminate\Http\Request;

class RequestFriendshipsController extends Controller
{
    public function store(User $sender)
    {
        Friendships::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id(),
            'accepted' => false
        ])->update(['accepted' => true]);
    }
}
