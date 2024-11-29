<footer>
	<div class="container">
		<div class="footer-inner">
			<div class="row">
				<div class="col-md-3">
					<div class="footer-content">
						<a href="{{route('dashboard')}}" class="footer-logo"><img src="{{asset('web/assets/images/footer-logo1.png')}}"></a>
						<div class="footer-wapper">
							<p><span>Experienced:</span> Our friendly Consultants travel regularly & offer first hand advice.</p>
							<p><span>Easy:</span> We coordinate your travel so flights, transfers & tours all connect smoothly.</p>
							<p><span>Trusted:</span> Hundreds of customers travel with us every week.</p>
						</div>
						<ul class="social-icon">
							<li><a href="javascript::"><i class="fa-brands fa-instagram"></i></a></li>
							<li><a href="javascript::"><i class="fa-brands fa-facebook"></i></a></li>
							<li><a href="javascript::"><i class="fa-brands fa-twitter"></i></a></li>
							<li><a href="javascript::"><i class="fa-brands fa-linkedin"></i></a></li>
							<li><a href="javascript::"><i class="fa-brands fa-youtube"></i></a></li>
						</ul>
					</div>

				</div>
				<div class="col-md-3">
					<div class="footer-content">
						<h2>Important links</h2>
						<ul class="footer-menu">
							<li><a class="active" href="javascript::">Home</a></li>
							<li><a href="{{route('pages.about')}}">About Us</a></li>
							<li><a href="javascript::">Contact Us</a></li>
							<li><a href="blog.php">Blogs</a></li>
							<li><a href="privacy-policy.php">Privacy Policy</a></li>
							<li><a href="terms-condition.php">Terms and Condition</a></li>
						</ul>
					</div>

				</div>
				<div class="col-md-3">
					<div class="footer-content">
						<h2>Packages</h2>
						<ul class="footer-menu">
							<li><a href="javascript::">Tour Packages</a></li>
							<li><a href="javascript::">Ocean Cruise Packages</a></li>
							<li><a href="javascript::">River Cruise Packages</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-content">
						<h2>Contact Us</h2>
						<ul class="footer-contact">
							<li><span><i class="fa-solid fa-location-dot"></i></span> India</li>
							<li><span><i class="fa-solid fa-phone-volume"></i></span> 1800 2404 202 </li>
							<li><span><i class="fa-regular fa-envelope"></i></span> info@travelagency.com</li>
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

<script src="{{asset('web/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/assets/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('web/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('web/assets/js/select2.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
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