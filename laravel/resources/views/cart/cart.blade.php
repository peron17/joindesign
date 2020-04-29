@extends('base.main')
@section('content')
<h3>Cart</h3>

@if ($model->isEmpty())
    <div class="alert alert-info">
        <h5 class="m-0">Cart is empty</h5>
    </div>
@else
    <div class="card mt-4 mb-5">
        <div class="card-header">
            <div class="col-lg-4"><a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i> Continue shopping</a></div>
        </div>

        <div class="card-body">
            <form action="{{ route('cart.update') }}" method="post">
                @csrf
                @foreach ($model as $item)
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-2">
                            <img src="{{ $item->product->image }}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-sm-5">
                            <h5>{{ $item->product->name }}</h5>
                            <p class="text-muted">{{ $item->product->priceLocale }}</p>
                        </div>
                        <div class="col-sm-2">
                            <h5 class="text-right mb-1">{{ $item->priceLocale }}</h5>
                        </div>
                        <div class="col-sm-3">
                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="number" name="qty[]" value="{{ $item->qty }}" min="1" class="form-control qty">
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-danger confirm"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach

                <div class="d-block text-right mb-4">
                    <span class="text-muted mr-2">Update quantity?</span> <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>

        </div>
        <div class="card-footer text-right">
            <div class="row text-center align-middle">
                <div class="col-sm-10">
                    <h4 class="text-right">Total <strong>{{ $total }}</strong></h4>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('checkout') }}" class="btn btn-success btn-block confirm">Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@push('script')
<script>
$(document).ready(function(){
    $('.qty').keyup(function(){
        $(this).val(
            $(this).val() < 1 ? 1 : $(this).val()
        );
    });
});

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