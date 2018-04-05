@extends('layouts.dashboard')

@section('main')

    <h1>{{__('Korisnici')}}</h1>
    <hr>
    
    <div id="actionBar">
        <a href="{{URL::to('/user/create')}}" class="btn btn-primary">{{__('Napravi Korisnika')}}</a>
    </div>
    
    <table class="table table-striped">
        <thead>
            <th>{{__('Ime')}}</th>
            <th>{{__('Email')}}</th>
            <th>{{__('Prava')}}</th>
            <th>{{__('Akcije')}}</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{implode(', ', $user->getRoles())}}</td>
                <td>
                    <a class="actionButton" href=""><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a class="actionButton" href=""><span class="glyphicon glyphicon-edit"></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection