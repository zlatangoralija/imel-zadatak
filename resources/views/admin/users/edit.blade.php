@extends('layouts.admin')

@section('content')
    {{--Forma za izmjenu krosinika, vrši se na osnovu ID-a objave--}}
    <h1>Izmjena korisnika</h1>
    <div class="row">
        <div class="col-sm-3">
            {{--Uslov koji provjerava da li korisnik ima sliku, ako je ima prikazuje se slika korisnika, ako nema prikazuje se placeholder slika sa linka--}}
            <img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-responsive img-rounded">
        </div>
        <div class="col-sm-9">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUserController@update', $user->id], 'files'=>true])!!}
            <div class="form-group">
                {!! Form::label('name','Ime: ') !!}
                {!! Form::text('name',null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','E-mail: ') !!}
                {!! Form::email('email',null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password','Lozinka: ') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id','Tip korisnika: ') !!}
                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active','Status: ') !!}
                {!! Form::select('is_active', array(1 => 'Aktivan', 0 => 'Neaktivan'), null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id','Slika: ') !!}
                {!! Form::file('photo_id', null , ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Izmijeni', ['class'=>'btn btn-primary col-sm-3']) !!}
            </div>
            {{ Form::close() }}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUserController@destroy', $user->id]])!!}
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