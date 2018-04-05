@extends('layouts.dashboard')

@section('breadcrumbs')
    <li class="active">{{__('Valute')}}</li>
@endsection

@section('main')

    <h1>{{__('Valute')}}</h1>

    <div id="actionbar">
        <a href="{{URL::to('currency/create')}}" class="button dark">{{__('Dodaj Valutu')}}</a>
    </div>

    <div id="grid">
        <table class="table table-bordered ">
            <thead>
            <th>{{__('Naziv')}}</th>
            <th>{{__('Skracenica')}}</th>
            <th>{{__('Wallet Bitstamp')}}</th>
            <th>{{__('Wallet CEX')}}</th>
            <th>{{__('Order')}}</th>
            <th>{{__('Aktivna')}}</th>
            <th>{{__('Akcije')}}</th>
            </thead>
            <tbody>
            @foreach($currencies as $currency)
                <tr>
                    <td>{{$currency->display_name}}</td>
                    <td>{{$currency->short_name}}</td>
                    <td>{{$currency->wallet_bitstamp}}</td>
                    <td>{{$currency->wallet_cex}}</td>
                    <td>{{$currency->order}}</td>
                    <td>{{$currency->is_active ? __('Da') : __('Ne')}}</td>
                    <td>
                        <a href="{{asset('currency/' . $currency->id . '/edit')}}">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        {{Form::open(['url' => 'currency/' . $currency->id, 'method' => 'DELETE'])}}
                        <button type="submit">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        {{Form::close()}}
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('customScripts')
    <script>
        $(document).ready(function () {
            $('form').submit(function (e) {
                e.preventDefault();
                if (confirm(' <?= __('Da li ste sigurni da zelite da obrisete izabranu valutu?') ?> ')) {
                    $(this)[0].submit();
                }
            });
        });
    </script>
@endsection