<section class="inner-banner">
	<div class="container">
		<h3 class="text-center"><?=$title?></h3>
	</div>
</section>
<div class="breadcrumb-agile">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.html">Home</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
		</ol>
	</div>
</div>
<section class="news py-5" id="news">
	<div class="container py-lg-3" ng-app="myApp" ng-controller="myCtrl">
		<div class="row blog-grids">
			<div class="col-lg-4 col-md-6 newsgrid1" ng-repeat="x in dams" >
				<img src="{{x.feature_img}}"  style="height: 300px;object-fit: cover;" alt="news image" class="img-fluid">
				<h4 class="mt-4"><a href="{{x.baseurl}}{{x.slug}}">{{x.dam_name}}</a></h4>
				<ul class="blog-info mt-2">
					<li class="mr-4"><span class="fa fa-eye">{{x.views}}</span></li>
					<li><span class="fa fa-comments-o"></span> 20 comments</li>
				</ul>
				<a href="single.html" class="read">Read More <span class="fa fa-long-arrow-right"></span></a>
			</div>
		</div>		
	</div>
</section>

