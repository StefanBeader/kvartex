@extends('layouts.dashboard')

@section('main')
    <h1>{{__('Konfiguracija')}}</h1>
    <hr>

    <div class="col-md-6">
        {{Form::open(['url' => 'config' . $config->id, 'method' => 'PUT'])}}
        <div class="form-group">
            <label for="">{{__('Primarni wallet')}}</label>
            {{Form::select('primary_wallet', ['cex' => 'CEX', 'bitstamp' => 'BitStamp'], '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Racun u banci')}}</label>
            {{Form::text('bank_account', $config->bank_account, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Minimum Vrednost Narudzbine')}}</label>
            {{Form::number('min_order_amount', $config->min_order_amount, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Maximum Vrednost Narudzbine')}}</label>
            {{Form::number('max_order_amount', $config->max_order_amount, ['class' => 'form-control'])}}
        </div>
        <button class="btn btn-primary">{{__('Sacuvaj')}}</button>
        {{Form::close()}}
    </div>

@endsection