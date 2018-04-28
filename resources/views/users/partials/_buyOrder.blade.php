<h4>{{__('Kupovina kriptovalute')}}</h4>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{__('Odabrana kriptovaluta')}}</label>
            {{Form::text('', \App\Models\Currency::getName($order->currency_id), ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label>{{__('Adresa Vašeg novčanika na koji se vrši uplata')}}</label>
            {{Form::text('', $order->wallet, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label>{{__('U iznosu od')}}</label>
            <div class="input-group">
                {{Form::text('', $order->amount, ['class' => 'form-control', 'readonly' => 'readonly'])}}
                <div class="input-group-addon">RSD</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{__('Račun na koji uplaćujete iznos u dinarskoj protivvrednosti')}}</label>
            {{Form::text('', $order->bank_account, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
    </div>
</div>
