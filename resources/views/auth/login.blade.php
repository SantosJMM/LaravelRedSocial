@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                @include('partials.validation-errors')
                <div class="card border-0 px-4 py-2">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control bg-light border-0" type="email" name="email" id="email" placeholder="Tu nombre...">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input class="form-control bg-light border-0" type="password" name="password" id="password" placeholder="Tu contraseña...">
                            </div>
                            <button class="btn btn-primary btn-block" dusk="login-btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
