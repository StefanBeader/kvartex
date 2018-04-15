@extends('layouts.dashboard')

@section('main')

    <h1>{{__('Dashboard')}}</h1>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-brand">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Porudzbine')}}</h3>
                </div>
                <div class="panel-body">
                    <h4>{{__('Broj Novih Porudzbina Danas')}}: {{$numberOfOrdersToday}}</h4>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-brand">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Nove Poruke - od Korisnika')}}</h3>
                </div>
                <div class="panel-body">
                    {!! $messagesGrid !!}
                </div>
            </div>
        </div>
    </div>
@endsection