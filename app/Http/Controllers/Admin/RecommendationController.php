<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Http\Controllers\Controller;
use App\Recommendation;
use App\tag;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendations = \App\Model\Recommendation::all();
        return view('admin.recommendation.show',compact('recommendations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

            $tags =\App\Model\tag::all();
            $categories =\App\Model\category::all();
            return view('admin.recommendation.recommendation',compact('tags','categories'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => '',
            'slug' => 'required',
            'body' => 'required',
            'image' => '',
        ]);

//        else{
//            return 'No';
//        }
        $recommendation = new \App\Model\Recommendation();
        if ($request->hasFile('image')) {
            $imageName = $request->image->store('public');
            $recommendation->image = $imageName;
        }

        $recommendation->title = $request->title;
        if ($request->subtitle != null) {
            $recommendation->subtitle = $request->subtitle;
        }
        if ($request->slug != null) {
            $recommendation->slug = $request->slug;
        }
        $recommendation->body = $request->body;
        $recommendation->status = $request->status;
        $recommendation->save();
        $recommendation->tags()->sync($request->tags);
        $recommendation->categories()->sync($request->categories);

        $recommendations = \App\Model\Recommendation::all();
        return redirect('admin_view_recommendations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $recommendation = \App\Model\Recommendation::with('tags','categories')->where('id',$id)->first();
            $tags =\App\Model\tag::all();
            $categories =\App\Model\category::all();
            return view('admin.recommendation.edit',compact('tags','categories','recommendation'));

//        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => '',
            'slug' => 'required',
            'body' => 'required',
            'image'=>''
        ]);

        $recommendation = \App\Model\Recommendation::find($id);
        if ($request->hasFile('image')) {
            $imageName = $request->image->store('public');
            $recommendation->image = $imageName;
        }
        $recommendation->title = $request->title;
        if ($request->subtitle != null) {
            $recommendation->subtitle = $request->subtitle;
        }
        if ($request->slug != null) {
            $recommendation->slug = $request->slug;
        }
        $recommendation->body = $request->body;
        $recommendation->status = $request->status;
        $recommendation->tags()->sync($request->tags);
        $recommendation->categories()->sync($request->categories);
        $recommendation->save();

        $recommendations = \App\Model\Recommendation::all();
        return redirect('admin_view_recommendations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\Recommendation::where('id',$id)->delete();
        return redirect()->back();
    }
}
