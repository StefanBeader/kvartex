@extends('layouts.dashboard')

@section('main')

    <h1>{{__('Korisnici')}}</h1>
    <hr>

    <table class="table table-striped">
        <thead>
            <th>{{__('Ime')}}</th>
            <th>{{__('Email')}}</th>
            <th>{{__('Prava')}}</th>
            <th>{{__('Poruke')}}</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection