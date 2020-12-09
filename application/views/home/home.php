<!-- banner -->
<?php
$sliders = $this->db->get('slider')->result();

?>
<style>
	.carousel-caption p {
		color: #fff;
		text-transform: Capitalize;

	}
</style>
<section class="banner_w3lspvt">
	<div class="carousel slide" id="slider1">

		<ul class="carousel-indicators">
			<?php
			$i = 0;
			while ($i < count($sliders)) {
				$active = ($i == 0) ? 'active' : '';

			?>
				<li data-target="#slider<?= $i + 1 ?>" data-slide-to="<?= $i ?>" class="<?= $active ?>"></li>
			<?php
				$i++;
			}
			?>
		</ul>
		<div class="carousel-inner">
			<?php
			$i = 0;
			foreach ($sliders as $slider) {
				$active = ($i == 0) ? 'active' : '';
			?>
				<div class="banner-top carousel-item <?= $active ?>" style="background-image:url(<?= $slider->slider_url ?>)">
					<div class="overlay">
						<div class="container">
							<?php
							if ($i == 0) {
							?>
								<div class="w3layouts-banner-info text-center">
									<h3 class="text-wh">Welcome To </h3>
									<h4 style="color:#fff;" class="text-wh">NACHRED Compedium of Nigerian Dams</h4>
								</div>
							<?php
							}
							?>
						</div>
					</div>
					<div class="carousel-caption">
						<p><?= $slider->slider_text ?></p>
					</div>
				</div>
			<?php
				$i++;
			}
			?>
		</div>

		<a class="carousel-control-prev" href="#slider1" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#slider1" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>
</section>
<!-- //banner -->

<!-- about-->
<section class="wthree-row " id="about">
	<div class="container py-lg-5">
		<div class="row about-main">
			<div class="col-lg-5 about-text-grid text-left pr-lg-5">
				<div class="title-desc">
					<h3 class="main-title-w3pvt text-capitalize">Our Mission</h3>
				</div>
				<hr>
				<p class="mt-3">To conduct research and training that will enhance the development and application of hydropower as an important component of diverse energy sources that is needed for a stable and reliable energy sector in Nigeria.</p>

				<a href="https://nachred.org.ng/about/" class="text-capitalize serv_link btn bg-theme1 scroll mt-4">view more</a>
			</div>
			<div class="col-lg-3 col-sm-6 about-right mt-lg-0 mt-4">
				<img src="<?= base_url() ?>assets/front/images/hydrokineticTurbine5.jpg" class="img-fluid" alt="" />
			</div>
			<div class="col-lg-4 col-sm-6 mt-lg-0 mt-3 about-right2">
				<img src="<?= base_url() ?>assets/front/images/hydrokineticTurbine2.jpg" class="img-fluid" alt="" />
			</div>
		</div>
	</div>
</section>
<!-- //about -->

<!-- //specialization -->

<!-- top categories -->
<!-- <section class="news " id="news">
	<div class="container py-lg-5">
		<div class="d-flex view">
			<h3 class="heading mb-5"> Top Categories </h3>
			<div class="ml-auto">
				<a href="categories.html">View All</a>
			</div>
		</div>
		<div class="row news-grids">
			<div class="col-lg-3 col-sm-6 newsgrid1">
				<img src="<?= base_url() ?>assets/front/images/living-room.jpg" alt="news image" class="img-fluid">
				<h4 class="mt-4">Living Room</h4>
				<p class="mt-3">Nulla pellentesque dolor ipsum laoreet eleifend integer. </p>
			</div>
			<div class="col-lg-3 col-sm-6 mt-sm-0 mt-5 newsgrid2">
				<img src="<?= base_url() ?>assets/front/images/dining-room.jpg" alt="news image" class="img-fluid">
				<h4 class=" mt-4">Dining Room</h4>
				<p class="mt-3">Nulla pellentesque dolor ipsum laoreet eleifend integer. </p>
			</div>
			<div class="col-lg-3 col-sm-6 newsgrid3 mt-lg-0 mt-4">
				<img src="<?= base_url() ?>assets/front/images/bedrooom.jpg" alt="news image" class="img-fluid">
				<h4 class=" mt-4">Bedroom</h4>
				<p class="mt-3">Nulla pellentesque dolor ipsum laoreet eleifend integer. </p>
			</div>
			<div class="col-lg-3 col-sm-6 newsgrid3 mt-lg-0 mt-4">
				<img src="<?= base_url() ?>assets/front/images/office-room.jpg" alt="news image" class="img-fluid">
				<h4 class=" mt-4">Office Room</h4>
				<p class="mt-3">Nulla pellentesque dolor ipsum laoreet eleifend integer. </p>
			</div>
		</div>
	</div>
</section> -->
<!-- //top categories -->
