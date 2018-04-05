@extends('layouts.master')

@section('customStyles')
    <style>
        .message {
            padding: 10px 15px;
            background-color: #f2c902;
            color: #1d1e20;
            margin-bottom: 5px;
        }

        .admin {
            background-color: #1d1e20;
            color: #f2c902;
        }

        .sort-list {
            list-style: none;
        }
    </style>
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('Vase Poruke sa Administratorom')}}</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{Form::open(['url' => '/sendMessage', 'method' => 'POST'])}}
                <div class="form-group">
                    <div class="input-group">
                        {{Form::text('body', '', ['class' => 'form-control', 'placeholder' => __('Nova Poruka')])}}
                        <div class="input-group-addon">
                            {{Form::submit('Posalji', ['class' => 'btn btn-block'])}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
        <div class="row">
            <ul class="sort-list col-md-12">
                @foreach($messages as $message)
                        <li class="sort-item message" data-event-date="{{$message->created_at->timestamp}}">
                            <span>{{$message->body}}</span>
                            <time class="pull-right">{{$message->created_at->format('H:i:s d-m-Y')}}</time>
                        </li>
                @endforeach

                    @foreach($messageReplays as $message)
                            <li class="sort-item message admin" data-event-date="{{$message->created_at->timestamp}}">
                                <span>{{$message->body}}</span>
                                <time class="pull-right">{{$message->created_at->format('H:i:s d-m-Y')}}</time>
                            </li>
                    @endforeach
            </ul>
        </div>
    </div>

@endsection

@section('customScripts')
    <script>
        setTimeout(function() {
            location.reload();
        }, 30000);
        (function($){
            var container = $(".sort-list");
            var items = $(".sort-item");

            items.sort(function(a,b){
                a = parseInt($(a).attr("data-event-date"));
                b = parseInt($(b).attr("data-event-date"));
                return a<b ? -1 : a>b ? 1 : 0;
            }).each(function(){
                container.prepend(this);
            });

        })(jQuery);
    </script>
@endsection