@extends('layouts.dashboard')

@section('customStyles')
    <style>

        #main {
            overflow: auto;
        }
        #messages {
            height: 50vh;
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .message {
            display: grid;
            grid-template-columns: 50% 50%;
            margin-bottom: 5px;
        }
        .sort-list {
            list-style: none;
        }
        .sort-list li .user-message,
        .sort-list li .admin-message
        {
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
        }
        .sort-list li .user-message {
            grid-column: 1/2;
            background-color: var(--main);
        }
        .sort-list li .admin-message {
            grid-column: 2/3;
            background-color: var(--orange);
        }

        time:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('main')
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('Vase Poruke sa Korisnikom')}}</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{Form::open(['url' => '/sendMessageReplay', 'method' => 'POST'])}}
                <div class="form-group">
                    <div class="input-group">
                        {{Form::text('body', '', ['class' => 'form-control', 'placeholder' => __('Nova Poruka')])}}
                        <span class="input-group-btn">
                            {{Form::submit('Posalji', ['class' => 'btn btn-primary'])}}
                        </span>
                    </div>
                </div>
                {{Form::hidden('user_id', $user_id)}}
                {{Form::close()}}
            </div>
        </div>
        <div class="row" id="messages">
            <ul class="sort-list col-md-12">
                @foreach($messages as $message)
                    <li class="sort-item message" data-event-date="{{$message->created_at->timestamp}}">
                        <div class="user-message">
                            <span>{{$message->body}}</span>
                            <time class="pull-right"
                                  data-toggle="tooltip"
                                  data-placement="bottom"
                                  title="{{$message->created_at->addHours(2)->format('d-m-Y H:i:s')}}">
                                {{$message->created_at->diffForHumans()}}
                            </time>
                        </div>
                    </li>
                @endforeach

                @foreach($messageReplays as $message)
                    <li class="sort-item message admin" data-event-date="{{$message->created_at->timestamp}}">
                        <div class="admin-message">
                            <span>{{$message->body}}</span>
                            <time class="pull-right"
                                  data-toggle="tooltip"
                                  data-placement="bottom"
                                  title="{{$message->created_at->addHours(2)->format('d-m-Y H:i:s')}}">
                                {{$message->created_at->diffForHumans()}}
                            </time>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
@endsection
@section('customScripts')
    <script>
        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
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
        });
    </script>
@endsection