<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function recommendation($id)
    {
        $recommendation = Recommendation::where('id', $id)->firstOrFail();
//        dd($recommendation);
        return view('user.recommendation',compact('recommendation'));
    }

    public function getAllRecommendations()
    {
        return $recommendations = Recommendation::where('status',1)->orderBy('created_at','DESC')->paginate(5);
    }



}
