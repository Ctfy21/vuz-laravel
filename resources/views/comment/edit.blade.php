@extends('layouts.layout')
@section('content')
<form action="/comment/{{$comment->id}}" method="post">
    @method('PUT')
    @csrf
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Заголовок</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="author" value="{{$comment->author}}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Текст</label>
    <textarea class="form-control" id="exampleInputPassword1" name="text">{{$comment->text}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Изменить</button>
  </form>
  @endsection
