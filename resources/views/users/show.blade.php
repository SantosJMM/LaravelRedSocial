@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <status-list
                            url="{{ route('users.statuses.index', $user) }}"
                        ></status-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
