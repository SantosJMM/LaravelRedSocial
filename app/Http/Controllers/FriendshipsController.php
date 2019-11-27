<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Friendships;

class FriendshipsController extends Controller
{
    public function store(User $recipient)
    {
        Friendships::firstOrCreate([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
        ]);

        return response()->json(['friendship_status' => 'pending']);
    }

    public function destroy(User $recipient)
    {
        Friendships::where([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
        ])->delete();

        return response()->json(['friendship_status' => 'delete']);
    }
}
