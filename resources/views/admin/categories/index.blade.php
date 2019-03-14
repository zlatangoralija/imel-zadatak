@extends('layouts.admin')

@section('content')
    {{--Poruka koja se ispisuje prilikom brisanja ili izmjene kategorije --}}
    @if(Session::has('edited_category'))
        <p class="bg-info">{{session('edited_category')}}</p>
    @endif
    @if(Session::has('deleted_category'))
        <p class="bg-info">{{session('deleted_category')}}</p>
    @endif
    <h1>Kategorije</h1>
    {{--Forma za unos nove kategorije, te tabela za prikaz svih ostalih kategorija--}}
    <div class="col-sm-6">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store'])!!}
        <div class="form-group">
            {!! Form::label('name','Kreiraj novu kategoriju:') !!}
            {!! Form::text('name',null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Potvrdi', ['class'=>'btn btn-primary']) !!}
        </div>
        {{ Form::close() }}
        @include('includes.form_error')
    </div>
    <div class="col-sm-6">
        {{--Ako ima kategorija u bazi podataka, prikazat će se ispod--}}
        @if($categories)
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv kategorije</th>
                    <th>Datum kreiranja</th>
                </tr>
                </thead>
                <tbody>
                {{--For each petljom ispisujemo sve kategorije i podatke o kategorijama--}}
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

@stop