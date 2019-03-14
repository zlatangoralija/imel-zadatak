@extends('layouts.admin')

@section('content')
    {{--Forma za kreiranje novog korisnika--}}
    <h1>Kreiranje korisnika</h1>
    {!! Form::open(['method'=>'POST', 'action'=>'AdminUserController@store', 'files'=>true])!!}
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
        {!! Form::select('role_id', array('' => 'Odaberi tip korisnika...') +$roles, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active','Status: ') !!}
        {!! Form::select('is_active', array(1 => 'Aktivan', 0 => 'Neaktivan'), 0, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id','Slika: ') !!}
        {!! Form::file('photo_id', null , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Potvrdi', ['class'=>'btn btn-primary']) !!}
    </div>
    {{ Form::close() }}
    {{--Pozivamo errore koji se ispisuju ako forma nije dobro pounjena--}}
    @include('includes.form_error')
@stop