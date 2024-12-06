@extends('layouts.app')
@section('content')
    <div class="main">
        <!-- College-Banner -->
        <section class="college">
            <div class="container-fluid">
                <div class="college-inner">
                    <figure>
                        <img src="{{asset('web/assets/images/blog-bg.png')}}">
                    </figure>
                    <div class="college-content">
                        <h1>Your Journey Begins Here</h1>
                        <p>Come See the world with Us</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Featured -->
        <section class="featured">
            <div class="container">
                <div class="featured-inner">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="featured-left">
                                <h3>Featured Post</h3>
                                <div class="featured-left-content">
                                    <h2>48 Hours in Chennai</h2>
                                    <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.....</p>
                                    <a class="travel-btn" href="blog-single.php">Read More ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="featured-right">
                                <figure>
                                    <img src="{{asset('web/assets/images/blog.png')}}">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Posts -->
        <section class="posts">
            <div class="container">
                <div class="posts-inner">
                    <div class="posts-head">
                        <h2>All Posts</h2>
                    </div>
                    <div class="posts-bottom">
                        <div class="tours-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tours-left">
                                        <figure>
                                            <img src="{{asset('web/assets/images/post-one.png')}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tours-right">
                                        <h2>Top 10 Singapore Attractions Not To Miss</h2>
                                        <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book......</p>
                                        <a class="travel-btn" href="blog-single.php">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tours-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tours-left">
                                        <figure>
                                            <img src="{{asset('web/assets/images/post-two.png')}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tours-right">
                                        <h2>Goa Beyond the Beaches: 7 Great Things to Experience</h2>
                                        <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book......</p>
                                        <a class="travel-btn" href="blog-single.php">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tours-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tours-left">
                                        <figure>
                                            <img src="{{asset('web/assets/images/post-three.png')}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tours-right">
                                        <h2>7 Smashing Weekend Getaways From New Delhi</h2>
                                        <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book......</p>
                                        <a class="travel-btn" href="blog-single.php">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tours-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tours-left">
                                        <figure>
                                            <img src="{{asset('web/assets/images/post-four.png')}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tours-right">
                                        <h2>Goa Beyond the Beaches</h2>
                                        <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book......</p>
                                        <a class="travel-btn" href="blog-single.php">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tours-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tours-left">
                                        <figure>
                                            <img src="{{asset('web/assets/images/post-five.png')}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tours-right">
                                        <h2>The Ultimate Guide to National Parks in India</h2>
                                        <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book......</p>
                                        <a class="travel-btn" href="blog-single.php">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tours-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tours-left">
                                        <figure>
                                            <img src="{{asset('web/assets/images/post-six.png')}}">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tours-right">
                                        <h2>7 Temples in Khajuraho You Need to Visit</h2>
                                        <h4>By <span>John Doe</span> l May 23, 2024 </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book......</p>
                                        <a class="travel-btn" href="blog-single.php">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
    
  
