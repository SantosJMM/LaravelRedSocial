@extends('layouts.app')

@section('content')
    <div class="container">
    	@foreach($friendshipRequests as $friendshipRequest)
	        <accept-friendship-btn
	            dusk="accept-friendship"
	            friendship-status="{{ $friendshipRequest->status }}"
	            :sender="{{ $friendshipRequest->sender }}"
	        ></accept-friendship-btn>
	    @endforeach
    </div>
@endsection
