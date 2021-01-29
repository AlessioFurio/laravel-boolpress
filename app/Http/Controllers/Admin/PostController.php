<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::all() // recupero tutte le categorie dal model Category
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form_data = $request->all(); // dentro il $form_data, mi trovo tutti gli input che hanno un name come attributo nell html
        $new_post = new Post();
        dd($new_post);
        $new_post->fill($form_data);
        // genero lo slug
        $slug = Str::slug($new_post->title);
        $slug_base = $slug; // slavo la "radice base " dello slug

        $current_post = Post::where('slug', $slug)->first();  // controllo se nella colonna slug e' gia' presente lo $slug (con Post::where) e ::first mi restituisce un oggetto di tipo post o restituisce null

        //se la query in $current_pos restituisce un valore e quindi diverso da null, verifico che il post corrente sia uguale ad un post esistente, se si allora concateno un -1, -2 etc....
        $contatore = 1;
        while($current_post){

            $slug = $slug_base . '-' . $contatore; // concateno il contatore x rendere diverso lo slug
            $contatore++;
            $current_post = Post::where('slug', $slug)->first(); // rifaccio la query x cercare che il nuovo slug, al primo giro sara' .-1, non sia presente nel DB finche' il while non diventa falso

        }

        $new_post->slug = $slug;

        $new_post->save();
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'post' => $post
        ];
        return view('admin.posts.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       if(!$post) {
           abort(404);
       }

       $data = [
           'post' => $post,
           'categories' => Category::all()
       ];

       return view('admin.posts.edit', $data);
   }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        {
       $form_data = $request->all();
       // verifico se il titolo ricevuto dal form è diverso dal vecchio titolo
       if($form_data['title'] != $post->title) {
           // è stato modificato il titolo => devo modificare anche lo slug
           // genero lo slug
           $slug = Str::slug($form_data['title']);
           $slug_base = $slug;
           // verifico che lo slug non esista nel database
           $post_presente = Post::where('slug', $slug)->first();
           $contatore = 1;
           // entro nel ciclo while se ho trovato un post con lo stesso $slug
           while($post_presente) {
               // genero un nuovo slug aggiungendo il contatore alla fine
               $slug = $slug_base . '-' . $contatore;
               $contatore++;
               $post_presente = Post::where('slug', $slug)->first();
           }
           // quando esco dal while sono sicuro che lo slug non esiste nel db
           // assegno lo slug al post
           $form_data['slug'] = $slug;
       }
       $post->update($form_data);
       return redirect()->route('admin.posts.index');
   }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
         return redirect()->route('admin.posts.index');
    }
}
