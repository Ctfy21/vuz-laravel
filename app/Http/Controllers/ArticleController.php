<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create(){
        $this->authorize('create', [self::class]);
        return view('articles/addArticle');
    }

    public function store(Request $request){

        $this->authorize('create', [self::class]);

        $request->validate([
            'name' => 'required',
            'annotation' => 'required|min:10'
        ]);
        $article = new Article();
        $article->name = request('name');
        $article->date = request('date');
        $article->shortDesc = request('annotation');
        $article->desc = request('description');
        $article->save();
        return redirect('/');
    }

    public function view($articleId){
        $article = Article::findOrFail($articleId);
        $comments = Comment::where([['article_id', $articleId],['accept', 1]])->latest()->paginate(5);
        return view('articles/viewArticle', ['article' => $article, 'comments' => $comments]);
    }

    public function edit($id){
        $article = Article::FindOrFail($id);
        $this->authorize('update', [$article, self::class]);
        return view('articles/editArticle', ['article'=>$article]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'annotation' => 'required|min:10'
        ]);
        $article = Article::FindOrFail($id);
        $this->authorize('update', [$article, self::class]);
        $article->name = request('name');
        $article->date = request('date');
        $article->shortDesc = request('annotation');
        $article->desc = request('description');
        $article->save();
        return redirect()->route('show', ['articleId'=>$article->id]);
    }

    public function destroy($id){
        $article = Article::FindOrFail($id);
        $this->authorize('delete', [$article, self::class]);
        Comment::where('article_id', $id)->delete();
        $article->delete();
        return redirect('/');
    }
}
