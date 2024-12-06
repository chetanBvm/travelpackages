@php
    $title = 'My Vacay Host';
    $filename = 'Airport';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')
    <div class="page-heading">
        <div class="page-title">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Airport</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Airport</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section>
            <div class="card">
                <div class="card-header">
                    <span>Airport</span>
                    <a href="{{ route('airport.create') }}" type="button"
                            class="btn btn-info d-none d-lg-block m-l-15">&#x002B; Add New</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>code</th>
                                <th>Name</th>
                                <th>city</th>
                                <th>country_name</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('airport.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data:'code',
                        name: 'code',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data:'city',
                        name:'city'
                    },
                    {
                        data:'country_name',
                        name:'country_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
        //Delete the airport
        function deleteFunc(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ajax
                    $.ajax({
                        method: "DELETE",
                        url: "{{ route('airport.destroy', ':id') }}".replace(':id', id),
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            Swal.fire(
                                'Deleted!',
                                'Airport delete successfully!',
                                'success'
                            )
                            var oTable = $('.data-table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            })
        }
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/simple-datatables/style.css') }}">
@endsection
@section('js')
    <script src="{{ asset('admin/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
@endsection
