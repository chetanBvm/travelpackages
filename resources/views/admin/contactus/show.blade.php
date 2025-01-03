@php
    $title = 'My Vacay Host';
    $filename = 'Contact Us View';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')
    <section class="view-section">
        <div class="container">
            <div class="view-inner-data">
                <div class="view-heading">
                    <h3>Contact Us </h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">First Name</h4>
                            </div>
                            <div class="view-body">
                                <p>{{$contactus->f_name}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">Last Name</h4>
                            </div>
                            <div class="view-body">
                                <p>{{$contactus->l_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">Email Address</h4>
                            </div>
                            <div class="view-body">
                                <p>{{$contactus->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">Phone Number</h4>
                            </div>
                            <div class="view-body">
                                <p>{{$contactus->mobile_number}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">Message</h4>
                            </div>
                            <div class="view-body">
                                {{$contactus->message}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
