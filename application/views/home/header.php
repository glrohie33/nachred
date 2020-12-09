<header class="py-sm-3 pt-3 pb-2" id="home" style="padding: 10px 0px !important;max-width:none;">
	<div class="container" style="max-width:none;padding:0px; width:100%;">
		<!-- nav -->
		<div class="top">
			<img src="<?= base_url() ?>assets/front/images/logo.jpg" style="width:80px;float:left;" alt="">
			<div id="logo" style="display: inline-block">
				<h1>National Centre For Hydropower</h1>
				<h1>Research And Development</h1>
			</div>
		</div>
		<nav class="">
			<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu">
				<li class="mr-lg-4 mr-2 active"><a href="<?= base_url() ?>">Home</a></li>
				<li class="mr-lg-4 mr-2">
					<a href="" class="" data-toggle="collapse" data-target="#region">Regions</a>
					<ul class="collapse" id="region">
						<?php
						$regions = $this->crud_model->get_data('region');
						foreach ($regions as $region) {
						?>
							<li class="">
								<a class="" data-toggle="collapse" data-target="#<?= $region['region_name'] ?>"><?= $region['region_name'] ?></a>
								<div class="collapse" id="<?= $region['region_name'] ?>">
									<?php
									$states = $this->db->get_where('state', array('region_id' => $region['region_id']))->result_array();
									foreach ($states as $state) {
									?>
										<a href="<?= base_url() . $state['slug'] ?>"><?= $state['state_name'] ?></a>
									<?php
									}
									?>
								</div>
							</li>
						<?php
						} ?>


					</ul>
				</li>
				<li class="mr-lg-4 mr-2"><a href="https://nachred.org.ng">main Website</a></li>
				<li class="mr-lg-4 mr-2"><a href="https://nachred.org.ng/about/">About</a></li>
				<li class=""><a href="https://nachred.org.ng/contact/">Contact</a></li>
			</ul>
		</nav>
		<!-- //nav -->
	</div>
</header>
