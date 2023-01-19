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
<form action="/auth/login" method="post">
    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Войти </button>
</form>
@endsection
