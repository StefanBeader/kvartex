@extends('layouts.dashboard')

@section('main')
    <h1>{{__('Nove Poruke')}}</h1>
    <hr>
    <div class="row">
        <div class="col-md-6">
            {!! $messagesGrid !!}
        </div>
    </div>
@endsection