@extends('layouts.master')

@section('customStyles')
    <style>
        .social-media-logos {
            height: 70px;
            max-width: 100%;
            margin-right: 15px;
            transition: all .5s;
        }
        .social-media-logos:hover {
            transform: scale(1.2);
        }

        .modal-header {
            background-color: #1d1e20;
            color: #f2c902;
            border-bottom: none;
        }

        .modal-body {
            background-color: #f2c902;
        }
        .modal-body img {
            height: 150px;
            margin: 30px auto;
        }
        .modal-footer {
            background-color: #1d1e20;
            border-top: none;
        }
    </style>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            <section id="yellow" class="col-md-6">
                <div>
                    <h2>{{__('Pošaljite nam poruku')}}</h2>
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
                    <button type="submit" class="btn btn-dark">{{__('Pošalji')}}</button>

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

    <div class="modal fade" tabindex="-1" role="dialog" id="messageSuccess">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Uspešno ste poslali poruku')}}</h4>
                </div>
                <div class="modal-body">
                    <img src="{{asset('img/ok.svg')}}" alt="" class="img-responsive">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yellow" data-dismiss="modal">{{__('Zatvori')}}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('customScripts')
    <script>
        $(document).ready(function () {
           if ({{\Illuminate\Support\Facades\Session::has('status')}}) {
                $("#messageSuccess").modal('show');
           }
        });
    </script>
@endsection