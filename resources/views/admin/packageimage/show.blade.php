@php
    $title = 'My Vacay Host';
    $filename = 'Package Image View';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')
    <section class="view-section">
        <div class="container">
            <div class="view-inner-data">
                <div class="view-heading">
                    <h3>Package Image </h3>
                </div>
                <div>
                    <a href="{{route('package-image.index')}}">Back</a>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">Package Name</h4>                             
                            </div>
                            <div class="view-body">
                                <p>{{$packageImage->package->name}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="view-inner mt-3">
                            <div class="view-header">
                                <h4 class="view-title">Image</h4>
                            </div>
                            <div class="view-body">
                                    <img src="{{asset('storage/'.$packageImage->images)}}" style="width:100px; height:100px;">
                            </div>
                        </div>
                    </div>
            
                    
                </div>
            </div>
        </div>
    </section>
@endsection
