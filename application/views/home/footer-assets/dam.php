<script src="<?= base_url() ?>assets/back/js/angular.min.js"></script>
<script src="<?= base_url() ?>assets/back/js/sanitize.min.js"></script>
<script src="<?= base_url() ?>assets/front/js/owl.carousel.min.js"></script>


<script>
	var app = angular.module("myApp", ['ngSanitize']);


	app.controller("myCtrl", function($scope, $http) {
		$scope.Physio = JSON.parse('<?= $dam->physio ?>');
		$scope.Hydrology = JSON.parse('<?= $dam->hydrology ?>');
		$scope.Ownership = JSON.parse('<?= $dam->ownership ?>');
		$scope.Location = JSON.parse('<?= $dam->location ?>');
		$scope.dam = {
			name: "<?= $dam->dam_name ?>",
			region: "<?= $dam->region_name ?>",
			state: "<?= $dam->state_name ?>",
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
		$scope.ride = `carousel`;
		$scope.icon = 'fa fa-pause';
		$scope.images = JSON.parse('<?= $this->media_model->get_media('image'); ?>');

		$scope.playSlide = function() {
			if ($scope.ride.length > 0) {
				$scope.ride = 'null';
				$scope.icon = "fa fa-play";
			} else {
				$scope.ride = 'carousel';
				$scope.icon = "fa fa-pause"
			}
		}





	});
</script>
