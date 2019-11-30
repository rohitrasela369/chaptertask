@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Order/Invoice No') }} {{  !empty($order->invoice_number) ? $order->invoice_number : 'NA'  }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                Order Date:
                            </th>
                            <td>
                                {{ $order->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Customer Name:
                            </th>
                            <td>
                                {{ $order->customer->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Total Amount:
                            </th>
                            <td>
                                {{ $order->total_amount}}
                            </td>
                        </tr>
                    </table>

                    <h3>Item Details</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Price</th>
                            </tr>
                            @forelse ($order->order_items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->product->price }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2">No Item Available</td>
                            </tr>
                            @endforelse
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
