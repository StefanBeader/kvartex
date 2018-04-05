@extends('layouts.master')

@section('customStyles')
    <style>
        #main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: calc(100vh - 100px);
        }

        #ordersContainer {
            background-color: #f2c902;
            display: grid;
            grid-template-columns: 1fr;
            align-content: center;
            justify-content: center;
            padding: 0 30px;
        }

        #ordersContainer .panel-group {
            width: 100%;
        }

        #orders {
            min-width: 100%;
        }

        .panel {
            border-color: #1d1e20;
        }

        #orders .panel-heading {
            background-color: #1d1e20;
            color: #f2c902;
            border: 0;
        }

        #formContainer {
            background-color: #1d1e20;
            display: grid;
            padding: 0 30px;
            align-content: center;
        }

        #formContainer h2 {
            color: #f2c902;
            margin-bottom: 30px;
        }

        #formContainer label {
            color: #f2c902;
        }

        .form-control {
            border-radius: 0;
            height: 44px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #f2c902;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(242, 201, 2, .6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(242, 201, 2, .6);
        }

        .input-group-addon {
            background-color: #f2c902;
            color: #1d1e20;
            border-color: #f2c902;
        }

        .invalid-feedback {
            color: #a94442;
            margin-top: 10px;
            display: block;
        }

        #formContainer .btn-yellow {
            margin-top: 20px;
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
        }

        @media (max-width: 768px) {
            #main {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
            }

        }

        @media (min-width: 768px) and (max-width: 992px) {
        }

        @media (min-width: 992px) and (max-width: 1200px) {
        }

        @media (min-width: 1200px) {
            #formContainer {
                padding: 0 150px;
            }
        }

        @media (min-width: 1400px) {
            #formContainer,
            #ordersContainer
            {
                padding: 0 200px;
            }
        }
    </style>

@endsection

@section('main')
    <div id="formContainer">
            <div>
                <h2>{{__('Vas Nalog')}}</h2>
                <div>
                    {{Form::open(['url' => 'userAccountUpdate', 'method' => 'POST'])}}
                    <div class="form-group">
                        <label for="">{{__('Ime i Prezime')}}</label>
                        {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Email')}}</label>
                        {{Form::email('email', $user->email, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Sifra')}}</label>
                        {{Form::password('password', ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Ponovite Sifru')}}</label>
                        {{Form::password('password_confirmation', ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Dinarski Racun')}}</label>
                        {{Form::text('bank_account', $user->bank_account, ['class' => 'form-control'])}}
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-3">
                            {{Form::submit('Sacuvaj', ['class' => 'btn btn-yellow'])}}
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div id="ordersContainer">
            <h2>{{__('Vase Narudzbine')}}</h2>
            <div id="filterNumberOfOrders">
                <select name="" id="numberOfOrders">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div id="orders">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($orders as $order)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$order->id}}" aria-expanded="true" aria-controls="{{$order->id}}">
                                        {{__('Zahtev #') . $order->id}}
                                    </a>
                                </h4>
                            </div>
                            <div id="{{$order->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
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
@endsection

@section('customScripts')
    <script>
        $(document).ready(function () {
            $("#numberOfOrders").change(function () {
                window.location.replace('/account?ordersLimit=' + $(this).val())
            });
        });
    </script>
@endsection