<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscussionController extends Controller
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
        $discussions = \App\Model\discussion::all();
        return view('admin.discussion.show',compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $topics =\App\Model\topic::all();
        return view('admin.discussion.discussion',compact('topics'));



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
        $discussion = new \App\Model\discussion();
        if ($request->hasFile('image')) {
            $imageName = $request->image->store('public');
            $discussion->image = $imageName;
        }

        $discussion->title = $request->title;
        if ($request->subtitle != null) {
            $discussion->subtitle = $request->subtitle;
        }
        if ($request->slug != null) {
            $discussion->slug = $request->slug;
        }
        $discussion->body = $request->body;
        $discussion->status = $request->status;
        $discussion->save();
        $discussion->topics()->sync($request->topics);

        $discussions = \App\Model\discussion::all();
        return redirect('admin_view_discussions');
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

        $discussion = \App\Model\discussion::with('topics')->where('id',$id)->first();
        $topics =\App\Model\topic::all();
        return view('admin.discussion.edit',compact('topics','discussion'));

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

        $discussion = \App\Model\discussion::find($id);
        if ($request->hasFile('image')) {
            $imageName = $request->image->store('public');
            $discussion->image = $imageName;
        }
        $discussion->title = $request->title;
        if ($request->subtitle != null) {
            $discussion->subtitle = $request->subtitle;
        }
        if ($request->slug != null) {
            $discussion->slug = $request->slug;
        }
        $discussion->body = $request->body;
        $discussion->status = $request->status;
        $discussion->topics()->sync($request->topics);
        $discussion->save();

        $discussions = \App\Model\discussion::all();
        return redirect('admin_view_discussions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\discussion::where('id',$id)->delete();
        return redirect()->back();
    }
}
