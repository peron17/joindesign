@extends('base.main')
@section('content')
<h3>Checkout</h3>

<div class="row mb-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                @foreach ($model->orderItem as $item)
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-3">
                        <img src="{{ $item->product->image }}" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-sm-5">
                        <h5>{{ $item->product->name }}</h5>
                        <span class="small text-muted">
                            {{ $item->priceLocale.' x '.$item->qty }}
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <h5>{{ $item->priceTotalLocale }}</h5>
                        @if ($item->disc > 0)
                        <span class="small text-muted">
                            Disc. {{ $item->disc }}
                        </span>
                        @endif
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('redeem', $model->id) }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="code" id="code" class="form-control" placeholder="Voucher Code" value="{{ $model->voucher_code }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-block {{ $model->voucher_code ? 'btn-danger' : 'btn-secondary' }}">{{ $model->voucher_code ? 'Remove Voucher' : 'Redeem Voucher' }}</button>
                        </div>
                    </div>
                    @error('code') <span class="small" style="color: red;">{{ $message }}</span> @enderror
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <dt>Subtotal</dt>
                <dd class="h4">{{ $model->totalPriceLocale }}</dd>
                @if ($model->voucher_code != '')
                    <dt>Voucher Disc.</dt>
                    <dd class="h4">-{{ $model->discLocale }}</dd>
                @endif
                <hr>
                <dt>Total</dt>
                <dd class="h4">{{ $model->totalPaymentLocale }}</dd>
                <hr>
                <a href="{{ route('order.payment', $model->id) }}" class="btn btn-block btn-success confirm">Pay</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('.confirm').click(function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        });
    });
</script>
@endpush