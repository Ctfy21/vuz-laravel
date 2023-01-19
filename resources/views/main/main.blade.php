@extends('layouts.layout')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Data</th>
      <th scope="col">Title</th>
      <th scope="col">Desc</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
    @foreach($articles as $article)
    <tr>
      <th scope="row">{{$article['date']}}</th>
      <td><a href="gallery/{{$article['full_image']}}" class="btn btn-primary">{{$article['name']}}</a></td>
      <td>{{$article['desc']}}</td>
      <td><img src="{{URL::asset($article['preview_image'])}}" alt="" height="150" width="150"></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection