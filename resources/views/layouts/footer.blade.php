<footer>
    <div class="container">
        <div class="footer-inner">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-content">
                        <a href="{{ route('dashboard') }}" class="footer-logo">
                            @php
                                $images = json_decode($settings, true);
                            @endphp
                            @if (isset($images))
                                <img src="{{ asset('storage' . '/' . $images['footer']) }}">
                            @else
                                <img src="{{ asset('web/assets/images/footer-logo.png') }}">
                            @endif
                        </a>
                        <div class="footer-wapper">
                            <p><span>Experienced:</span> Our friendly Consultants travel regularly & offer first hand
                                advice.</p>
                            <p><span>Easy:</span> We coordinate your travel so flights, transfers & tours all connect
                                smoothly.</p>
                            <p><span>Trusted:</span> Hundreds of customers travel with us every week.</p>
                        </div>
                        <ul class="social-icon">
                            @php
                                $socialLinks = json_decode($data['social_link']->social_link, true);
                            @endphp
                            @php
                                // Predefined mapping of platforms to font-awesome icon classes
                                $platformIcons = [
                                    'facebook' => 'facebook',
                                    'youtube' => 'youtube',
                                    'twitter' => 'twitter',
                                    'instagram' => 'instagram',
                                    'linkedin' => 'linkedin',
                                ];
                            @endphp
                            @foreach ($socialLinks as $social)
                                @php
                                    // Extract the platform name from the URL
                                    $url = parse_url($social['url']);
                                    $host = $url['host'] ?? ''; // Get the host (e.g., facebook.com)
                                    $platform = explode('.', $host)[0]; // Extract the platform name (e.g., facebook)

                                    // Get the corresponding icon class
                                    $icon = $platformIcons[strtolower($platform)] ?? 'link'; // Default to 'link' if platform not found
                                @endphp
                                <li><a href="{{ $social['url'] }}">
                                        <i class="fa-brands fa-{{ $icon }}"></i>
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-content">
                        <h2>Important links</h2>
                        <ul class="footer-menu">
                            <li><a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">Home</a></li>
                            <li><a class="{{ request()->routeIs('pages.about') ? 'active' : '' }}"
                                    href="{{ route('pages.about') }}">About Us</a></li>
                            <li><a class="{{ request()->routeIs('pages.contactus') ? 'active' : '' }}"
                                    href="{{ route('pages.contactus') }}">Contact Us</a></li>
                            <li><a class="{{ request()->routeIs('pages.blog') ? 'active' : '' }}"
                                    href="{{ route('pages.blog') }}">Blogs</a></li>
                            <li><a class="{{ request()->routeIs('pages.policy') ? 'active' : '' }}"
                                    href="{{ route('pages.policy') }}">Privacy Policy</a></li>
                            <li><a class="{{ request()->routeIs('pages.terms') ? 'active' : '' }}"
                                    href="{{ route('pages.terms') }}">Terms and Condition</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-content">
                        <h2>Packages</h2>
                        <ul class="footer-menu">
                            @foreach ($data['packageType'] as $package)
                                <li><a href="{{ route('packages.city', $package->id) }}">{{ $package->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-content">
                        <h2>Contact Us</h2>
                        <ul class="footer-contact">
                            <li><span><i class="fa-solid fa-location-dot"></i></span>
                                {{ isset($settingContact->address) ? $settingContact->address : '' }}</li>
                            <li><span><i class="fa-solid fa-phone-volume"></i></span>
                                {{ isset($settingContact->mobile_number) ? $settingContact->mobile_number : '' }}
                            </li>
                            <li><span><i class="fa-regular fa-envelope"></i></span>
                                @if (isset($settingContact->email) && $settingContact->email)
                                    <a href="mailto:{{ $settingContact->email }}">{{ $settingContact->email }}</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="conainer-fluid">
        <div class="rights">
            <div class="dashline"></div>
            <p>Develop by BVM Web Solution. © 2024. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="{{ asset('web/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/assets/js/jquery-3.2.1.slim.min.js') }}"></script>
<script src="{{ asset('web/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('web/assets/js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('web/assets/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="{{ asset('web/assets/js/tourdetails.js') }}"></script>
<script src="{{ asset('web/assets/js/airport_filter.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js"></script>
<script type="text/javascript">
    $(".guests-slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        },
    });

    // Initialize Select2
    $(document).ready(function() {
        $('.form-select').select2();
    });
</script>

<script type="text/javascript">
    jQuery('.home-slider-images').slick({
        infinite: true,
        slidesToShow: 1, // Shows a three slides at a time
        slidesToScroll: 1, // When you click an arrow, it scrolls 1 slide at a time
        arrows: false, // Adds arrows to sides of slider
        dots: false,
        autoplaySpeed: 4000, // Adds the dots on the bottom
        autoplay: true
    });

    $(".pop-images").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        stagePadding: 50,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 1,
            },
        },
    });

    //contact slider
    $('.contact-slider').owlCarousel({
        loop: true,
        margin: 0,
        center: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            450: {
                items: 2
            },
            550: {
                items: 3
            },
            1000: {
                items: 4.75
            }
        }
    })

    //gallery slider
    $('.gallery-one-slider').owlCarousel({
        loop: true,
        margin: 24,
        center: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4.75
            }
        }
    });

    $('.gallery-two-slider').owlCarousel({
        loop: true,
        margin: 24,
        center: true,
        nav: false,
        dots: false,
        rtl: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4.75
            }
        }
    });

    // Search toggle
    jQuery(function($) {
        $(".search-toggle").click(function(e) {
            e.preventDefault(),
                $(".search-box").toggleClass("active").find(".search-field").focus();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('ul > li > a').click(function(e) {
            const subMenu = $(this).next('ul');
            if (subMenu.length) {
                e.preventDefault();
                subMenu.slideToggle();
            }
        });
    });

    setTimeout(function() {
        $('.alert-success').fadeOut('fast');
    }, 3000);
</script>
