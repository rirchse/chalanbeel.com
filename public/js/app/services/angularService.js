app.service('angularService', function ($http){        
        var service = {};
        service.getPackages = function(){
                return $http.get(baseURL+'angular/GetPackages');
        }
        return service;
});