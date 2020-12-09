<script src="<?= base_url() ?>assets/back/js/angular.min.js"></script>
<script src="<?= base_url() ?>assets/back/js/sanitize.min.js"></script>



<script>
	var app = angular.module("myApp", ['ngSanitize']);


	app.controller("myCtrl", function($scope, $http) {
		$scope.dam = {
			name: "",
			region: "",
			state: "",
			location: {
				lga: "",
				longitude: "",
				latitude: "",
				altitude: "",
				nor: "",
				nob: ""

			},
			physio: {
				category: "",
				tod: "",
				purpose: "",
				hod: "",
				crest: "",
				spillway: ""

			},
			hydrology: {
				discharge: "",
				head: "",
				area: "",
				capacity: "",
				storage: "",
				surface: ""

			},
			ownership: {
				owner: "",
				year: "",
				contractor: "",
				consultant: ""

			},
			image: "",
			images: [],
			description: ""

		};
		$scope.state = [];
		$scope.regions = JSON.parse('<?= $regions ?>');
		$scope.allstates = JSON.parse('<?= $states ?>');
		$scope.showFeedback = false;
		$scope.stay = false;
		$scope.images = JSON.parse('<?= $this->media_model->get_media('image'); ?>');

		$scope.submit = function(event) {
			$dam = $scope.dam;
			var formdata = new FormData();
			formdata.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
			formdata.append('name', $dam.name);
			formdata.append('description', $dam.description);
			formdata.append('region', $dam.region);
			formdata.append('ft_image', $dam.image);
			formdata.append('state', $dam.state);
			formdata.append('location', JSON.stringify($dam.location));
			formdata.append('physio', JSON.stringify($dam.physio));
			formdata.append('hydrology', JSON.stringify($dam.hydrology));
			formdata.append('ownership', JSON.stringify($dam.ownership));
			formdata.append('images', JSON.stringify($dam.images));

			$.ajax({
				url: "<?= base_url() ?>admin/dam/save",
				type: 'POST',
				cache: false,
				contentType: false,
				data: formdata,
				processData: false,
				success: (resp) => {
					var resp = JSON.parse(resp);
					if (resp.status) {
						$scope.$apply(() => {
							$scope.feedback = "<p>success new dam has been created</p>";
							$scope.showFeedback = true;
						});
						var data = resp.data;
						setTimeout(() => {
							window.location = `<?= base_url() ?>admin/state/edit/${data.dam_id}`;
						}, 2000);
					} else {
						$scope.feedback = "<p>success new dam has been created</p>";
						$scope.showFeedback = true;
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

		$scope.setStates = function() {
			$filter = $scope.allstates.filter((state) => {
				return state.region_id == $scope.dam.region;
			});

			$scope.state = $filter;
			console.log($scope.state);
		}

		$scope.setImages = function($value) {
			$index = $scope.dam.images.indexOf($value);
			if ($index > -1) {
				$check = $(`#images-modal input[name="${$value}"]`);
				$check.prop('checked', false);
				$scope.dam.images.splice($index, 1);


			} else {
				$scope.dam.images.push($value);
			}
		}

		$scope.hideFeedback = () => {
			$scope.mediashowFeedback = false;
			$scope.showFeedback = false;
		}
	});
</script>
