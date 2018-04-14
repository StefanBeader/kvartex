@extends('layouts.master')

@section('customStyles')
    <style>
        #yellow {
            background-color: #f2c902;
        }
        #dark {
            background-color: #1d1e20;
        }
        .social-media-logos {
            height: 70px;
            max-width: 100%;
            margin-right: 15px;
            transition: all .5s;
        }

        .social-media-logos:hover {
            transform: scale(1.2);
        }
    </style>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            <section id="yellow" class="col-md-6">
                <div>
                    <h2>{{__('Posaljite nam poruku')}}</h2>
                    {{Form::open(['url' => '/contact/sendMessage', 'method' => 'POST'])}}

                    <div class="form-group">
                        <label for="">{{__('Ime i Prezime')}}</label>
                        {{Form::text('name', '', ['class' => 'form-control'])}}
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Email')}}</label>
                        {{Form::email('email', '', ['class' => 'form-control'])}}
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Poruka')}}</label>
                        {{Form::textarea('message', '', ['class' => 'form-control'])}}
                        @if ($errors->has('message'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-dark">{{__('Posalji')}}</button>

                    {{Form::close()}}
                </div>
            </section>
            <section id="dark" class="col-md-6">
                <div>
                    <a href="https://www.facebook.com/groups/1145391685476366/" target="_blank">
                        <img class="social-media-logos" src="{{asset('img/facebook-logo-button.svg')}}" alt="">
                    </a>
                    <a href="">
                        <img class="social-media-logos" src="{{asset('img/linkedin-logo.svg')}}" alt="">
                    </a>
                    <a href="">
                        <img class="social-media-logos" src="{{asset('img/twitter-logo-button.svg')}}" alt="">
                    </a>
                </div>
            </section>
        </div>
    </div>
@endsection