<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusLikeController extends Controller
{
    public function store(Status $status)
    {
        $status->like();
    }
}
