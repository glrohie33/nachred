<script src="<?= base_url() ?>assets/back/js/angular.min.js"></script>
<script src="<?= base_url() ?>assets/back/js/sanitize.min.js"></script>

<script>
	var app = angular.module("myApp", ['ngSanitize']);

	app.controller("myCtrl", function($scope, $http) {
		$scope.stateName = "";
		$scope.stateDescription = "";
		$scope.region = {
			region: ''
		};
		$scope.regions = JSON.parse('<?= $regions ?>');
		$scope.feedback = "";
		$scope.image = {
			image: ""
		};
		$scope.mediaFeedback = "";
		$scope.showmediaFeedback = false;
		$scope.images = JSON.parse('<?= $this->media_model->get_media('image'); ?>');

		$scope.submit = function(event) {

			var formdata = new FormData();
			formdata.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
			formdata.append('name', $scope.stateName);
			formdata.append('description', $scope.stateDescription);
			formdata.append('region', $scope.region.region);
			formdata.append('ft_image', $scope.image.image);

			$.ajax({
				url: "<?= base_url() ?>admin/state/save",
				type: 'POST',
				cache: false,
				contentType: false,
				data: formdata,
				processData: false,
				success: (resp) => {
					var resp = JSON.parse(resp);
					if (resp.status) {
						$scope.$apply(() => {
							$scope.regionName = "";
							$scope.regionDescription = "";
							$scope.feedback = "<p>success new state has been created</p>";
							$scope.showFeedback = true;
						});

						if ($scope.stay == false) {
							var data = resp.data;
							setTimeout(() => {
								window.location = `<?= base_url() ?>admin/state/edit/${data.state_id}`;
							}, 2000);
						}
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
		$scope.mediafeedback = "";
		$scope.mediashowFeedback = false;
		$scope.upload = function() {

			var formdata = new FormData(document.querySelector('#upload'));
			formdata.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
			$.ajax({
				url: "<?= base_url() ?>admin/media/upload",
				type: 'POST',
				cache: false,
				contentType: false,
				data: formdata,
				processData: false,
				success: (resp) => {
					var resp = JSON.parse(resp);
					$scope.$apply(() => {
						$scope.mediafeedback = resp.feedback;
						$scope.mediashowFeedback = true;
						$arr = $scope.images.concat(resp.data);
						$scope.images = $arr;
						document.querySelector('#upload').reset();
					});

				}
			});
		};

		$scope.hideFeedback = () => {
			$scope.mediashowFeedback = false;
			$scope.showFeedback = false;

		}
	});
</script>
