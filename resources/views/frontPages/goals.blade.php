@extends('layouts.master')

@section('customStyles')
    <style>
    </style>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            <section id="yellow" class="col-md-6">
                <div class="sectionContainer">
                    <h2>{{_('Naši sledeći koraci')}}</h2>
                    <ul>
                        <li>{{__('Real time chat')}}</li>
                        <li>{{__('Cilj 2')}}</li>
                        <li>{{__('Cilj 3')}}</li>
                        <li>{{__('Cilj 4')}}</li>
                        <li>{{__('Cilj 5')}}</li>
                    </ul>
                </div>
            </section>
            <section id="dark" class="col-md-6">
                <div class="sectionContainer">
                    <h2>{{__('Buduća Platforma')}}</h2>
                    <a href="" class="btn btn-yellow">{{__('Kliknite ovde')}}</a>
                </div>
            </section>
        </div>
    </div>
@endsection