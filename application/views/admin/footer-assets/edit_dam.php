<script src="<?= base_url() ?>assets/back/js/angular.min.js"></script>
<script src="<?= base_url() ?>assets/back/js/sanitize.min.js"></script>
<script src="<?= base_url() ?>assets/back/ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>assets/back/ckfinder/ckfinder.js"></script>

<script>
	var app = angular.module("myApp", ['ngSanitize']);


	app.controller("myCtrl", function($scope, $http) {
		$scope.Physio = JSON.parse('<?= $dam->physio ?>');
		$scope.Hydrology = JSON.parse('<?= $dam->hydrology ?>');
		$scope.Ownership = JSON.parse('<?= $dam->ownership ?>');
		$scope.Location = JSON.parse('<?= $dam->location ?>');
		$scope.dam = {
			name: "<?= $dam->dam_name ?>",
			region: "<?= $dam->region_id ?>",
			state: "<?= $dam->state_id ?>",
			location: {
				lga: $scope.Location.lga,
				longitude: $scope.Location.longitude,
				latitude: $scope.Location.latitude,
				altitude: $scope.Location.altitude,
				nor: $scope.Location.nor,
				nob: $scope.Location.nob

			},
			physio: {
				category: $scope.Physio.category,
				tod: $scope.Physio.tod,
				purpose: $scope.Physio.purpose,
				hod: $scope.Physio.hod,
				crest: $scope.Physio.crest,
				spillway: $scope.Physio.spillway

			},
			hydrology: {
				discharge: $scope.Hydrology.discharge,
				head: $scope.Hydrology.head,
				area: $scope.Hydrology.area,
				capacity: $scope.Hydrology.capacity,
				storage: $scope.Hydrology.storage,
				surface: $scope.Hydrology.surface

			},
			ownership: {
				owner: $scope.Ownership.owner,
				year: $scope.Ownership.year,
				contractor: $scope.Ownership.contractor,
				consultant: $scope.Ownership.consultant

			},
			image: "<?= $dam->feature_img ?>",
			images: JSON.parse('<?= $dam->images ?>'),
			description: `<?= $dam->dam_description ?>`

		};
		$scope.state = JSON.parse('<?= $state ?>');
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
				url: "<?= base_url() ?>admin/dam/update/<?= $dam->dam_id ?>",
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
							$scope.feedback = "<p>success dam edited has been edited</p>";
							$scope.showFeedback = true;
						});
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
					$("body,html").animate({
							scrollTop: $("#feedback").offset().top
						},
						800 //speed
					);
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
