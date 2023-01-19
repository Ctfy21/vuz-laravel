@extends('layouts.layout')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach($errors->all() as $error)
        <li>
          {{$error}}
        <li>
      @endforeach
  </ul>
</div>
@endif
<form action="/article/store" method="post">
    @csrf
    <div class="mb-3">
        <label for="exampleInputDate1" class="form-label">Дата</label>
        <input type="date" class="form-control" id="exampleInputDate1" name="date">
    </div>
    <div class="mb-3">
        <label for="exampleInputName1" class="form-label">Имя статьи</label>
        <input type="text" class="form-control" id="exampleInputName1" name="name">
    </div>
    <div class="mb-3">
        <label for="exampleInputAnnotation1" class="form-label">Аннотация</label>
        <input type="text" class="form-control" id="exampleInputAnnotation1" name="annotation">
    </div>
    <div class="mb-3">
        <label for="exampleInputDesc1" class="form-label">Описание</label>
        <input type="text" class="form-control" name="description" id="exampleInputDesc1">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
@endsection
