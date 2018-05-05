@extends('layouts.dashboard')

@section('customStyles')
    <style>
        #orders_grid .btn-primary {
            width: auto;
        }
    </style>
@endsection

@section('main')
    <h1>{{__('Narudzbine')}}</h1>
    <hr>
    {!! $grid !!}
@endsection