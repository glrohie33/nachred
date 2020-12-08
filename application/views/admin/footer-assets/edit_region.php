<script src="<?=base_url()?>assets/back/js/angular.min.js"></script>
<script src="<?=base_url()?>assets/back/js/sanitize.min.js"></script>

<script>
  var app = angular.module("myApp", ['ngSanitize']);

app.controller("myCtrl", function($scope,$http) {
  $scope.regionName = "<?=$region->region_name?>";
  $scope.regionDescription = "<?=$region->region_description?>";
  $scope.image = {'image':"<?=$region->feature_img?>"}
  $scope.feedback = "";
  $scope.showFeedback = false;
  $scope.images = JSON.parse('<?=$this->media_model->get_media('image');?>');

  $scope.submit = function(event){
        
      var formdata = new FormData();
      formdata.append('<?=$this->security->get_csrf_token_name()?>','<?=$this->security->get_csrf_hash()?>');
      formdata.append('name',$scope.regionName);
      formdata.append('description',$scope.regionDescription);
      formdata.append('ft_image',$scope.image.image);   
      data = {
    '<?=$this->security->get_csrf_token_name()?>':'<?=$this->security->get_csrf_hash()?>',
          name:$scope.regionName,
          description:$scope.regionDescription
      }
      
    $.ajax({
            url:"<?=base_url()?>admin/region/update/<?=$region->region_id?>",
            type:'POST',
            cache:false,
            contentType:false,
            data:formdata,
            processData:false,
            success:(resp)=>{
                var resp = JSON.parse(resp);
                if(resp.status){
                    $scope.$apply(()=>{
                        $scope.feedback = "<p>success region edited</p>";
                        $scope.showFeedback = true;
                    }); 
                }else{
                    $scope.$apply(()=>{
                        $scope.feedback = resp.error;
                        $scope.showFeedback = true;
                    });
                    
                }
            }
      });
  };

  $scope.mediafeedback = "";
  $scope.mediashowFeedback = false;
  $scope.upload= function(){
      
      var formdata = new FormData(document.querySelector('#upload'));
      formdata.append('<?=$this->security->get_csrf_token_name()?>','<?=$this->security->get_csrf_hash()?>');
      $.ajax({
            url:"<?=base_url()?>admin/media/upload",
            type:'POST',
            cache:false,
            contentType:false,
            data:formdata,
            processData:false,
            success:(resp)=>{
                    var resp = JSON.parse(resp);
                    $scope.$apply(()=>{
                        $scope.mediafeedback = resp.feedback;
                        $scope.mediashowFeedback = true;
                        $arr = $scope.images.concat(resp.data);
                        $scope.images = $arr;
                        document.querySelector('#upload').reset();
                    }); 
                    
            }
      });
  };

  $scope.hideFeedback = ()=>{
    $scope.mediashowFeedback = false;         
  }
});  
</script>