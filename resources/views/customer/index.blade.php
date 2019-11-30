@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Customer') }}</div>

                <div class="card-body">
                    <table class="table table-bordered" id="customerTableId">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        // alert("lll");
        $('#customerTableId').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('customer.get') }}',
                type: "POST"
            },
            columns: [
                { data: 'name'},
                { data: 'email'},
                { data: 'created_at', searchable: false }
            ]
        });
    });
</script>

@endsection
