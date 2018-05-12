@extends('layouts.dashboard')
@section('customStyles')
    <style>
        .alert-success,
        .alert-danger
        {
            background-color: transparent;
        }
    </style>
@endsection
@section('main')

    <h1>{{__('Korisnici')}}</h1>
    <hr>

    <table class="table table-striped">
        <thead>
            <th>{{__('Ime')}}</th>
            <th>{{__('Email')}}</th>
            <th>{{__('Prava')}}</th>
            <th>{{__('Poruke')}}</th>
            <th>{{__('Trgovanje')}}</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{implode(', ', $user->getRoles())}}</td>
                <td>
                    @if(! $user->hasRole('admin'))
                        <a class="actionButton" href="{{URL::to('/dashboardUserMessages?user_id=' . $user->id)}}"><span class="glyphicon glyphicon-envelope"></span></a>
                    @endif
                </td>
                <td>
                    @if($user->can_trade === \App\User::CAN_TRADE)
                        <a href="{{URL::to('traderStatus?user_id=' . $user->id . '&status_id=2')}}"
                           data-toggle="tooltip" data-placement="bottom" title="Ukloni prava trgovanja korisniku">
                            <span class="glyphicon glyphicon-remove alert-danger"></span>
                        </a>
                    @else
                        <a href="{{URL::to('traderStatus?user_id=' . $user->id . '&status_id=1')}}"
                           data-toggle="tooltip" data-placement="bottom" title="Dodaj prava trgovanja korisniku">
                            <span class="glyphicon glyphicon-ok alert-success"></span>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection