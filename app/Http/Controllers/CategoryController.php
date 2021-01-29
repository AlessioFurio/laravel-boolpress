<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show($slug) {

        $category = Category::where('slug', $slug)->first(); // nella tabella category, vado a prendermi la categoria dove 'slug' sara' uguale a $slug passato in show($slug), ->first() lo faccio perche' ::where non mi da i risultati, qnd uso ->first per ricavarli

        if(!$category){
            abort(404);
        }

        $data = [
            'category' => $category
        ];


        return view('guest.categories.show', $data);
    }
}
