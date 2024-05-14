
app.controller('AngularCtrl', function($scope, angularService){

        $scope.onPageLoad = function(){
                getPackages();                
        }

        function getPackages(){                
                angularService.getPackages().then(function(res){                        
                        $scope.packageList = res.data;
                        console.log($scope.packageList);
                }, function(err){
                        console.log('Error: ', err);
                });
        }
})