@extends('layouts.admin')

@section('content')
    <h1>Izmjena kategorije</h1>
    {{--Forma za izmjenu kategorije, izmjena se vrši preko ID-a same kategorije--}}
        @include('includes.form_error')
    <div class="col-sm-6">
        {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]])!!}
        <div class="form-group">
            {!! Form::label('name','Naziv kategorije:') !!}
            {!! Form::text('name',null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Izmjeni', ['class'=>'btn btn-primary col-sm-3']) !!}
        </div>
        {{ Form::close() }}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]])!!}

        <div class="form-group">
            {!! Form::submit('Obriši', ['class'=>'btn btn-danger col-sm-3']) !!}
        </div>
        {{ Form::close() }}
    </div>
@stop
