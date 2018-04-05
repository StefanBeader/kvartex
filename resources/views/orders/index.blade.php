@extends('layouts.dashboard')

@section('main')
    <h1>{{__('Narudzbine')}}</h1>
    <hr>

    {{--<table class="table table-striped">--}}
        {{--<thead>--}}
        {{--<th>{{__('Broj')}}</th>--}}
        {{--<th>{{__('Korisnik')}}</th>--}}
        {{--<th>{{__('Valuta')}}</th>--}}
        {{--<th>{{__('Vrednost')}}</th>--}}
        {{--<th>{{__('Tip')}}</th>--}}
        {{--<th>{{__('Datum')}}</th>--}}
        {{--<th>{{__('Akcije')}}</th>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach($orders as $order)--}}
            {{--<tr>--}}
                {{--<td>{{$order->id}}</td>--}}
                {{--<td>{{$order->user->name}}</td>--}}
                {{--<td>{{\App\Models\Currency::getName($order->currency_id)}}</td>--}}
                {{--<td>{{$order->order_type_id === \App\Models\Order::BUY ? $order->amount . ' rsd' : $order->amount}}</td>--}}
                {{--<td>{{$order->order_type}}</td>--}}
                {{--<td>{{$order->created_at->format('m-d-Y')}}</td>--}}
                {{--<td>--}}
                    {{--<a class="actionButton" href="{{URL::to('order/' . $order->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-eye-open"></span>--}}
                    {{--</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}

    {!! $grid !!}
@endsection