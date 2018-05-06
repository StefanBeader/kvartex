@extends('layouts.dashboard')

@section('main')
    <h1>{{__('Kontakt Poruke')}}</h1>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <th>{{__('Ime')}}</th>
                <th>{{__('E-mail')}}</th>
                <th>{{__('Pročitaj')}}
                @foreach($contactMessages as $message)
                        <tr>
                            <td>{{$message->name}}</td>
                            <td>{{$message->email}}</td>
                            <td>
                                <a href="{{URL::to('/contactMessage/' . $message->id)}}">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </td>
                        </tr>
                @endforeach    
            </table>
        </div>
    </div>
@endsection