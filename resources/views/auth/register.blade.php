@extends('layouts.master')

@section('customStyles')
    <style>
        #main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: calc( 100vh - 100px);
        }

        #loginBrand {
            background-color: #f2c902;
            display: grid;
            align-content: center;
            justify-content: center;
        }
        #registrationForm {
            background-color: #1d1e20;
            display: grid;
            padding: 0 30px;
            align-content: center;
        }

        #registrationForm h2 {
            color: #f2c902;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 0;
            height: 44px;
            font-size: 16px;
        }
        .form-control:focus {
            border-color: #f2c902;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(242,201,2,.6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(242,201,2,.6);
        }

        .input-group-addon {
            background-color: #f2c902;
            color: #1d1e20;
            border-color: #f2c902;
        }
        .invalid-feedback {
            color: #a94442;
            margin-top: 10px;
            display: block;
        }

        #registrationForm .btn-yellow {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            #main {
                grid-template-columns: 1fr;
            }

            #loginBrand {
                display: none;
            }
        }
        @media (min-width: 768px) and (max-width: 992px) {  }
        @media (min-width: 992px) and (max-width: 1200px) { }

        @media (min-width: 1200px) {
            #registrationForm {
                padding: 0 150px;
            }
        }

        @media (min-width: 1400px) {
            #registrationForm {
                padding: 0 200px;
            }
        }
    </style>
@endsection

@section('main')
    <div id="loginBrand">
        <img src="{{asset('img/skyline.svg')}}" alt="">
    </div>
    <div id="registrationForm">
        <div>
            <h2>{{__('Napravite Nalog')}}</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                   placeholder="{{__('Vaše Ime i Prezime')}}"
                                   required autofocus>
                        </div>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </div>
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               name="email" value="{{ old('email') }}"
                               placeholder="{{__('Vaš Email')}}"
                               required>
                    </div>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password"
                               placeholder="Vaša Šifra"
                               required>
                    </div>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>
                        <input id="password-confirm" type="password"
                               class="form-control"
                               name="password_confirmation"
                               placeholder="{{__('Ponovite Šifru')}}"
                               required>
                    </div>
                </div>

                <div class="form-group margin-left">
                        <button type="submit" class="btn btn-yellow">
                            {{__('Registruj se')}}
                        </button>
                </div>
            </form>
        </div>
    </div>
@endsection

