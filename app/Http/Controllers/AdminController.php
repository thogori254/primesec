<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\General as GeneralResource;
use App\Http\Resources\AdminArticle as AdminResource;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function admin()
    {
        return view('admin');
    }


    /**
     * Get a validator for new categories request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function categoryValidator(array $data)
    {
        $v = Validator::make($data, [
            'category' => ['required', 'string', 'min:3'],
        ]);

        return $v;
    }


    /**
     * Get a validator for new post request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function postValidator(array $data)
    {
        $v = Validator::make($data, [
            'title' => ['required', 'string', 'min:3'],
            'body' => ['required', 'string', 'min:3'],
            'categoryId' => ['required', 'numeric', 'min:0'],
            'header' => ['nullable','file', 'mimes:jpg,jpeg,png,bmp','max:2048']
        ]);


        return $v;
    }

    /**
     * Get a validator for home page edits request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function homepageValidator(array $data)
    {
        $v = Validator::make($data, [
            'title' => ['required', 'string', 'min:3'],
            'body' => ['required', 'string', 'min:3'],
            'sideImage' => ['nullable','file', 'mimes:png','max:2048']
        ]);


        return $v;
    }

    /**
     * Save an article
     */
    public function saveCategory(Request $request)
    {
        $this->categoryValidator($request->all())->validate();

        $category = \App\Category::where('name', 'like', $request->category)->first();

        if(empty($category)){
            $category = new \App\MasterCategory;
            $category->name = Str::lower($request->category);
            $category->save();
        }

        $masterCategories = \App\MasterCategory::all();

        return array('selected' => $category->id, 'categories' => $masterCategories);
    }

    /**
     * Save an article
     */
    public function saveArticle(Request $request)
    {
        $this->postValidator($request->all())->validate();
        $data = $request->all();

        $path = null;
        if(null  !== $request->file('header')  && $request->file('header')->isValid() ){
            $path = $request->file('header')->store('static_images/headers', 'statics');
        }
        $slug = Str::slug($request->title, '-');

        //Save the post here
        $post = new \App\Article();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->header = $path;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;
        if(null !== $request->published){
            $post->published = true;
        }
        $post->master_category_id = $request->categoryId;
        $post->save();


        if(!empty($request->categories)){
            $categoryString = preg_replace('/\s+/', '', $request->categories);
            $categories = explode(',',$categoryString);

            foreach ($categories as $value) {
                # code...Save categories here
                $category = \App\Category::where('name', 'like', $value)->first();

                if(empty($category)){
                    $category = new \App\Category;
                    $category->name = Str::lower($value);
                    $category->save();
                }

                $articleCategory = new \App\ArticleCategory;
                $articleCategory->article_category_id = $post->id;
                $articleCategory->category_id = $category->id;
                $articleCategory->article_category_type = "articles";
                $articleCategory->save();
            }
        }

        return $post;
    }

    /**
     * Save a blog post
     */
    public function savePost(Request $request)
    {
        $this->postValidator($request->all())->validate();
        $data = $request->all();

        $path = null;
        if(null  !== $request->file('header')  && $request->file('header')->isValid() ){
            $path = $request->file('header')->store('static_images/headers', 'statics');
        }
        $slug = Str::slug($request->title, '-');
        //Save the post here
        $post = new \App\Blogpost();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->header = $path;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;
        if(null !== $request->published){
            $post->published = true;
        }
        $post->master_category_id = $request->categoryId;
        $post->save();

        if(!empty($request->categories)){
            $categoryString = preg_replace('/\s+/', '', $request->categories);
            $categories = explode(',',$categoryString);

            foreach ($categories as $value) {
                # code...Save categories here
                $category = \App\Category::where('name', 'like', $value)->first();

                if(empty($category)){
                    $category = new \App\Category;
                    $category->name = $value;
                    $category->save();
                }


                $articleCategory = new \App\ArticleCategory;
                $articleCategory->article_category_id = $post->id;
                $articleCategory->category_id = $category->id;
                $articleCategory->article_category_type = "blogposts";
                $articleCategory->save();
            }
        }
        return $post;
    }

    /**
     * Save a blog post
     */
    public function saveAnalysis(Request $request)
    {
        $this->postValidator($request->all())->validate();
        $data = $request->all();

        $path = null;
        if(null  !== $request->file('header')  && $request->file('header')->isValid() ){
            $path = $request->file('header')->store('static_images/headers', 'statics');
        }
        $slug = Str::slug($request->title, '-');
        //Save the post here
        $post = new \App\Analysis();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->header = $path;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;

        if(null !== $request->published){
            $post->published = true;
        }
        $post->master_category_id = $request->categoryId;
        $post->save();

        if(!empty($request->categories)){
            $categoryString = preg_replace('/\s+/', '', $request->categories);
            $categories = explode(',',$categoryString);

            foreach ($categories as $value) {
                # code...Save categories here
                $category = \App\Category::where('name', 'like', $value)->first();

                if(empty($category)){
                    $category = new \App\Category;
                    $category->name = $value;
                    $category->save();
                }


                $articleCategory = new \App\ArticleCategory;
                $articleCategory->article_category_id = $post->id;
                $articleCategory->category_id = $category->id;
                $articleCategory->article_category_type = "analysis";
                $articleCategory->save();
            }
        }
        return $post;
    }

    /**
     * Edit an article
     */
    public function editArticle(Request $request, $id)
    {
        $this->postValidator($request->all())->validate();
        $data = $request->all();

        $path = null;
        if(null  !== $request->file('header')  && $request->file('header')->isValid() ){
            $path = $request->file('header')->store('static_images/headers', 'statics');
        }
        $slug = Str::slug($request->title, '-');

        //edit the article here
        $post = \App\Article::findorfail($id);
        $post->title = $request->title;
        $post->slug = $slug;
        $post->header = $path;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;

        if(null !== $request->published){
            $post->published = true;
        }else{
            $post->published = false;
        }
        $post->master_category_id = $request->categoryId;
        $post->update();


        if(!empty($request->categories)){
            $categoryString = preg_replace('/\s+/', '', $request->categories);
            $categories = explode(',',$categoryString);

            foreach ($categories as $value) {
                # code...Save categories here
                $category = \App\Category::where('name', 'like', $value)->first();

                if(empty($category)){
                    $category = new \App\Category;
                    $category->name = Str::lower($value);
                    $category->save();
                }

                $articleCategory = new \App\ArticleCategory;
                $articleCategory->article_category_id = $post->id;
                $articleCategory->category_id = $category->id;
                $articleCategory->article_category_type = "articles";
                $articleCategory->save();
            }
        }

        return $post;
    }

    /**
     * Edit a blog post
     */
    public function editPost(Request $request, $id)
    {
        $this->postValidator($request->all())->validate();
        $data = $request->all();

        $path = null;
        if(null  !== $request->file('header')  && $request->file('header')->isValid() ){
            $path = $request->file('header')->store('static_images/headers', 'statics');
        }
        $slug = Str::slug($request->title, '-');
        //Edit the post here
        $post = \App\Blogpost::findorfail($id);
        $post->title = $request->title;
        $post->slug = $slug;
        $post->header = $path;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;

        if(null !== $request->published){
            $post->published = true;
        }else{
            $post->published = false;
        }

        $post->master_category_id = $request->categoryId;
        $post->update();

        if(!empty($request->categories)){
            $categoryString = preg_replace('/\s+/', '', $request->categories);
            $categories = explode(',',$categoryString);

            foreach ($categories as $value) {
                # code...Save categories here
                $category = \App\Category::where('name', 'like', $value)->first();

                if(empty($category)){
                    $category = new \App\Category;
                    $category->name = $value;
                    $category->save();
                }


                $articleCategory = new \App\ArticleCategory;
                $articleCategory->article_category_id = $post->id;
                $articleCategory->category_id = $category->id;
                $articleCategory->article_category_type = "blogposts";
                $articleCategory->save();
            }
        }
        return $post;
    }

    /**
     * Edit an analysis post
     */
    public function editAnalysis(Request $request, $id)
    {
        $this->postValidator($request->all())->validate();
        $data = $request->all();

        $path = null;
        if(null  !== $request->file('header')  && $request->file('header')->isValid() ){
            $path = $request->file('header')->store('static_images/headers', 'statics');
        }
        $slug = Str::slug($request->title, '-');
        //Save the post here
        $post = \App\Analysis::findorfail($id);
        $post->title = $request->title;
        $post->slug = $slug;
        $post->header = $path;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;

        if(null !== $request->published){
            $post->published = true;
        }else{
            $post->published = false;
        }
        $post->master_category_id = $request->categoryId;
        $post->update();

        if(!empty($request->categories)){
            $categoryString = preg_replace('/\s+/', '', $request->categories);
            $categories = explode(',',$categoryString);

            foreach ($categories as $value) {
                # code...Save categories here
                $category = \App\Category::where('name', 'like', $value)->first();

                if(empty($category)){
                    $category = new \App\Category;
                    $category->name = $value;
                    $category->save();
                }


                $articleCategory = new \App\ArticleCategory;
                $articleCategory->article_category_id = $post->id;
                $articleCategory->category_id = $category->id;
                $articleCategory->article_category_type = "analysis";
                $articleCategory->save();
            }
        }
        return $post;
    }

   /**
    * Save homepage changes
    */
    public function saveHomepage(Request $request)
    {
        $this->homepageValidator($request->all())->validate();
        $data = $request->all();
        $path = null;
        if( $request->sideImage !== null && $request->file('sideImage')->isValid()){
            //$path = $request->file('sideImage')->storeAs('public/static_images', 'home_header.png', 'local');
            $path = $request->file('sideImage')->storeAs('static_images/images', 'home_header.png', 'statics');
        }

        $blogDetail =  \App\BlogDetail::first();

        if(empty($blogDetail)){
            //Save the homepage here
            $blogDetail = new \App\BlogDetail();
            $blogDetail->title = $request->title;
            $blogDetail->article = $request->body;
            if($path !== null)
                $blogDetail->image_url = 'https://mblogstatics.s3.us-east-1.amazonaws.com/'.$path;
            $blogDetail->save();
        } else {
            $blogDetail->title = $request->title;
            $blogDetail->article = $request->body;
            if($path !== null)
                $blogDetail->image_url = 'https://mblogstatics.s3.us-east-1.amazonaws.com/'.$path;
            $blogDetail->update();
        }

        return array('message' => 'success');
    }

    /**
     * Fetch initial route blogposts
     */
    public function getBlogPosts(Request $request)
    {
        $posts = \App\Blogpost::all();
        return AdminResource::collection($posts);
    }

    /**
     * Fetch initial route articles
     */
    public function getAnalysis(Request $request)
    {
        $posts = \App\Analysis::all();
        return AdminResource::collection($posts);
    }

    /**
     * Fetch initial route articles
     */
    public function getArticles(Request $request)
    {
        $posts = \App\Article::all();
        return AdminResource::collection($posts);
    }

    /**
     * Delete articles
     */
    public function deleteArticle(Request $request, $id)
    {
        $post = \App\Article::findorfail($id);
        $post->delete();

        return array("message"=>"success");
    }

    /**
     * Delete analysis
     */
    public function deleteAnalysis(Request $request, $id)
    {
        $post = \App\Analysis::findorfail($id);
        $post->delete();

        return array("message"=>"success");
    }
    /**
     * Delete blog post
     */
    public function deletePost(Request $request, $id)
    {
        $post = \App\BlogPost::findorfail($id);
        $post->delete();

        return array("message"=>"success");
    }

    /**
     * Delete articles
     */
    public function publishArticle(Request $request, $id)
    {
        $post = \App\Article::findorfail($id);
        $post->published = true;
        $post->update();

        return array("message"=>"success");
    }

    /**
     * Delete analysis
     */
    public function publishAnalysis(Request $request, $id)
    {
        $post = \App\Analysis::findorfail($id);
        $post->published = true;
        $post->update();

        return array("message"=>"success");
    }
    /**
     * Delete blog post
     */
    public function publishPost(Request $request, $id)
    {
        $post = \App\Blogpost::findorfail($id);
        $post->published = true;
        $post->update();

        return array("message"=>"success");
    }

        /**
     * Fetch initial route articles
     */
    public function getArticle($id)
    {
        $post = \App\Article::find($id);
        return new AdminResource($post);
    }

    /**
     * Fetch a post article
     */
    public function getBlogPost($id)
    {
        $post = \App\Blogpost::find($id);
        return new AdminResource($post);
    }

    /**
     * Fetch an analysis article
     */
    public function getOneAnalysys($id)
    {
        $post = \App\Analysis::find($id);
        return new AdminResource($post);
    }

}
