@extends('layouts.admin')

@section('content')
    @include('includes.tinyeditor')
    <h1>Izmjena objave</h1>
    {{--Forma za izmjenu objave, vrši se na osnovu ID-a objave--}}
    <div class="row">
        <div class="col-sm-3">
            {{--Uslov koji provjerava da li objava ima sliku, ako je ima prikazuje se slika objave, ako nema prikazuje se placeholder slika sa linka--}}
            <img src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-responsive img-rounded">
        </div>
        <div class="col-sm-9">
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true])!!}
                <div class="form-group">
                    {!! Form::label('title','Naslov: ') !!}
                    {!! Form::text('title',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id','Kategorija: ') !!}
                    {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id','Slika: ') !!}
                    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body','Tekst: ') !!}
                    {!! Form::textarea('body',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Izmjeni', ['class'=>'btn btn-primary col-sm-3', 'rows'=>'3']) !!}
            {{ Form::close() }}
                </div>
            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]])!!}
                <div class="form-group">
                    {!! Form::submit('Obriši', ['class'=>'btn btn-danger col-sm-3']) !!}
                </div>
            {{ Form::close() }}
                </div>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@stop