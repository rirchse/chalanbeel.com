
app.service('regService', function ($http) {
    var service = {};
/*
    service.register = function (regModel) {
        return $http.post(baseURL+regModel);
    }
*/
    service.getPackages = function(){
        return $http.get(baseURL+'reg/getPackages');
    }
    return service;

    
});

app.service('AreaService', function($http){
	var areas = {};

	service.Areas = function() {
    	return $http.get(baseURL+'reg/getAreas');
    }

    return areas;
})