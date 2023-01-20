<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Jobs\VeryLongJob;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('accept', null)->latest()->paginate(10);
        return view('comment/index', ['comments' => $comments]);
    }

    public function accept(Comment $comment)
    {
        $comment->accept = 1;
        $comment->save();
        return redirect()->back();
    }

    public function reject(Comment $comment)
    {
        $comment->accept = 0;
        $comment->save();
        return redirect()->back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required',
            'text' => 'required'
        ]);
        $comment = new Comment();
        $comment->author = request('author');
        $comment->text = request('text');
        $comment->article()->associate(request('id'));
        $comment->user()->associate(auth()->user());
        $result = $comment->save();
        $article = Article::where('id', $comment->article_id)->first();
        if($request){
            VeryLongJob::dispatch($article, $comment);
        }
        //VeryLongJob::dispatch($article);
        return redirect()->route('show', ['articleId'=>request('id'), 'result'=>$result]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('update-comment', $comment);
        return view('comment/edit', ['comment'=> $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'author' => 'required',
            'text' => 'required'
        ]);
        $comment = Comment::findOrFail($id);
        Gate::authorize('update-comment', $comment);
        $comment->author = request('author');
        $comment->text = request('text');
        $comment->article()->associate($comment->article_id);
        $comment->save();
        return redirect()->route('show', ['articleId' => $comment->article_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('update-comment', $comment);
        $comment->delete();
        return redirect()->route('show', ['articleId' => $comment->article_id]);
    }
}
