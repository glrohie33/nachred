<script src="<?=base_url()?>assets/back/js/angular.min.js"></script>
<script src="<?=base_url()?>assets/back/js/sanitize.min.js"></script>
<script>
  var app = angular.module("myApp", ['ngSanitize']);

app.directive('compile',['$compile',function ($compile){
    return function(scope,element,attrs){
        scope.$watch(
            function(scope){
                return scope.$eval(attrs.compile);
            },
            function (value){
                element.html(value);
                $compile(element.contents())(scope);
            }
        );
    };
}]).controller("myCtrl", function($scope,$http) {
  $scope.dams = JSON.parse('<?=$dams?>');
  $scope.limit = "5";
  $scope.begin = "0";
  $scope.total = <?=$total_rows?>;
  $scope.paginations = '';
  $scope.baseUrl="<?=base_url()?>";
  $scope.feedback = "";
  $scope.showFeedback = false;
  $scope.setPaginations = function(){
        var iter = $scope.total / $scope.limit;
        if(iter > 1){
            $end = Math.ceil(iter);
            $i = 1;
            $page = `<div><a class='btn btn-default btn-xs' ng-click="setView(${$i})"><</a>`;
            while($i <= $end){
                $page +=`<a class='btn btn-default btn-xs' ng-click='setView(${$i})'>${$i}</a>`;
                $i++;
            }
            $page += `<a class='btn btn-default btn-xs' ng-click="setView(${$end})">></a></div>`;
            	$scope.paginations= $page;
        }else{
            $scope.paginations = "";
        }
    }

    $scope.setView=($page)=>{
        $scope.begin = ($page * $scope.limit) - $scope.limit;
    }

    $scope.delete=(id)=>{
        $url = `${$scope.baseUrl}admin/dam/delete/${id}`;
        $.ajax({
            url:$url,
            cache:false,
            contentType:false,
            processData:false,
            success:(resp)=>{
                var resp = JSON.parse(resp);
                if(resp.status){
                    $scope.$apply(()=>{
                        $scope.feedback = "<p>success state edited</p>";
                        $scope.regions = resp.data;
                        $scope.total = resp.data.length;
                        $scope.setPaginations();
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
    }

});

</script>