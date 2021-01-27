<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];

        return view('guest.posts.index', $data);
    }

    public function show($slug) // passo lo slug come parametro

    {
        $post = Post::where('slug', $slug)->first(); // pesco lo slug dal db con where, prendo il risultato con ->first e salvo in $post
        if(!$post){
            abort(404);
        }

        $data = [
            'post'=>$post
        ];
        return view('guest.posts.show', $data);
    }
}
