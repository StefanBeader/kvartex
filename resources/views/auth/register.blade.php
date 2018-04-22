@extends('layouts.master')

@section('customStyles')
    <style>
        section#dark h2 {
            color: #f2c902;
            margin-bottom: 20px;
        }

        .btn-yellow {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            section#dark {
                display: none;
            }
        }
    </style>
@endsection

@section('main')
    <section id="yellow" class="col-md-6">
        <div class="sectionContainer">
            <img src="{{asset('img/note.svg')}}" alt="">
        </div>
    </section>
    <section id="dark" class="col-md-6">
        <div class="sectionContainer">
            <h2>{{__('Napravite Nalog')}}</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input id="name" type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                               value="{{ old('name') }}"
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
    </section>
@endsection

