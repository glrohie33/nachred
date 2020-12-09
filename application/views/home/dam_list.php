<style>
	.newsgrid1 {
		padding: 3px;
		box-shadow: 0 20px 40px -10px rgba(0, 0, 0, .3);
		border-radius: 2px;
	}

	.newsgrid1 .details {
		padding: 10px;
	}

	section.news img {
		padding: 0px;
		background: #fff;
		box-shadow: none;
	}
</style>

<section class="inner-banner">
	<div class="container">
		<h3 class="text-center"><?= $title ?></h3>
	</div>
</section>
<div class="breadcrumb-agile">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.html">Home</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
		</ol>
	</div>
</div>
<section class="news py-2" id="news">
	<div class="container py-lg-3" ng-app="myApp" ng-controller="myCtrl">
		<div class="row blog-grids">
			<div class="col-lg-4 col-md-6 newsgrid1" ng-repeat="x in dams">
				<img src="{{x.feature_img}}" style="height: 250px;width:100%;object-fit: cover;" alt="news image" class="img-fluid">
				<div class="details">
					<h4 class="mt-1"><a href="{{x.baseurl}}{{x.slug}}">{{x.dam_name}}</a></h4>
					<ul class="blog-info mt-1">
						<li class="mr-4"><span class="fa fa-eye"> {{x.views}} Views</span></li>
					</ul>
					<a href="{{x.baseurl}}{{x.slug}}" class="read">View <span class="fa fa-long-arrow-right"></span></a>

				</div>
			</div>
		</div>
	</div>
</section>
