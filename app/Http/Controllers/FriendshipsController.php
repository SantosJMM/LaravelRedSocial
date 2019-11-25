<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Friendships;
use Illuminate\Http\Request;

class FriendshipsController extends Controller
{
    public function store(User $recipient)
    {
        Friendships::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
        ]);
    }
}
