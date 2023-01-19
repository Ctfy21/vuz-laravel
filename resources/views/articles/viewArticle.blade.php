@extends('layouts.layout')
@section('content')
<div class="card" style="margin-top">
    <div class="card-body">
        @if($article->full_image)
            <img style="width:1000px; height:700px;" src="../{{$article->full_image}}" alt="">
        @endif
        <h5 class="card-title">{{$article->name}}</h5>
        <h6 class="card-text">{{$article->desc}}</h6>

        <ul>
            @foreach ($article['comments'] as $comment)
            <li>{{$comment['author']}}<i>{{$comment->text}}</i></li>
            @endforeach
        </ul>
        <form method="post" action="/articles/{{$article->id}}/comments">
            @csrf
            <div>
                <label>
                    Author
                    <input style="border: 1px solid black" name="author" type="text">
                </label>
            </div>
            <div>
                <label>
                    Text
                    <textarea style="border: 1px solid black" name="text"></textarea>
                </label>
            </div>
            <input type="submit" value="Go">
            @foreach ($errors->all() as $error)
                <span style="color: red">{{$error}}</span>
            @endforeach
        </form>
        <div style="margin-top: 10px">
            <a href="/article/{{$article->id}}/edit" class="btn btn-info">Редактирование</a>
            <a href="/article/{{$article->id}}/delete" class="btn btn-danger">Удаление</a>
        </div>
    </div>
</div>

@endsection
