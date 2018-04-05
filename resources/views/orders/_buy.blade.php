<h3>{{__('Kupovina Kriptovalute')}}</h3>

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
            <label for="">{{__('Vrednost')}}</label>
            <div class="input-group">
                {{Form::text('', $order->amount, ['class' => 'form-control', 'readonly' => 'readonly'])}}
                <span class="input-group-addon" id="basic-addon1">RSD</span>
            </div>
        </div>
        <div class="form-group">
            <label for="">{{__('Wallet')}}</label>
            {{Form::text('', $order->wallet, ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="form-group">
            <label for="">{{__('Datum i Vreme Narudzbine')}}</label>
            {{Form::text('', $order->created_at->format('d-m-Y H:i:s'), ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
    </div>
    <div class="col-md-6" id="status-column">
        <h4>{{__('QRCode za wallet')}}</h4>
        <div id="qrcode"></div>

        <div class="form-group">
            <label for="">{{__('Status Narudzbine')}}</label>
            {{Form::text('', 'Ceka se na odobrenje', ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-danger">{{__('Odbij')}}</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-success">{{__('Odobri')}}</button>
            </div>
        </div>
    </div>
</div>
