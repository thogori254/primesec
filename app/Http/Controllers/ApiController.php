<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Blogpost as PostsResource;
use App\Http\Resources\Article as ArticlesResource;
use App\Http\Resources\Ticket as TicketsResource;
use App\Http\Resources\General as GeneralResource;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Fetch initial route blogposts
     */
    public function getBlogPosts(Request $request)
    {
        $posts = \App\Blogpost::where('published', true)->get();
        return PostsResource::collection($posts);
    }

    /**
     * Fetch initial route articles
     */
    public function getAnalysis(Request $request)
    {
        $posts = \App\Analysis::where('published', true)->get();
        return ArticlesResource::collection($posts);
    }

    /**
     * Fetch initial route articles
     */
    public function getArticles(Request $request)
    {
        $posts = \App\Article::where('published', true)->get();
        return ArticlesResource::collection($posts);
    }

    /**
     * Fetch recent articles headers
     */
    public function getRecents(Request $request)
    {
        $articles = \App\Article::orderBy('created_at', 'ASC')->limit(5)->select('title', 'slug', 'created_at')->get()->toArray();
        $posts = \App\Blogpost::orderBy('created_at', 'ASC')->limit(5)->select('title', 'slug', 'created_at')->get()->toArray();
        $analysis = \App\Analysis::orderBy('created_at', 'ASC')->limit(5)->select('title', 'slug', 'created_at')->get()->toArray();

        $headers = array();
        foreach ($articles as $value) {
            $value['type'] = 'article';
            $headers[$value['created_at']] = $value;
        }
        foreach ($posts as $value) {
            $value['type'] = 'blog';
            $headers[$value['created_at']] = $value;
        }
        foreach ($analysis as $value) {
            $value['type'] = 'analysis';
            $headers[$value['created_at']] = $value;
        }
        krsort($headers);

        $headers = array_slice($headers, 0, 5);
        return json_encode($headers);
    }

    /**
     * Fetch initial route articles
     */
    public function getArticle($id)
    {
        $post = \App\Article::find($id);
        return new ArticlesResource($post);
    }

    /**
     * Fetch a post article
     */
    public function getBlogPost($slug)
    {
        $post = \App\Blogpost::where('slug', $slug)->first();
        return new PostsResource($post);
    }

    /**
     * Fetch an analysis article
     */
    public function getAnalysys($id)
    {
        $post = \App\Analysis::find($id);
        return new ArticlesResource($post);
    }

    /**
     * Create a new mailing fan
     */
    public function newMailing(Request $request)
    {
        $request->validate([
            'email' => ['required','email', 'unique:mailings']
        ]);

        $newMailing = new \App\Mailing();
        $newMailing->email = $request->email;
        $newMailing->save();

        return array('message' => 'success');
    }


    /**
     * Create a new mailing fan
     */
    public function newTicket(Request $request)
    {
        $request->validate([
            'name' => ['required','string', 'min:3'],
            'email' => ['required','email'],
            'message' => ['required','string', 'min:3']
        ]);

        $ticket = new \App\Ticket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->message = $request->message;
        $ticket->save();

        return array('message' => 'success');
    }

    /**
     * Fetch initial admin tickets
     */
    public function getTickets(Request $request)
    {
        $posts = \App\Ticket::where('seen', false)->get();
        return TicketsResource::collection($posts);
    }

    /**
     * Fetch initial subscription list
     */
    public function getSubscriptions(Request $request)
    {
        $mails = \App\Mailing::select('id','email', 'active')->get();
        return GeneralResource::collection($mails);
    }

    /**
     * Fetch initial siteStats
     */
    public function getStats(Request $request)
    {
        $stats = \App\SiteStat::limit(7)->get();
        $labels = [];
        $dataset = ['site' => array(), 'article' => array(), 'blog' => array(), 'analysis' => array()];

        foreach ($stats as $value) {
            array_push($labels, $value->date);
            array_push($dataset['site'], $value->count);
            array_push($dataset['article'], $value->article_count);
            array_push($dataset['blog'], $value->blog_count);
            array_push($dataset['analysis'], $value->analysis_count);
        }
        return array('labels' => $labels, 'dataset' => $dataset);
    }



    /**
     * Fetch initial blog details
     */
    public function getDetails(Request $request)
    {
        $details = \App\BlogDetail::first();

        return $details;
    }

    /**
     * Retrieve master categories
     */
    public function getCategories(Request $request)
    {

        $masterCategories = \App\MasterCategory::all();

        return GeneralResource::collection($masterCategories);
    }

    /**
     *Mark ticket as read
     */
    public function ticketRead(Request $request, $id)
    {

        $ticket = \App\Ticket::find($id);
        if(!empty($ticket)){
            $ticket->seen = true;
            $ticket->update();
        }
    }

    /**
     * Fetch icons from list
     */
    public function getIcons()
    {
        $contents = Storage::disk('public')->get('assets/icons.json');
        $json = json_decode($contents, true);

        return $json;
    }

    /**
     * Get all stored products
     */
    public function getProducts()
    {
        $products = \App\Product::orderBy('position', 'ASC')->get();

        return GeneralResource::collection($products);
    }


    /**
     * Save a product
     */
    public function saveProduct(Request $request)
    {
        $request->validate([
            "icon"=>"required|string",
            "title"=>"required|string",
            "content"=>"required|string",
        ]);

        if($request->id == 'new'){
            $product = new \App\Product();
            $product->title = $request->title;
            $product->icon = $request->icon;
            $product->content = $request->content;
            $product->position = $request->position;
            $product->save();
        }else{
            $product = \App\Product::find($request->id);
            $product->title = $request->title;
            $product->icon = $request->icon;
            $product->content = $request->content;
            $product->position = $request->position;
            $product->update();
        }
        $data = new GeneralResource($product);
        return array('message'=>'success', 'data' => $product);
    }
    /**
     * Create a product
     */
    public function newProduct(Request $request)
    {


        $data = new GeneralResource($product);
        return array('message'=>'success', 'data' => $product);
    }

}
