var app = angular.module('app', []);

app.factory('mainService', function ($http) {
    var factory = {};
    factory.doPost = function (uri, data) {
        return $http.post(uri, data).then(function (response) {
            return response.data;
        });
    };

    factory.doGet = function (data, uri) {
        return $http.get(uri, data).then(function (response) {
            return response.data;
        });
    };
    return factory;
});

function getRequestObject(mode) {
    var data = {};
    data['mode'] = mode;

    return data;
}

app.controller("wsController", function($scope){
    $scope.data = [];
    
    $scope.add_data = {};
    $scope.add_data.question = [];
    $scope.add_data.answer = [];
    
     $scope.is_edit = {};
     $scope.is_edit.change = angular.copy($scope.add_data);
    
    $scope.pushAnser = function(){
        debugger;
        $scope.add_data.answer.push({"value": ""});
    };
    
    $scope.removeAnwer = function(index){
        debugger;
      $scope.add_data.answer.splice(index, 1); 
    };
    
    $scope.addData = function(){
        
    };
});

