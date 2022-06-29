<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function discussion($id)
    {
        $discussion = discussion::where('id', $id)->firstOrFail();
//        dd($recommendation);
        return view('user.discussions.discussion',compact('discussion'));
    }


}
