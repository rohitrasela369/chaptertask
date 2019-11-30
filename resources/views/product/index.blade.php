@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

                <div class="card-body">
                    <table class="table table-bordered" id="productTableId">
                        <thead>
                            <th>Name</th>
                            <th>Price</th>
                            <th>In Stock</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#productTableId').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('product.get') }}',
                type: "POST"
            },
            columns: [
                { data: 'name'},
                { data: 'price', searchable: false},
                { data: 'in_stock', searchable: false }
            ]
        });
    });
</script>

@endsection
