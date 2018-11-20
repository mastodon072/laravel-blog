<?php

namespace App\Http\Controllers;

use App\Post;
use App\Image;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(2);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->except('category_id');
        $input['user_id'] = Auth::user()->id; 
        if( $file = $request->file('image_id') ){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $image = Image::create(['file' => $name]);
            $input['image_id'] = $image->id;
        }
        $post = Post::create($input);
        if( $category_id  = $request->category_id ){
            $post->categories()->sync( $category_id );
        } 
        $request->session()->flash('success', 'Post is created successfully.');

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
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->toArray();
        return view('admin.posts.edit',compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        if(Auth::user()->role->name == 'administrator'){ // check if user is admin
            $post = Post::find($id); // administrator can edit all post
        }else{
            $post = Auth::user()->posts()->find($id); // Get only posts of current user and find
        }

        $input = $request->except('category_id');

        if( $file = $request->file('image_id') ){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $image = Image::create(['file' => $name]);
            $input['image_id'] = $image->id;
        }

        if($post){
            $post->update($input);
            if( $category_id  = $request->category_id ){
                $post->categories()->sync( $category_id ); // sync category associated to post in pivot table
            } 
            $request->session()->flash('success', 'Post is successfully updated');
        }else{
            $request->session()->flash('danger', 'You don\'t have permission to edit this post');
        }
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect(route('posts.index'));
    }

    public function post($slug){
        $post = Post::findBySlugOrFail($slug);
        return view('post', compact('post'));
    }
}
