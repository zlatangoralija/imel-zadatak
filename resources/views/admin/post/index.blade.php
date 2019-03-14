@extends('layouts.admin')

@section('content')
    {{--Poruka koja se ispisuje prilikom brisanja ili izmjene kategorije --}}
    @if(Session::has('deleted_post'))
        <p class="bg-danger">{{session('deleted_post')}}</p>
    @endif
    @if(Session::has('edited_post'))
        <p class="bg-info">{{session('edited_post')}}</p>
    @endif
    <h1>Posts</h1>
    {{--Tabela za prikaz objava--}}
    <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Slika </th>
            <th>Korisnika </th>
            <th>Kategorija </th>
            <th>Naslov</th>
            <th>Link</th>
            <th>Datum kreiranje</th>
            <th>Datum izmjene</th>
          </tr>
        </thead>
        <tbody>
        {{--Ako ima objava u bazi podaka, izvšit će se prikaz--}}
        @if($posts)
            {{--For each petlja za prikaz svih postova iz baze podataka pojedinačno--}}
            @foreach($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td><img src="{{$post->photo ? $post->photo->file : 'http://placehold.it/50x50'}}" height="50"></td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category ? $post->category->name : "No category"}}</td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a> </td>
                <td><a href="{{route('home.post', $post->slug)}}">Pogledaj objavu</a> </td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
    </table>
    {{--Kreiranje paginacije u slučaju da postoji više objava od broja koji je navedeno u AdminPostsController (2)--}}
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>
@stop