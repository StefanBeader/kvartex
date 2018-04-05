<h3>{{__('Prodaja Kriptovalute')}}</h3>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">{{__('Broj Porudzbine')}}</label>
            {{Form::text('', $order->id, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Korisnik')}}</label>
            {{Form::text('',
            $order->user->name,
            ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Valuta')}}</label>
            {{Form::text('', $order->currency->display_name, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Kolicina')}}</label>
            {{Form::text('', $order->amount, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Bankovni Racun')}}</label>
            {{Form::text('', $order->bank_account, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Datum i Vreme Narudzbine')}}</label>
            {{Form::text('', $order->created_at->format('d-m-Y H:i:s'), ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
    </div>
</div>
