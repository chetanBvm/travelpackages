@extends('layouts.app')
@section('content')
    <div class="main">
        <!-- College-Banner -->
        <section class="college">
            <div class="container-fluid">
                <div class="college-inner">
                    <figure>
                        <img src="{{asset('web/assets/images/contact-bg.png')}}">
                    </figure>
                    <div class="college-content">
                        <h1>Contact Us</h1>
                        <p>Come See the world with Us</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact -->
        <section class="contact">
            <div class="container">
                <div class="contact-inner">
                    <form class="contact-form">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>First Name </label>
                                    <input type="text" name="Name" class="form-control"
                                        placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>Last Name</label>
                                    <input type="text" name="Name" class="form-control" placeholder="Enter Last Name">
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>Email Address</label>
                                    <input type="email" name="Email" class="form-control"
                                        placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>Phone Number</label>
                                    <div class="mobile-number-inner">
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="1" selected>+91</option>
                                            <option value="2">+55</option>
                                            <option value="3">+81</option>
                                            <option value="4">+82</option>
                                        </select>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Enter 10 digit phone number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contact-content">
                                    <label>Message</label>
                                    <textarea placeholder="Message" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <a class="travel-btn" href="javascript::">Submit</a>
                    </form>
                </div>
            </div>
        </section>
        <!-- Contact-slider -->
        <section class="con-slider">
            <div class="container-fluid">
                <div class="con-inner">
                    <div class="owl-carousel owl-theme contact-slider">
                        <div class="item">
                            <figure>
                                <img src="{{asset('web/assets/images/contact-one.png')}}">
                            </figure>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="{{asset('web/assets/images/contact-two.png')}}">
                            </figure>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="{{asset('web/assets/images/contact-three.png')}}">
                            </figure>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="{{asset('web/assets/images/contact-four.png')}}">
                            </figure>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="{{asset('web/assets/images/contact-five.png')}}">
                            </figure>
                        </div>
                        <div class="item">
                            <figure>
                                <img src="{{asset('web/assets/images/contact-six.png')}}">
                            </figure>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
