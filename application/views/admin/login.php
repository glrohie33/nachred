<?php
include "head.php";
?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content" ng-app="myApp" ng-controller="myCtrl">

							<div class="header">
								<div class="logo text-center"><img src="<?= base_url() ?>assets/front/images/logo.jpg" alt="Nachred Logo" height="100px"></div>
								<p class="lead">Login to your admin account</p>
							</div>
							<div class="alert alert-info " id="feedback" ng-show="showFeedback">
								<button type="button" class="close" ng-click="hideFeedback()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div ng-bind-html='feedback'>
								</div>
							</div>
							<form class="form-auth-small" action="" onsubmit="return false">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="email" value="" ng-model="email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="password" value="" ng-model="password" placeholder="Password">
								</div>

								<button type="submit" class="btn btn-primary btn-lg btn-block" ng-click="submit()">LOGIN</button>

							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading"> NACHRED Compedium of Nigerian Dams </h1>
							<p>by NACHRED</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
<script src="<?= base_url() ?>assets/back/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/back/js/angular.min.js"></script>
<script src="<?= base_url() ?>assets/back/js/sanitize.min.js"></script>

<script>
	var app = angular.module("myApp", ['ngSanitize']);

	app.controller("myCtrl", function($scope, $http) {
		$scope.email = "";
		$scope.password = "";
		$scope.feedback = "";
		$scope.showFeedback = false;

		$scope.submit = function(event) {

			var formdata = new FormData();
			formdata.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
			formdata.append('email', $scope.email);
			formdata.append('password', $scope.password);

			$.ajax({
				url: "<?= base_url() ?>admin/login/do_login",
				type: 'POST',
				cache: false,
				contentType: false,
				data: formdata,
				processData: false,
				success: (resp) => {
					var resp = JSON.parse(resp);
					if (resp.status) {
						$scope.$apply(() => {
							$scope.feedback = "<p>login successful</p>";
							$scope.showFeedback = true;
						});
						setTimeout(() => {
							window.location = `<?= base_url() ?>admin/dashboard`;
						}, 3000);
					} else {
						$scope.$apply(() => {
							$scope.feedback = resp.error;
							$scope.showFeedback = true;
						});

					}
					$("body,html").animate({
							scrollTop: $("#feedback").offset().top - 200
						},
						800 //speed
					);
				}
			});
		};

		$scope.hideFeedback = () => {

			$scope.showFeedback = false;

		}
	});
</script>



</html>
