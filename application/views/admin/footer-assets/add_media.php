<script src="<?=base_url()?>assets/back/js/angular.min.js"></script>
<script src="<?=base_url()?>assets/back/js/sanitize.min.js"></script>
<script>
  var app = angular.module("myApp", ['ngSanitize']);

app.controller("myCtrl", function($scope,$http) {
  $scope.files = [];
  $scope.feedback = "";
  $scope.showFeedback = false;
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
                        $scope.feedback = resp.feedback;
                        $scope.showFeedback = true;
                    }); 
            }
      });
  };

  $scope.hideFeedback = ()=>{
    $scope.showFeedback = false;         
  }


});  
</script>