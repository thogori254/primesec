<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\category;
use App\Model\discussion;
use App\Model\Recommendation;
use App\Model\tag;
use App\Model\topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function recommendations_home()
    {
        $recommendations = Recommendation::where('status',1)->orderBy('created_at','DESC')->paginate(5);
//        dd($recommendations);
        return view('user.home',compact('recommendations'));
    }

    public function discussions_home()
    {
        $discussions = discussion::where('status',1)->orderBy('created_at','DESC')->paginate(5);
//        dd($recommendations);
        return view('user.discussions.home',compact('discussions'));
    }


    public function tag(tag $tag)
    {
        $recommendations = $tag->recommendations();
        return view('user.home',compact('recommendations'));
    }

    public function category(category $category)
    {
        $recommendations = $category->recommendations();
        return view('user.home',compact('recommendations'));
    }

    public function topic(topic $topic)
    {
        $discussions = $topic->discussions();
        return view('user.discussions.home',compact('discussions'));
    }

}
