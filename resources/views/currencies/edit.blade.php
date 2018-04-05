@extends('layouts.master')

@section('main')

    <div class="container">
        <h1>{{__('Promeni Valutu')}}</h1>
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
                {{Form::open(array('url' => 'currency/' . $currency->id, 'method' => 'PUT'))}}

                <div class="form-group">
                    <label for="">{{__('Naziv')}}</label>
                    {{Form::text('display_name', $currency->display_name, ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Skracenica')}}</label>
                    {{Form::text('short_name', $currency->short_name, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Wallet za Bitstamp')}}</label>
                    {{Form::text('wallet_bitstamp', $currency->wallet_bitstamp, ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Wallet za CEX')}}</label>
                    {{Form::text('wallet_cex', $currency->wallet_cex, ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Red')}}</label>
                    {{Form::number('order', $currency->order, ['required' => 'required', 'class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Aktivna')}}</label>
                    {{Form::select('is_active', [1 => __('Da'), 0 => __('Ne')], $currency->is_active, ['required' => 'required', 'class' => 'form-control'])}}
                </div>

                {{Form::submit('Sacuvaj', ['class' => 'btn btn-primary'])}}

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection