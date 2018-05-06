@extends('layouts.master')

@section('customStyles')
    <style>
        #yellow {
            background-color: #f2c902;
            display: grid;
            grid-template-columns: auto;
        }
        #yellow div {
            text-align: justify;
        }
        #yellow div h2 {
            font-size: 50px;
            margin-bottom: 15px;
        }
        #yellow div p {
            font-size: 18px;
            line-height: 24px;
        }
        #dark {
            background-color: #1d1e20;
            color: #f2c902;
        }
        @media only screen and (max-width: 1450px) and (min-width: 1050px) {
            #yellow div p {
                font-size: 14px;
                line-height: 18px;
            }
        }
    </style>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            <section id="yellow" class="col-md-6">
                <div class="sectionContainer">
                    <h2>{{_('O nama')}}</h2>

                    <p>Cilj KvartEX PLATFORME je okupljanje ljubitelja kriptovalute na jedno mesto.</p>
                    <p>Izgradnja ove platfome ići će u pravcu uključivanja svih zainteresovanih za ovu ideju.
                        Glavni akcenat biće na izgradnji komunikacionih kanala između korisnika i live razmene kripto valuta.</p>
                    <p>Izuzetno kompleksan plan koji  je napravljen zahtevaće više timova za rad u pozadini same platfome što će omogućiti velikom broju ljudi mogućnost zarade od kuće.
                        Svi učesnici u izgradnji platforme biće nagrađeni za svoj rad u skladu sa svojim učešćem kao i javnom objavom na ovoj stranici.</p>
                    <p>Napravite nalog i pratite nas na facebook grupi.
                        Javni poziv za učešće u izgradnji, važi za sve one koji su
                        dovoljno istrajni da ovu ideju sprovedemo do kraja i postanemo jedna od najačih platformi kao i jedina društvena platforma ovoga tipa.</p>
                    <p>Dalji radovi i planirani koraci biće blagovremeno puštani u javnost.</p>
                </div>
            </section>
            <section id="dark" class="col-md-6">
                <div class="sectionContainer">
                    <h2>{{__('Naš Tim')}}</h2>
                    <p>{{__('Uskoro par reči i o nama...')}}</p>
                </div>
            </section>
        </div>
    </div>
@endsection