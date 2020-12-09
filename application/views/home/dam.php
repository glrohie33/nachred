<style>
	.blog-sldebar-right h5 {
		font-size: 16px;
	}

	.title h4 {
		font-size: 21px;
		line-height: 36px;
	}

	.blog-sldebar-right .details {
		padding: 0px 25px;
	}

	.carousel img {
		height: 400px;
		width: 100%;
		object-fit: cover;
	}

	.controls a {
		display: inline-block !important;
		position: static !important;
	}

	#controls {
		text-align: center;
	}

	.carousel-control-prev,
	.carousel-control-next {
		position: static;
		display: inline-block;
		color: #000 !important;
	}

	.carousel-control-prev:hover,
	.carousel-control-next:hover {
		position: static;
		display: inline-block;
		color: #000 !important;
	}

	.details table {
		width: 100%;
	}
</style>

<section class="inner-banner">
	<div class="container">
		<h3 class="text-center"><?= $title ?></h3>
	</div>
</section>

<div class="breadcrumb-agile">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.html">Home</a>
		</li>
		<li class="breadcrumb-item">
			<a href="index.html"><?= $region_name ?></a>
		</li>
		<li class="breadcrumb-item">
			<a href="index.html"><?= $state_name ?></a>
		</li>
		<li class="breadcrumb-item active" aria-current="page"> <?= $title ?></li>
	</ol>
</div>

<section class="ab-info-main">
	<div class="container" ng-app="myApp" ng-controller="myCtrl">
		<div class="inner-sec-w3pvt py-5">
			<div class="blog-sec">
				<div class="row mt-lg-3">

					<aside class="col-md-5 blog-sldebar-right mt-lg-0 mt-5" style="border:1px solid #dedede;">

						<div class="row">
							<div class="title col-md-12">
								<h4>Location Details:</h4>
							</div>
							<div class="col-md-12 details">
								<table>
									<tr>
										<th>State:</th>
										<td>{{dam.state}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Lga:</th>

										<td>{{dam.location.lga}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Longitude:</th>
										<td>{{dam.location.longitude}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Latitude:</th>
										<td>{{dam.location.latitude}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Altitude:</th>

										<td>{{dam.location.altitude}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Name Of River:</th>

										<td>{{dam.location.nor}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Name of Basin:</th>

										<td>{{dam.location.nob}}</td>
									</tr>
								</table>

							</div>



						</div>
						<hr>
						<div class="row">
							<div class="title col-md-12">
								<h4>Physiographic Data</h4>
							</div>
							<div class="col-md-12 details">
								<table>
									<tr class="col-md-6">
										<th>Category Of Dam:</th>
										<td>{{dam.physio.category}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Type Of Dam:</th>
										<td>{{dam.physio.tod}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Purpose:</th>
										<td>{{dam.physio.purpose}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Height of Dam (M):</th>
										<td>{{dam.physio.hod}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Crest Length:</th>
										<td>{{dam.physio.crest}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Spillway Type:</th>
										<td>{{dam.physio.spillway}}</td>
									</tr>
								</table>

							</div>
						</div>
						<hr>
						<div class="row">
							<div class="title col-md-12">
								<h4>Hydrology</h4>
							</div>
							<div class="col-md-12 details">
								<table>
									<tr class="col-md-6">
										<th>Discharge:</th>

										<td>{{dam.hydrology.discharge}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Available Head:</th>

										<td>{{dam.hydrology.head}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Reservior Area (M<sup>2</sup>):</th>

										<td>{{dam.hydrology.area}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Reservior Capacity <span>(Million Cubic Meters)</span>:</th>

										<td>{{dam.hydrology.capacity}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Dead Storage:</th>

										<td>{{dam.hydrology.storage}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Reservior Surface Area:</th>

										<td>{{dam.hydrology.surface}}</td>
									</tr>
								</table>

							</div>
						</div>
						<hr>
						<div class="row">

							<div class="title col-md-12">
								<h4>Ownership</h4>
							</div>
							<div class="col-md-12 details">
								<table>
									<tr class="col-md-6">
										<th>Owner:</th>
										<td>{{dam.ownership.owner}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Completion Year:</th>
										<td>{{dam.ownership.year}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Contractor:</th>
										<td>{{dam.ownership.contractor}}</td>
									</tr>
									<tr class="col-md-6">
										<th>Consultant:</th>
										<td>{{dam.ownership.consultant}}</td>
									</tr>
								</table>

							</div>

						</div>

					</aside>

					<div class="col-md-7 blog-left-content">
						<div class="carousel slide" id="slider" data-ride={{ride}} style="margin-left: 20px;">
							<div class="carousel-inner">
								<div class="carousel-item" ng-class="{active:!$index}" ng-repeat="image in dam.images">
									<img src="{{ image }}" class="img-responsive">
								</div>
							</div>
							<div id="controls">
								<a class="carousel-control-prev" href="#slider" data-slide="prev">
									<span class="fa fa-fast-backward"></span>
								</a>
								<a><span class="{{icon}}" class="" ng-click='playSlide()'></span></a>
								<a class="carousel-control-next" href="#slider" data-slide="next">
									<span class="fa fa-fast-forward"></span>
								</a>
							</div>

						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
