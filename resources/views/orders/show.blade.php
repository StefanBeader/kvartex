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
    @php
        $bank_account1 = substr($order->bank_account, 0, -15);
        $bank_account2 = substr($order->bank_account, 0, -2);
        $bank_account2 = substr($bank_account2, 3);
        $bank_account3 = substr($order->bank_account, 0, -16);
    @endphp
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