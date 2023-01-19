@extends('layouts.layout')
@section('content')
@if($article->full_image)
    <img src="../{{$article->full_image}}" alt="">
@endif
<p>{{$article->desc}}</p>

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
</form>


@endsection
