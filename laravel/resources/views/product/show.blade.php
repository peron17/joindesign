@extends('base.main')
@section('content')
<div class="card mt-4 mb-5">
    <img class="card-img-top img-fluid" alt="" style="min-height: 360px; background-size: cover; background-image: url({{ $model->image }}); background-position: center;">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-lg-8">
                <h3 class="card-title">{{ $model->name }}</h3>
                <h4>{{ $model->priceLocale }}</h4>
            </div>
            <div class="col-lg-3">
                <form action="{{ route('cart.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="form-group">
                        <input type="number" min="1" name="qty" id="qty" class="form-control">
                        @error('qty') <small>{{ $message }}</small> @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    small { color: red; }
</style>
@endpush

@push('script')
<script>
$(document).ready(function(){
    $('#qty').val(1);

    $('#qty').keyup(function(){
        $(this).val(
            $(this).val() < 1 ? 1 : $(this).val()
        );
    });
});
</script>
@endpush