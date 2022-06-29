<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticlesResource;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        self::incrementVisits();
        \App\SiteStat::incrementVisit();
        return view('home');
	}

        /**
     * Fetch initial route articles
     */
    public function getArticle($id)
    {
        //Using a slug instead of id
        $post = \App\Article::where('slug', $id)->firstOrFail();
        //return $post;
        $post->incrementViews();
        \App\SiteStat::incrementArticleVisit();

        return view('article', ['post' => $post]);
    }

    /**
     * Fetch route analysis
     */
    public function getAnalysis($id)
    {
        //Using a slug instead of id
        $analysis = \App\Analysis::where('slug', $id)->firstOrFail();
        //return $analysis;
        $analysis->incrementViews();
        \App\SiteStat::incrementAnalysisVisit();

        return view('article', ['post' => $analysis]);
    }





    public static function incrementVisits()
    {
        DB::table('blog_details')->increment('total_visits', 1);
        $date = date('Y-m-d');
        $stat = \App\SiteStat::where('date', $date)->first();
        if(empty($stat)){
            $stat = new \App\SiteStat();
            $stat->date = $date;
            $stat->count = 1;
        }else{
            $count = $stat->count + 1;
            $stat->count = $count;
            $stat->save();
        }

        return array('message' => 'success');
    }
}
