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
            {{Form::text('', $order->status->getCodeLabel(), ['class' => 'form-control', 'readonly' => 'readonly'])}}
        </div>
        @if($order->status->status_code == \App\Models\OrderStatus::ACTIVE)
        <div class="row">
            <div class="col-md-6">
                {{Form::open(['url' => '/order/setStatus', 'method' => 'POST'])}}
                {{Form::hidden('order_id', $order->id)}}
                {{Form::hidden('status_code', \App\Models\OrderStatus::DENIED)}}
                {{Form::submit(__('Odbij'), ['class' => 'btn btn-danger'])}}
                {{Form::close()}}
            </div>
            <div class="col-md-6">
                {{Form::open(['url' => '/order/setStatus', 'method' => 'POST'])}}
                {{Form::hidden('order_id', $order->id)}}
                {{Form::hidden('status_code', \App\Models\OrderStatus::EXECUTED)}}
                {{Form::submit(__('Realizovan'), ['class' => 'btn btn-success'])}}
                {{Form::close()}}
            </div>
        </div>
        @endif
    </div>
</div>
