@extends('layouts.layout')
@section('content')
<div class="card" style="margin-top">
    <div class="card-body">
        @if($article->full_image)
            <img style="width:1000px; height:700px;" src="../{{$article->full_image}}" alt="">
        @endif
        <h5 class="card-title">{{$article->name}}</h5>
        <h6 class="card-text">{{$article->desc}}</h6>


        <h3 class="text-center">Комментарии</h3>
        @isset($_GET['result'])
            @if ($_GET['result'])
                <div class="alert alert-primary">
                    Ваш комментарий ожидает модерации
                </div>
            @endif
        @endisset


        @foreach($comments as $comment)
        <form action="/comment/{{$comment->id}}" method="post">
        @csrf
        @method('DELETE')
        <div class="card-body">
          <h5 class="card-title">{{$comment->author}}, ({{$comment->created_at}})</h5>
          <p class="card-text">{{$comment->text}}</p>
          @can('update-comment', $comment)
            <a href="/comment/{{$comment->id}}/edit" class="btn btn-secondary">Редактировать</a>
            <button type="submit" class="btn btn-secondary">Удалить</button>
          @endcan
        </div>
        </form>
        @endforeach

        <h2 class="text-center">Новый комментарий</h2>
        <form action="/comment" method="post">
        @csrf
         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Заголовок</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="author" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Текст</label>
          <textarea class="form-control" id="exampleInputPassword1" name="text"></textarea>
        </div>
        <input type="hidden" name="id" value="{{$article->id}}">
        <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
      </div>

        <div style="margin-top: 10px">
            <a href="/article/{{$article->id}}/edit" class="btn btn-info">Редактирование</a>
            <a href="/article/{{$article->id}}/delete" class="btn btn-danger">Удаление</a>
        </div>

    </div>
</div>

@endsection
