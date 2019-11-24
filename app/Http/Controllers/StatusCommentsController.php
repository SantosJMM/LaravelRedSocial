<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;

class StatusCommentsController extends Controller
{
    public function store(Status $status)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'status_id' => $status->id,
            'body' => request('body')
        ]);
    }
}
