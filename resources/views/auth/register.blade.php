@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                @include('partials.validation-errors')
                <div class="card border-0 px-4 py-2">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Username:</label>
                                <input class="form-control bg-light border-0" type="text" name="name" id="name" placeholder="Tu nombre de usuario...">
                            </div>

                            <div class="form-group">
                                <label for="first_name">Nombre:</label>
                                <input class="form-control bg-light border-0" type="text" name="first_name" id="first_name" placeholder="Tu nombre...">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Apellido:</label>
                                <input class="form-control bg-light border-0" type="text" name="last_name" id="last_name" placeholder="Tu apellido...">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control bg-light border-0" type="email" name="email" id="email" placeholder="Tu nombre...">
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input class="form-control bg-light border-0" type="password" name="password" id="password" placeholder="Tu contraseña...">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Repite la contraseña:</label>
                                <input class="form-control bg-light border-0" type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite tu contraseña...">
                            </div>
                            <button class="btn btn-primary btn-block" dusk="register-btn">Registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
