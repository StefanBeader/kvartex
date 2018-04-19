@extends('layouts.master')

@section('main')
    <div class="banner">
        <div id="particles"></div>
        <div class="bannerText">
            <h1>{{__('Sve o kripto valutama na jednom mestu')}}</h1>
        </div>
    </div>
    <div class="container">
        @include('components.coinValues')
    </div>
@endsection

@section('customScripts')
    {{Html::script('js/particles/particles.min.js')}}
    <script>
        particlesJS.load('particles', '{{asset('js/particles/particlesjs-config.json')}}');
    </script>
    {{Html::script('js/coinValues.js')}}
@endsection