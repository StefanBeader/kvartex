@extends('layouts.master')

@section('customStyles')
    <style>
        .panel {
            border-color: #1d1e20;
        }
        #orders {
            max-height: 50vh;
            overflow: scroll;
            overflow-x: hidden;
            padding-right: 10px;
        }
        #orders::-webkit-scrollbar {
            width: 1em;
        }

        #orders::-webkit-scrollbar-track {
            -webkit-box-shadow: none;
        }

        #orders::-webkit-scrollbar-thumb {
            background-color: #1d1e20;
            border-radius: 4px;
            outline: 1px solid slategrey;
        }
        #orders .panel-heading {
            background-color: #1d1e20;
            color: #f2c902;
            border: 0;
        }
        .panel-title a {
            color: #f2c902;
        }
        #filterNumberOfOrders {
            background-color: #f2c902;
        }
        #filterNumberOfOrders select {
            background: transparent;
            border: 2px solid #1d1e20;
            color: #1d1e20;
            font-size: 20px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        #orders .label {
            color: #333;
            padding: 0;
        }

        #orders .input-group-addon {
            font-size: 10px;
            background-color: #1d1e20;
            color: #f2c902;
            border-color: #1d1e20;
        }

        .panel-body .form-control {
            height: 24px;
            font-size: 14px;
            border-radius: 4px;
        }

        #yellow .sectionContainer {
            width: 60%;
        }

        @media only screen and (max-width: 1450px) {
            #yellow .sectionContainer {
                width: 80%;
            }
        }
    </style>

@endsection

@section('main')
    <section class="col-md-6" id="yellow">
        <div class="sectionContainer">
            <h2>{{__('Vaše Narudžbine')}}</h2>
            <div id="filterNumberOfOrders">
                {{Form::select('orders_limit', [ 5 => "5", 10 => "10", 20 => "20", 50 => "50", 100 => "100",], $ordersLimit, ['id' => 'numberOfOrders'])}}
            </div>
            <div id="orders">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($orders as $order)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#{{$order->id}}" aria-expanded="true" aria-controls="{{$order->id}}"
                                        onclick="setQrCode('{{$order->wallet}}', {{$order->id}})">
                                        {{__('Zahtev #') . $order->id}}
                                    </a>
                                </h4>
                            </div>
                            <div id="{{$order->id}}" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @if($order->order_type_id === \App\Models\Order::BUY)
                                        @include('users.partials._buyOrder', compact('order'))
                                    @elseif($order->order_type_id === \App\Models\Order::SELL)
                                        @include('users.partials._sellOrder', compact('order'))
                                    @endif
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Realizacija nakon dospeća uplate po aktuelnom kursu sa provizijom od 5%.')}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__('Status')}}</label>
                                                    {{Form::text('', $order->status->getCodeLabel() . ' '
                                                    . $order->status->updated_at->addHour(2)->format('d-m-Y H:i'), ['class' =>
                                                     in_array($order->status->status_code, [1,3]) ? 'form-control alert-success' : 'form-control alert-danger',
                                                    'readonly' => 'readonly'])}}
                                                </div>
                                                @if($order->status->status_code == \App\Models\OrderStatus::ACTIVE)
                                                    <div class="cancelOrder">
                                                        {{Form::open(['url' => '/order/cancel', 'method' => 'POST'])}}
                                                        {{Form::hidden('status_code', \App\Models\OrderStatus::CANCELED)}}
                                                        {{Form::hidden('order_id', $order->id)}}
                                                        {{Form::submit(__('Poništi narudžbinu'), ['class' => 'btn btn-danger'])}}
                                                        {{Form::close()}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row margin-top-small">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">
                                                        {{__('Potvrđujem da su podaci koje sam uneo ispravni,
                                                        razumem i prihvatam postupak transakcije i uslove po kojima se ona vrši.')}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="col-md-6" id="dark">
        <div class="sectionContainer">
            <h2>{{__('Vaš Nalog')}}</h2>
            <div>
                {{Form::open(['url' => 'userAccountUpdate', 'method' => 'POST'])}}
                <div class="form-group">
                    <label for="">{{__('Ime i Prezime')}}</label>
                    {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">{{__('Email')}}</label>
                    {{Form::email('email', $user->email, ['class' => 'form-control'])}}
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">{{__('Šifra')}}</label>
                    {{Form::password('password', ['class' => 'form-control'])}}
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">{{__('Ponovite Šifru')}}</label>
                    {{Form::password('password_confirmation', ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    <label for="">{{__('Dinarski Račun')}}</label>
                    {{Form::text('bank_account', $user->bank_account, ['class' => 'form-control'])}}
                    @if ($errors->has('bank_account'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bank_account') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        {{Form::submit('Sačuvaj', ['class' => 'btn btn-yellow'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php($message = 'Uspešno ste uneli podatke')
    @include('components.notificationSuccess', compact('message'))
@endsection

@section('customScripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js">
    </script>
    <script>
        $(document).ready(function () {

            $("#numberOfOrders").change(function () {
                window.location.replace('/account?ordersLimit=' + $(this).val());
            });
            var check = "{{Session::has('status')}}";
            if (check) {
                $("#notificationSuccess").modal('show');
            }

            var check = "{{Session::has('orderStatus')}}";
            if (check) {
                $("#orderStatus").modal('show');
            }
        });
        function setQrCode(wallet, order_id) {
            $('.qrcode' + order_id).empty();
            jQuery('.qrcode' + order_id).qrcode({width: 160, height: 160, text: wallet});
        }
    </script>
@endsection