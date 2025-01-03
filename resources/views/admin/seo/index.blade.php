@php
    $title = 'My Vacay Host';
    $filename = 'Seo Management';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Seo Management</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Seo Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section>
            <div class="card">
                <div class="card-header">
                    <span>Seo Management</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th>Home</th>
                                <th><a href="{{ route('seo-management.edit',Crypt::encrypt(1)) }}"><i class="bi bi-pen-fill"></i></a></th>
                            </tr>
                            <tr>
                                <th>About</th>
                                <th><a href="{{ route('seo-management.edit',Crypt::encrypt(2)) }}"><i class="bi bi-pen-fill"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th>Packages</th>
                                <th><a href="{{ route('seo-management.edit',Crypt::encrypt(3)) }}"><i class="bi bi-pen-fill"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
