<h4>{{__('Prodaja kriptovalute')}}</h4>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{__('Odabrana kriptovaluta')}}</label>
            {{Form::text('', \App\Models\Currency::getName($order->currency_id), ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label>{{__('Iznos koji uplaćujete u izabranoj kriptovaluti')}}</label>
            {{Form::text('', $order->amount, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label>{{__('Vaš račun na koji će biti uplaćena dinarska protivvrednost')}}</label>
            {{Form::text('', $order->bank_account, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>

    </div>
    <div class="col-md-6">
        <div class="qrcode{{$order->id}}"></div>
        <div class="form-group">
            <label>{{__('Adresa novčanika na koji vršite uplatu')}}</label>
            {{Form::text('', $order->wallet, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
    </div>
</div>
