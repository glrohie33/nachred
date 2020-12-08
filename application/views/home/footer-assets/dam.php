<script src="<?=base_url()?>assets/back/js/angular.min.js"></script>
<script src="<?=base_url()?>assets/back/js/sanitize.min.js"></script>
<script src="<?=base_url()?>assets/back/ckeditor/ckeditor.js"></script>
<script src="<?=base_url()?>assets/back/ckfinder/ckfinder.js"></script>

<script>

  var app = angular.module("myApp", ['ngSanitize']);
 

app.controller("myCtrl", function($scope,$http) {
  $scope.Physio = JSON.parse('<?=$dam->physio?>');
  $scope.Hydrology = JSON.parse('<?=$dam->hydrology?>');
  $scope.Ownership = JSON.parse('<?=$dam->ownership?>');
  $scope.Location= JSON.parse('<?=$dam->location?>');
  $scope.dam = {
      name:"<?=$dam->dam_name?>",
      region:"<?=$dam->region_name?>",
      state: "<?=$dam->state_name?>",
      location:{
        lga: $scope.Location.lga,
        longitude:$scope.Location.longitude,
        latitude:$scope.Location.latitude,
        altitude:$scope.Location.altitude,
        nor:$scope.Location.nor,
        nob:$scope.Location.nob

      },
      physio:{
        category: $scope.Physio.category,
        tod:$scope.Physio.tod,
        purpose:$scope.Physio.purpose,
        hod:$scope.Physio.hod,
        crest:$scope.Physio.crest,
        spillway:$scope.Physio.spillway

      },
      hydrology:{
        discharge:$scope.Hydrology.discharge,
        head:$scope.Hydrology.head,
        area:$scope.Hydrology.area,
        capacity:$scope.Hydrology.capacity,
        storage:$scope.Hydrology.storage,
        surface:$scope.Hydrology.surface

      },
      ownership:{
        owner:$scope.Ownership.owner,
        year:$scope.Ownership.year,
        contractor:$scope.Ownership.contractor,
        consultant:$scope.Ownership.consultant

      },
      image: "<?=$dam->feature_img?>",
      images:JSON.parse('<?=$dam->images?>'),
      description: `<?=$dam->dam_description?>`
      
  };
  $scope.state = JSON.parse('<?=$state?>');
  $scope.regions = JSON.parse('<?=$regions?>');
  $scope.allstates = JSON.parse('<?=$states?>');
  $scope.showFeedback = false;
  $scope.stay = false;
  $scope.images = JSON.parse('<?=$this->media_model->get_media('image');?>');

 
  


 

});  
</script>