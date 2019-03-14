@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dobrodošli!</div>

                    <div class="panel-body">
                        Ako već imate račun na našem portalu, molimo Vas da se prijavite. Ako to nije slučaj, molimo Vas da se registrujete.<br>
                        <b>NAPOMENA:</b> Za pristup admin panelu, prijavite se preko administratorskog računa:<br>
                        E-mail: admin@yahoo.com<br>
                        Lozinka: admin123
                        <br>
                        <br>
                        <i>Registracijom se samo kreira novi korisnik, za koji nije kreiran nikakav poseban panel. U ovom zadatku samo administratori imaju svoj panel kojem mogu pristupiti</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
