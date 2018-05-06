@extends('layouts.dashboard')

@section('main')
    <h1>{{__('Poruka od ') . $message->name}}</h1>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">{{__('E-mail')}}</label>
                {{Form::email('', $message->email, ['class' => 'form-control', 'readonly' => 'readonly'])}}
            </div>
            <div class="form-group">
                <label for="">{{__('Poruka')}}</label>
                {{Form::textarea('', $message->message, ['class' => 'form-control', 'readonly' => 'readonly'])}}
            </div>
        </div>
    </div>
@endsection