angular.module('teledent', [])
.controller('RegistrationController', 
    ['$scope', '$http','$window', function($scope, $http, $window) {

  //Set up initial data states
  $scope.master = {};
  $scope.formState = 'register';
  $scope.provList = [];
  $scope.ajaxurl = $window.ajaxurl;

  //Field datasets
  var spielObjekt = [
    {name:'Alberta'},
    {name:'British Columbia'},
    {name:'Manitoba'},
    {name:'New Brunswick'},
    {name:'British Columbia'},
    {name:'Newfoundland and Labrador'},
    {name:'Northwest Territories'},
    {name:'Nova Scotia'},
    {name:'Nunavut'},
    {name:'Ontario'},
    {name:'Prince Edward Island'},
    {name:'Quebec'},
    {name:'Saskatchewan'},
    {name:'Yukon'}
  ];

$scope.provList = spielObjekt;

  //Funcationality
  $scope.actionRegister = function(user) {
    $scope.master = angular.copy(user);
    //ajax - create user account(s)
	
	   $scope.formState = 'applicant';
	
  };

  $scope.actionApplicant = function(user) {
    $scope.master = angular.copy(user);

    $http({
          'method': 'POST',
          'url': '/wp-admin/admin-ajax.php', 
          'params': {
              'action': 'prepDomAction',
              'email_address': $scope.master.email_address,

              'street_name': $scope.master.street_name,
              'street_number': $scope.master.street_numbner,
              'unit_number': $scope.master.unit_number,

              'city': $scope.master.city,
              'province': $scope.master.province.name,
              'postal_code': $scope.master.postal_code,
          }
        }
      )
      .then(function successCallback(response) {
      //   // this callback will be called asynchronously
      //   // when the response is available
        console.log(response);
      }, function errorCallback(response) {
      //   // called asynchronously if an error occurs
      //   // or server returns response with an error status.
        console.log('error: ',response);
      });

    //calling php
    /// problem because i want to use wp_update_user() syntax
    /// could use DB scripts in php/mysql, how to manage meta?



    //ajax - update user account(s)
    //send email to Teledent
    //send welcome email to user asking to set password
    //let user know to check their email
  };

  $scope.reset = function() {
    $scope.user = angular.copy($scope.master);
  };

  $scope.reset();
}]);