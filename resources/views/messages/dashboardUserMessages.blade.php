@extends('layouts.dashboard')

@section('customStyles')
    <style>
        .message {
            padding: 10px 15px;
            background-color: var(--main);
            color: white;
            margin-bottom: 5px;
        }

        .admin {
            background-color: var(--orange);
            color: white;
        }

        .sort-list {
            list-style: none;
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
                        <div class="input-group-addon">
                            {{Form::submit('Posalji', ['class' => 'btn btn-block'])}}
                        </div>
                    </div>
                </div>
                {{Form::hidden('user_id', $user_id)}}
                {{Form::close()}}
            </div>
        </div>
        <div class="row">
            <ul class="sort-list col-md-12"></ul>
        </div>
@endsection
@section('customScripts')
    <script>
        $(document).ready(function () {

            var messages = JSON.parse('{!! $messages !!}');
            var messageReplays = JSON.parse('{!! $messageReplays !!}');
            createHtml(messages, messageReplays);
            // setInterval(getNewMessages, 10000);
        });
        
        function createHtml(messages, messageReplays) {

            Object.keys(messages).map(function (key) {
                $("ul.sort-list").append(
                    '<li class="sort-item message" data-event-date="' + getTimestampFromDateTimeString(messages[key].created_at) + '">' +
                    '<span>' + messages[key].body + '</span>' +
                    '<time class="pull-right">' + messages[key].created_at + '</time>' +
                    '</li>'
                );
            });

            Object.keys(messageReplays).map(function (key) {
                $("ul.sort-list").append(
                    '<li class="sort-item message admin" data-event-date="' + getTimestampFromDateTimeString(messageReplays[key].created_at) + '">' +
                    '<span>' + messageReplays[key].body + '</span>' +
                    '<time class="pull-right">' + messageReplays[key].created_at + '</time>' +
                    '</li>'
                );
            });

            sortMessages();
        }

        function getNewMessages() {
            ajaxCallToDb();

            // console.log(messages);
        }
        
        function ajaxCallToDb() {
            var data = {
                user_id: '{{$user_id}}'
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                '/getNewMessagesFromUser',
                data,
                function (response) {
                    if (response.message === 'success') {
                        if (response.data.length > 0) {
                            insertNewMessages(response.data);
                        }
                    }
                }
            );
        }
        function insertNewMessages(messages) {
            console.log(messages);
        }
        function sortMessages() {
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
        }
        function getTimestampFromDateTimeString(date) {
            var dateTime = +new Date(date);
            return Math.floor(dateTime / 1000);
        }
    </script>
@endsection