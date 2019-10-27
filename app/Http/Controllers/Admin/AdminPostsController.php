<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\postCreateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Post;
use App\Photo;
class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(postCreateRequest $request)
    {
		$user = Auth::user();
		$input = $request->all();
		$user = Auth::user();
		if ($file = $request->file('photo_id')) {
			$name = $file->getClientOriginalName();
			$name = 'post-'.$file->getClientoriginalName();
			$address = 'images/users/';
			$filee = $address . $name ;
			$file->move($address,$name);
			$photo =Photo::create(['filee'=>$filee]);
			$input['photo_id'] = $photo->id;
		}
		$input['password']= bcrypt($request->password);
		$user->Post()->create($input);
	 	return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
