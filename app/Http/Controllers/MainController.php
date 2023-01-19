<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $articles = Article::paginate(5);
        return view('main/main', ['articles' => $articles]);
    }

    public function storeComment($articleId, Request $request){
        try{
            $validated = $request->validate([
                'author' => 'required',
                'text' => 'required'
            ]);

            $article = Article::findOrFail($articleId);

            $newComment = new Comment();
            $newComment->fill($validated);
            $newComment->article()->associate($article);


            if($newComment->save()){
                return redirect()->back();
            }

        }
        catch(Exception $ex){
            return redirect()->back()->withErrors($ex->validator);
        }
    }
}
