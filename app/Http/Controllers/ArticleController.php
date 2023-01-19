<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create(){
        return view('articles/addArticle');
    }

    public function store(){
        $article = new Article();
        $article->name = request('name');
        $article->name = request('date');
        $article->shortDesc = request('annotation');
        $article->desc = request('description');
        $article->save();
    }

    public function view($articleId){
        $article = Article::with('comments')->findOrFail($articleId);
        return view('articles/viewArticle', ['article' => $article]);
    }

}
