<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {   
        $this->middleware(['auth'])->only(['store','destroy']);
    }
    public function index(){
        //Egale load with laravel-debugbar
        // $posts = Post::orderBy('created_at','desc')->with(['user','likes'])->paginate(10);
        $posts = Post::latest('created_at','desc')->with(['user','likes'])->paginate(10);
        // $posts = Post::paginate(10);
        return view('posts.index',[
            'posts'=>$posts
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'body'=>'required'
        ]);
        $request->user()->posts()->create($request->only('body'));
        return back();
    }

    public function show(Post $post){
        return view('posts.show',[
            'post' => $post
        ]);
    }

    public function destroy(Post $post,Request $request){
        // if(!$post->ownedBy(auth()->user())){
        //     dd('no');
        // } OR

        $this->authorize('delete',$post);
        $post->delete();
        return back();
    }
}
