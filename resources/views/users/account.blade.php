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
                                       href="#{{$order->id}}" aria-expanded="true" aria-controls="{{$order->id}}">
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
    <script>
        $(document).ready(function () {
            $("#numberOfOrders").change(function () {
                window.location.replace('/account?ordersLimit=' + $(this).val())
            });
            var check = "{{Session::has('status')}}";
            if (check) {
                $("#notificationSuccess").modal('show');
            }
        });
    </script>
@endsection