
var app = angular.module('myApp', ['ngRoute', 'angularUtils.directives.dirPagination']);

app.config(function($routeProvider) {
	$routeProvider.when('/districts', {
		templateUrl : 'html/districts.html',
		controller : 'districtsCtrl'
	})
	.when('/locations', {
		templateUrl : 'html/locations.html',
		controller : 'locationsCtrl'
	})
	.when('/services', {
		templateUrl : 'html/services.html',
		controller : 'servicesCtrl'
	})
	.when('/add-service', {
		templateUrl : 'html/service_add.html',
		controller : 'serviceAddCtrl'
	})
	.otherwise({redirectTo : '/districts'})
});

app.controller('districtsCtrl', function($scope, $http) {
    $http.get("/ajax/district_list.php")
    .then(function (response) {$scope.names  = response.data;});
	
	$scope.doOrderBy = function(x) {
		$scope.myOrderBy = x;
	}
});

app.controller('locationsCtrl', function($scope, $http) {
	
    $http.get("/ajax/location_list.php")
    .then(function (response) {$scope.names  = response.data;});
	
	$http.get("/ajax/district_list.php")
    .then(function (response) {$scope.district_list  = response.data;});
	
	$scope.doOrderBy = function(x) {
		$scope.myOrderBy = x;
	}
	
	$scope.addArea = function() {
		$scope.names.push({id:0, name:$scope.newArea.name});
		$http.post("/ajax/location_add.php", {
                'name':$scope.newArea.name,
                'district_id':$scope.newArea.district.id
            }).then(function(response){
                    console.log("Data Inserted Successfully");
                },function(error){
                    alert("Sorry! Data Couldn't be inserted!");
                    console.error(error);

                });
	}
		
	$scope.getClass = function (path) {
	  return ($location.path().substr(0, path.length) === path) ? 'active' : '';
	}
	
});

app.controller('servicesCtrl', function($scope, $http) {
    $http.get("/ajax/service_list.php")
    .then(function (response) {$scope.names  = response.data;});

});

app.controller('serviceAddCtrl', function($scope, $http) {
	
    $http.get("/ajax/district_list.php")
    .then(function (response) {$scope.district_list  = response.data;});
	
	$http.get("/ajax/service_category_list.php")
    .then(function (response) {$scope.service_category_list  = response.data;});
	
	$scope.GetSelectedDistrict = function() {
		var districtSelect = '';
		if (angular.isNumber($scope.newService.district.id)) {
			districtSelect = '?district='+$scope.newService.district.id;
		}
		$http.get("/ajax/location_list.php"+districtSelect)
		.then(function (response) {$scope.location_list  = response.data;});
    };
	
	$scope.addNewService = function() {
		
		console.log($scope.newService);
		
		$http.post("/ajax/service_add.php", $scope.newService).then(function(response){
            console.log("Data Inserted Successfully");
		},function(error){
                alert("Sorry! Data Couldn't be inserted!");
                console.error(error);

        });
		
	};

});

