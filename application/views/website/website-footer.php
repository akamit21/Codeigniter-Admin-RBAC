<!-- website-footer.php -->
		<footer class="website-footer">
			<div class="top-footer">
				<div class="container">
					<div id="flip">
						<p class="my-2 text-white">Show Site Index<i class="fa fa-angle-down ml-2"></i></p>
					</div>
				</div>
				<div id="panel">
					<div class="container">
						<div class="row">
							<div class="col-lg-4">
								<h6>About</h6>
									<ul class="list-unstyled">
										<li><a href="#">Our History</a></li>
										<li><a href="#">Discription</a></li>
										<li><a href="#">Attraction</a></li>
									</ul>
								<h6>Visitor Services</h6>
									<ul class="list-unstyled">
										<li><a href="#">Map & Brochures</a></li>
										<li><a href="#">Guided Tours</a></li>
									</ul>
								<h6>Events</h6>
									<ul class="list-unstyled">
									<li><a href="#">Celebration</a></li>
									<li><a href="#">Performances</a></li>
									<li><a href="#">Exhibitions</a></li>
									<li><a href="#">Talks</a></li>
								</ul>
							</div>
							<div class="col-lg-4">
								<h6>Attraction</h6>
									<ul class="list-unstyled">
									<li><a href="#">Amaltas</a></li>
									<li><a href="#">Amla</a></li>
									<li><a href="#">Ashok</a></li>
									<li><a href="#">Bamboo</a></li>
									<li><a href="#">Deodar</a></li>
									<li><a href="#">Gugal</a></li>
									<li><a href="#">Jamun</a></li>
									<li><a href="#">Kachnar</a></li>
									<li><a href="#">Mahua</a></li>
									<li><a href="#">Neem</a></li>
									<li><a href="#">Pipal</a></li>
									<li><a href="#">Rudraksha</a></li>
									<li><a href="#">Shami</a></li>
									<li><a href="#">Shisham</a></li>
								</ul>
							</div>
							<div class="col-lg-4">
								<h6>Plant Information</h6>
								<ul class="list-unstyled">
									<li><a href="#">Amaltas</a></li>
									<li><a href="#">Amla</a></li>
									<li><a href="#">Ashok</a></li>
									<li><a href="#">Bamboo</a></li>
									<li><a href="#">Deodar</a></li>
									<li><a href="#">Gugal</a></li>
									<li><a href="#">Jamun</a></li>
									<li><a href="#">Kachnar</a></li>
									<li><a href="#">Mahua</a></li>
									<li><a href="#">Neem</a></li>
									<li><a href="#">Pipal</a></li>
									<li><a href="#">Rudraksha</a></li>
									<li><a href="#">Shami</a></li>
									<li><a href="#">Shisham</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
	
			<div class="icon-footer">
				<div class="container">
					<div class="footer-icon text-center">
						<img src="<?= base_url(); ?>assets/img/icons/footer-main-icon.png" class="img-fluid" alt="footer-icon">
					</div>
					<ul class="list-unstyled text-center mb-0 py-3">
						<li><a href="#">The Gardens</a></li>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Terms Of Use</a></li>
						<li><a href="#">Privacy Policy</a></li>
					</ul>
				</div>
			</div>
		</footer>
		
		<div id="scroll-to-top" class="fade"><i class="fa fa-angle-up"></i></div>

		<script type='text/javascript' src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
		<script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/holder/1.9.0/holder.js"></script>
		<script src="<?= base_url(); ?>assets/js/plugins.js"></script>
		<script src="<?= base_url(); ?>assets/js/slick.js"></script>
		<script src="<?= base_url(); ?>assets/js/modernizr-3.6.0.min.js"></script>
		<script src="<?= base_url(); ?>assets/js/jquery.nivo.slider.js"></script>
		<script src="<?= base_url(); ?>assets/js/marquee.js"></script>
		<script src="<?= base_url(); ?>assets/js/scroll-to-top.js"></script>
		<script src="<?= base_url(); ?>assets/js/mislider.js"></script>
		<script src="<?= base_url(); ?>assets/js/main.js"></script>

		<script type="text/javascript">
			$(function (){
				$('.simple-marquee-container').SimpleMarquee();
			});
		</script>
	

		<script type="text/javascript">
			$(window).load(function() {
				$('#slider').nivoSlider();
			});
		</script>

		<script> 
		$(document).ready(function(){
			$("#flip").click(function(){
				$("#panel").slideToggle("slow");
			});
		});
		</script>
	</body>
</html>