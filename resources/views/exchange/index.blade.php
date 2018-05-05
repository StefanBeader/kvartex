@extends('layouts.master')

@section('customStyles')
    <style>
        #sellForm label {
            color: white;
        }

        #qurcodeContainer {
            padding: 5px;
            background: white;
        }

        .closePostViewButton {
            margin-top: 30px;
        }

        .background {
            position: absolute;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
        }

        .background svg {
            position: absolute;
            bottom: 0;
            max-height: 100%;
        }

        .action {
            z-index: 101;
        }

        #buyButton button {
            background-color: #f2c902;
            border: 4px solid #1d1e20;
            color: #1d1e20;
        }

        #sellFormContainer,
        #buyFormContainer {
            display: none;
            width: 50%;
        }

        section {
            height: calc(100vh - 200px);
        }

        .bank-slip {
            position: relative;
        }

        .bank-slip-info-overlay {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            font-size: 1.4em;
            font-weight: bold;
        }

        .bank-slip-amount {
            position: absolute;
            top: 65px;
            right: 50px;
        }

        .bank-slip-bank-account-number {
            position: absolute;
            top: 112px;
            right: 100px;
        }

        .bank-slip-message {
            position: absolute;
            top: 155px;
            right: 150px;
        }

        .bank-slip-payment-purpose {
            position: absolute;
            top: 135px;
            left: 100px;
        }
        .bank-slip-receiver {
            position: absolute;
            top: 210px;
            left: 40px;
        }

        .invalid-feedback {
            font-weight: bold;
        }
    </style>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            <section id="buy" class="col-md-6">
                <div class="action" id="buyButton">
                    <button class="showForm" data-type="buy" type="button">{{__('Kupi Kriptovalutu')}}</button>
                </div>
                <div class="background" id="buyBackground">
                    <svg viewbox=" 0 0 100 100">
                        <line x1="10%" y1="55%" x2="10%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="20%" y1="75%" x2="20%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="30%" y1="60%" x2="30%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="40%" y1="70%" x2="40%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="50%" y1="75%" x2="50%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="60%" y1="80%" x2="60%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="70%" y1="90%" x2="70%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="80%" y1="90%" x2="80%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="90%" y1="90%" x2="90%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>
                        <line x1="100%" y1="95%" x2="100%" y2="100%" style="stroke:rgb(29,30,32);stroke-width:2"/>

                        <polyline points="0,45 10,45 20,65 30,50 40,60 50,65 60,70 70,80 80,80 90,80 105,85"
                                  style="fill:none;stroke:rgb(29,30,32);stroke-width:2"/>
                        Sorry, your browser does not support inline SVG.
                    </svg>
                </div>
                <div id="buyFormContainer">
                    {{Form::open(['url' => 'offers', 'method' => 'POST', 'id' => 'buyForm'])}}
                    <div class="form-group">
                        <label for="">{{__('Izaberite Kriptovalutu koju želite da kupite')}}</label>
                        {{Form::select('currency_id',
                        \App\Models\Currency::getOptions(), '',
                        ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Unesite dinarski iznos za koji želite da kupite kriptovalutu')}}</label>
                        {{Form::number('amount', '',
                        ['class' => 'form-control',
                        'id' => 'amount'])}}
                        <span class='invalid-feedback buy_amount_error'></span>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Vaš novčanik od izabrane krptovalute')}}</label>
                        {{Form::text('wallet', \Illuminate\Support\Facades\Auth::user()->wallet, ['class' => 'form-control'])}}
                        <span class='invalid-feedback buy_wallet_error'></span>
                        {{Form::hidden('order_type_id', '2', ['id' => 'order_type_id'])}}
                    </div>
                    <div>
                        <button type="button" data-type="buy"
                                class="btn btn-order cancelOrderButton">{{__('Otkaži')}}</button>
                        <button type="button" data-type="buy"
                                class="btn btn-order submitOrderButton pull-right">{{__('Podnesi zahtev')}}
                        </button>
                    </div>
                    <div class="margin-top-small">
                        <div class="form-group">
                            <label for="">
                                {{__('Realizacija nakon dospeća uplate po aktuelnom kursu sa provizijom od 5%.')}}
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="">
                                {{__('Potvrđujem da su podaci koje sam uneo ispravni,
                                razumem i prihvatam postupak transakcije i uslove po kojima se ona vrši.')}}
                            </label>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
                <div id="buyPostSubmitView">
                    <div class="bank-slip">
                        <img src="{{asset('img/uplatnica.png')}}" class="img-responsive" alt="">
                        <div class="bank-slip-info-overlay">
                            <div class="bank-slip-amount"><span></span>,00</div>
                            <div class="bank-slip-bank-account-number">{{\App\Models\GeneralConfig::getBankAccountNumber()}}</div>
                            <div class="bank-slip-message">PR<span></span></div>
                            <div class="bank-slip-payment-purpose">PR<span></span></div>
                            <div class="bank-slip-receiver">{{\App\Models\GeneralConfig::getReceiverInfo()}}</div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-order closePostViewButton" data-type="buy">{{__('Zatvori')}}</button>
                    </div>
                </div>
            </section>
            <section id="sell" class="col-md-6">
                <div class="action" id="sellButton">
                    <button class="showForm" data-type="sell" type="button">{{__('Prodaj Kriptovalutu')}}</button>
                </div>
                <div class="background" id="sellBackground">
                    <svg viewbox=" 0 0 100 100">
                        <line x1="0%" y1="95%" x2="0%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"></line>
                        <line x1="10%" y1="90%" x2="10%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"></line>
                        <line x1="20%" y1="85%" x2="20%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>
                        <line x1="30%" y1="75%" x2="30%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>
                        <line x1="40%" y1="75%" x2="40%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>
                        <line x1="50%" y1="70%" x2="50%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"></line>
                        <line x1="60%" y1="70%" x2="60%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>
                        <line x1="70%" y1="55%" x2="70%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>
                        <line x1="80%" y1="45%" x2="80%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>
                        <line x1="90%" y1="35%" x2="90%" y2="100%" style="stroke:rgb(242,201,2);stroke-width:2"/>

                        <polyline points="-5,85 10,80 20,75 30,65 40,65 50,60 60,60 70,45 80,35 90,25 100,25"
                                  style="fill:none;stroke:rgb(242,201,2);stroke-width:2"/>
                        Sorry, your browser does not support inline SVG.
                    </svg>
                </div>
                <div id="sellFormContainer">
                    {{Form::open(['url' => 'offers', 'method' => 'POST', 'id' => 'sellForm'])}}
                    <div class="form-group">
                        <label for="">{{__('Izaberite kriptovalutu koju želite da prodate')}}</label>
                        {{Form::select('currency_id',
                        \App\Models\Currency::getOptions(), '',
                        ['class' => 'form-control', 'id' => 'currency_id'])}}
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Unesite iznos kriptovalute koji želite da prodate')}}</label>
                        {{Form::number('amount', '',
                        ['class' => 'form-control', 'step' => 0.00000001, 'id' => 'amount'])}}
                        <span class='invalid-feedback sell_amount_error'></span>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Vaš dinarski tekući račun')}}</label>
                        {{Form::text('bank_account', Auth::user()->bank_account, ['class' => 'form-control', 'id' => 'bank_account'])}}
                        {{Form::hidden('order_type_id', '2', ['id' => 'order_type_id'])}}
                        <span class='invalid-feedback sell_bank_account_error'></span>
                    </div>
                    <div>
                        <button type="button" data-type="sell"
                                class="btn btn-order cancelOrderButton">{{__('Otkaži')}}</button>
                        <button type="button" data-type="sell"
                                class="btn btn-order submitOrderButton pull-right">{{__('Podnesi zahtev')}}
                        </button>
                    </div>
                    <div class="margin-top-small">
                        <div class="form-group">
                            <label for="">
                                {{__('Realizacija nakon dospeća uplate po aktuelnom kursu sa provizijom od 5%.')}}
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="">
                                {{__('Potvrđujem da su podaci koje sam uneo ispravni,
                                razumem i prihvatam postupak transakcije i uslove po kojima se ona vrši.')}}
                            </label>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
                <div id="sellPostSubmitView">
                    <div class="form-group">
                        <label for="">{{__('Novčanik za uplatu kriptovalute')}}</label>
                        {{Form::text('', '', ['class' => 'form-control', 'id' => 'wallet', 'readonly' => true])}}
                    </div>
                    <div id="qurcodeContainer">
                        <div id="qrcode"></div>
                    </div>
                    <div>
                        <button class="btn btn-order closePostViewButton" data-type="sell">{{__('Zatvori')}}</button>
                    </div>
                </div>
            </section>
        </div>
        <div class="row">
            @include('components.coinValues')
        </div>
    </div>
@endsection

@section('customScripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js">
    </script>
    {{Html::script('js/sendOrder.js')}}
    {{Html::script('js/coinValues.js')}}
@endsection