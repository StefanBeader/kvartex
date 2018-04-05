@extends('layouts.master')

@section('customStyles')
    <style>
        input[type=number] {
            width: 30%;
        }
    </style>
@endsection
@section('main')

    <div class="container">
        <h1>{{__('Dodaj Valutu')}}</h1>
        <hr>
        @if(count( $errors ) > 0 )
            <ul class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="row">
            <div class="col-lg-6">
                {{Form::open(array('url' => 'currency', 'method' => 'POST'))}}

                <div class="form-group">
                    <label for="">{{__('Naziv')}}</label>
                    {{Form::text('display_name', '', ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Skracenica')}}</label>
                    {{Form::text('short_name', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Wallet za Bitstamp')}}</label>
                    {{Form::text('wallet_bitstamp', '', ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Wallet za CEX')}}</label>
                    {{Form::text('wallet_cex', '', ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Red')}}</label>
                    {{Form::number('order', '', ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Aktivna')}}</label>
                    {{Form::select('is_active',
                    [1 => __('Da'), 0 => __('Ne')],
                    '',
                    ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                {{Form::submit('Sacuvaj', ['class' => 'btn btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>

    </div>

@endsection