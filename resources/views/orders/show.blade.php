@extends('layouts.dashboard')

@section('customStyles')
    <style>
        #status-column {
            display: grid;
            justify-items: center;
        }

        h3, h4 {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('main')

    <h1>{{__('Narudzbina')}}</h1>
    <hr>

    @if($order->order_type_id === \App\Models\Order::SELL)
        @include('orders._sell')
    @elseif($order->order_type_id === \App\Models\Order::BUY)
        @include('orders._buy')
    @endif

@endsection

@section('customScripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js">
    </script>
    <script>
        jQuery('#qrcode').qrcode('{{$order->wallet}}');
    </script>
@endsection