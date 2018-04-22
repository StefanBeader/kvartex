@extends('layouts.master')

@section('customStyles')
    <style>
        section#dark h2 {
            margin-bottom: 20px;
        }

        .checkbox label {
            color: #f2c902;
        }

        .btn-yellow {
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            section#yellow {
                display: none;
            }
        }
    </style>
@endsection

@section('main')
    <section id="yellow" class="col-md-6">
        <div class="sectionContainer">
            <img src="{{asset('img/login.svg')}}" alt="">
        </div>
    </section>
    <section id="dark" class="col-md-6">
        <div class="sectionContainer">
            <h2>{{__('Ulogujte se na Vaš nalog')}}</h2>
            <div class="form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </div>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="{{__('Vaš Email')}}"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input id="password" type="password"
                                   class="form-control no-bottom-border{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password"
                                   placeholder="{{__('Vaša Šifra')}}"
                                   required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group margin-left">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="form-group margin-left">
                        <button type="submit" class="btn btn-yellow">
                            {{__('Uloguj se')}}
                        </button>

                        <a class="btn btn-yellow" href="{{ route('password.request') }}">
                            {{__('Zaboravili ste šifru')}}?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
