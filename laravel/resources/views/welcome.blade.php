@extends('base.main')

@section('content')

<div class="row my-4">

    @foreach ($model as $a)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="{{ route('product.show', $a->id) }}"><img class="card-img-top" src="{{ $a->image }}" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('product.show', $a->id) }}">{{ $a->name }}</a>
                    </h4>
                    <h5>{{ $a->priceLocale }}</h5>
                </div>
            </div>
        </div>
    @endforeach

</div>
<div class="text-center my-4">
    {!! $model->links() !!}
</div>

@endsection