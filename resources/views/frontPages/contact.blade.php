@extends('layouts.master')

@section('main')

    <div class="container">
        <h1>{{__('Kontakt')}}</h1>
        <div id="contactGrid">
            <div id="contactForm">
                {{Form::open(['url' => '/sendEmail', 'method' => 'POST'])}}
                <div class="formElement">
                    <label for="">{{__('Ime')}}</label>
                    <input type="text" name="name" required>
                </div>
                <div class="formElement">
                    <label for="">{{__('Email')}}</label>
                    <input type="email" name="email" required>
                </div>
                <div class="formElement">
                    <label for="">{{__('Poruka')}}</label>
                    <textarea type="text" name="message" required></textarea>
                </div>

                <input type="submit" value="{{__('Posalji')}}" class="button yellow">
                {{Form::close()}}
            </div>

            <div id="contactInfo">
                <div>
                    <span>{{__('Telefon')}}:</span>
                    <span></span>
                </div>
                <div>
                    <span>{{__('Email')}}:</span>
                    <span></span>
                </div>
                <div>
                    <span>{{__('Facebook')}}:</span>
                    <span></span>
                </div>
                <div>
                    <span>{{__('Twitter')}}:</span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>

@endsection