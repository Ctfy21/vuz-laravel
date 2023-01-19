<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $articles = Article::all()->toArray();
        return view('main/main', ['articles' => $articles]);
    }

    public function view($full){
        return view('main/gallery', ['full' => $full]);
    }
}
