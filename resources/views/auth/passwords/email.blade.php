@extends('layouts.master')

@section('customStyles')
    <style>
        #main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: calc(100vh - 100px);
        }

        #iconContainer {
            background-color: #f2c902;
            display: grid;
            align-content: center;
            justify-content: center;
        }

        #formContainer {
            background-color: #1d1e20;
            display: grid;
            padding: 0 30px;
            align-content: center;
        }

        #formContainer h2 {
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
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(242, 201, 2, .6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(242, 201, 2, .6);
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

        #formContainer .btn-yellow {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            #main {
                grid-template-columns: 1fr;
            }

            #iconContainer {
                display: none;
            }
        }

        @media (min-width: 768px) and (max-width: 992px) {
        }

        @media (min-width: 992px) and (max-width: 1200px) {
        }

        @media (min-width: 1200px) {
            #formContainer {
                padding: 0 150px;
            }
        }

        @media (min-width: 1400px) {
            #formContainer {
                padding: 0 200px;
            }
        }
    </style>
@endsection

@section('main')
    <div id="iconContainer"></div>
    <div id="formContainer">
        <div>
            <h2>{{__('Pošalji reset link za Šifru')}}</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </div>
                        <input placeholder="{{__('Vas Email')}}" id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required>
                    </div>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-yellow">
                    {{__('Pošalji')}}
                </button>
            </form>
        </div>
    </div>
@endsection
