@extends('layouts.admin')
@section('content')
    {{--Poruka koja se ispisuje prilikom brisanja ili izmjene korisnika --}}
    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{session('deleted_user')}}</p>
    @endif
    @if(Session::has('edited_user'))
        <p class="bg-info">{{session('edited_user')}}</p>
    @endif
    {{--Tabela za prikaz korisnika--}}
    <h1>Korisnici</h1>
    <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ime</th>
            <th>Slika</th>
            <th>E-mail</th>
            <th>Tip korisnika</th>
            <th>Status</th>
            <th>Datum kreiranja</th>
            <th>Datum izmjene</th>
          </tr>
        </thead>
        <tbody>
        {{--Ako ima korisnika u bazi podaka, izvšit će se prikaz--}}
        @if($users)
            {{--For each petlja za prikaz svih korisnika iz baze podataka pojedinačno--}}
            @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                <td><img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/50x50'}}" height="50"></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
              </tr>
          @endforeach
        @endif
        </tbody>
    </table>
@stop

