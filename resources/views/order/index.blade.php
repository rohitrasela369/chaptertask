@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>

                <div class="card-body">
                    <table class="table table-bordered" id="orderTableId">
                        <thead>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        var table = $('#orderTableId').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('order.get') }}',
                type: "POST"
            },
            columns: [
                { data: 'customer.name'},
                { data: 'total_amount', searchable: false},
                { data: 'status', searchable: false },
                { data: 'id' , searchable: false, render : function ( data, type, row, meta ) {
                        return '<a target="_blank" class="btn btn-primary btn-sm" href="{{ route('order.show') }}/'+ data +'" >View</a>';
                    }
                }
            ]
        });
    });
</script>

@endsection
