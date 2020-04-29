@extends('base.main')
@section('content')
<h3>Order</h3>

<div class="card mb-5">
    <div class="card-body">
        @if ($model->isEmpty())
            <div class="alert alert-info">Ordere not found</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Transaction Date</th>
                    <th>Total Payment</th>
                </tr>
                @foreach ($model as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->tranDate }}</td>
                        <td>{{ $item->totalPaymentLocale }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        @endif
    </div>
</div>
@endsection