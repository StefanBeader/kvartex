<h4>{{__('Prodaja kriptovalute')}}</h4>
@php
    $bank_account1 = substr($order->bank_account, 0, -15);
    $bank_account2 = substr($order->bank_account, 0, -2);
    $bank_account2 = substr($bank_account2, 3);
    $bank_account3 = substr($order->bank_account, 0, -16);
@endphp
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
            {{Form::text('',
            $bank_account1 . '-' . $bank_account2 . '-' . $bank_account3,
            ['class' => 'form-control', 'readonly' => 'readonly'])}}
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
