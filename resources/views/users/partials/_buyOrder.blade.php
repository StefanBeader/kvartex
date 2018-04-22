<h4>{{__('Prodaja kriptovalute')}}</h4>

<div class="row">
    <div class="col-md-6">
        <div>
            <span class="label">{{__('Odabrana kriptovaluta: ')}}</span>
            <span class="data">{{\App\Models\Currency::getName($order->currency_id)}}</span>
        </div>

        <div>
            <span class="label">{{__('Iznos koji uplacujete: ')}}</span>
            <span class="data">{{$order->amount}}</span>
        </div>

    </div>
    <div class="col-md-6">
        <div>
            <p class="label">{{__('Adresa novcanika na koji vrsite uplatu: ')}}</p>
            <span class="data">{{$order->wallet}}</span>
        </div>
    </div>
</div>