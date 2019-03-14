@extends('layouts.admin')

@section('content')
    {{--Tinyedior paket pa formatiranje teksta objave--}}
    @include('includes.tinyeditor')
    <h1>Kreiranje objave</h1>
    <div class="row">
    {{--Forma za kreiranje nove objave. Za ovu i sve ostale forme korišten je Laravel Collective paket za kreiranje formi --}}
    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true])!!}
    <div class="form-group">
        {!! Form::label('title','Naslov: ') !!}
        {!! Form::text('title',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('category_id','Kategorija: ') !!}
        {!! Form::select('category_id',array('' => 'Odaberi kategoriju...') + $categories, null, ['class'=>'form-control']) !!}
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
        {!! Form::submit('Potvrdi', ['class'=>'btn btn-primary', 'rows'=>'3']) !!}
    </div>
    {{ Form::close() }}
    </div>
    <div class="row">
        {{--Pozivamo errore koji se ispisuju ako forma nije dobro pounjena--}}
        @include('includes.form_error')
    </div>
@stop