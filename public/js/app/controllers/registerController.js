
app.controller('regCtrl', function ($scope, regService) {

	$scope.onPageLoad = function(){
		getPackages();
		getAreas();
	}

	function getPackages(){
		regService.getPackages().then(function(reg){
			$scope.intPkgs = reg.data;
			console.log($scope.intPkgs);
		}, function(error){
			console.log('Error: ', error);
		})
	}

	function getAreas() {
		regService.getAreas().then(function (area) {
			$scope.CovPkgs = area.data;
			console.log($scope.CovPkgs);
		}, function(error){
			console.log('Error:', error);
		})
	}
	
/*

	$scope.registerModel = {
		package: ''
	}


	
	


	$scope.register = function () {

		if (!$scope.registerModel.package) {
			$scope.error = true;
			return;
        }
        


        //console.log($scope.registerModel);
        
        // if all validation pass
        regService.register($scope.registerModel).then(
            function(success){
            console.log('Registration successful');
        }, function(error){
            console.log('Error: ', error);
		});
		

		
	}
	*/
});