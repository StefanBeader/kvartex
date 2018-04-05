@extends('layouts.master')

@section('main')
    <div class="banner">
        <div id="particles"></div>
        <div class="bannerText">
            <h1>{{__('Sve o kripto valutama na jednom mestu')}}</h1>
        </div>
    </div>
    <div class="container">
        <div id="coinValues">
            <div class="coin">
                <span class="coinLogo"><img src="{{asset('img/coinLogos/bitcoin.png')}}" alt=""></span>
                <span>{{__('BitCoin')}}</span>
                <span id="bitcoinValue"></span>
            </div>
            <div class="coin">
                <span class="coinLogo"><img src="{{asset('img/coinLogos/ETHEREUM.png')}}" alt=""></span>
                <span>{{__('Ethereum')}}</span>
                <span id="ethereumValue"></span>
            </div>
            <div class="coin">
                <span class="coinLogo"><img src="{{asset('img/coinLogos/ltc.png')}}" alt=""></span>
                <span>{{__('LiteCoin')}}</span>
                <span id="litecoinValue"></span>
            </div>
            <div class="coin">
                <span class="coinLogo"><img src="{{asset('img/coinLogos/ripple.png')}}" alt=""></span>
                <span>{{__('Ripple')}}</span>
                <span id="rippleValue"></span>
            </div>

            <div class="small-text">*{{__('Cene su preuzete sa Bitstamp-a')}}</div>
        </div>
    </div>
@endsection

@section('customScripts')
    {{Html::script('js/particles/particles.min.js')}}
    <script>
        particlesJS.load('particles', '{{asset('js/particles/particlesjs-config.json')}}');
    </script>

    <script>
        $(document).ready(function () {

            getCurrenciesValues();

            setInterval(getCurrenciesValues, 60000);

        });
        
        function getCurrenciesValues() {

            $.get(
                '/getValues',
                function (data) {
                    $('#bitcoinValue').text(data.bitcoin + "$");
                    $('#ethereumValue').text(data.ethereum + "$");
                    $('#litecoinValue').text(data.litecoin + "$");
                    $('#rippleValue').text(data.ripple + "$");

                    console.log('awdawd');
                }
            )
        }
    </script>

@endsection