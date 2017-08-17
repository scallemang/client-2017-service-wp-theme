angular.module('teledent', [])
.controller('RegistrationController', 
    ['$scope', '$http', function($scope, $http) {

  $scope.init = function() {
    $scope.reset();
    $scope.dataSetup();
    $scope.wpUploadFileHandler();
  }

  $scope.reset = function() {
    $scope.user = angular.copy($scope.master);
  };

  $scope.dataSetup = function() {

    //Initial data states
    $scope.master = {};
    $scope.formState = 'register'; //applicant
    $scope.emailIsUnique = true;

    $scope.user = {};
    $scope.languageList = [];
    $scope.lcoationList = [];
    $scope.contractTypesList = [];
    $scope.workTypesObjekt = [];
    $scope.softwareObjekt = [];

    var languageObjekt = [
      {name:'English'},
      {name:'French'},
      {name:'Arabic'},
      {name:'Bengali'},
      {name:'Cantonese'},
      {name:'Croatian'},
      {name:'Czech'},
      {name:'Farsi'},
      {name:'Filipino'},
      {name:'German'},
      {name:'Greek'},
      {name:'Gujarati'},
      {name:'Hebrew'},
      {name:'Hindi'},
      {name:'Italian'},
      {name:'Japanese'},
      {name:'Korean'},
      {name:'Kurdish'},
      {name:'Mandarin'},
      {name:'Persian'},
      {name:'Polish'},
      {name:'Punjabi'},
      {name:'Portuguese'},
      {name:'Russian'},
      {name:'Serbian'},
      {name:'Spanish'},
      {name:'Tagalog'},
      {name:'Tamil'},
      {name:'Turkish'},
      {name:'Ukranian'},
      {name:'Urdu'}
    ];

    var contractTypesObjekt = [
      {name:'Full-time'},
      {name:' Part-time'},
      {name:' Permanent'},
      {name:'Temporary'}
    ];

    var workTypesObjekt = [
      {name:'Administer'},
      {name:'Assistant'},
      {name:'Hygienist'},
    ];

    var softwareObjekt = [
      {name:'ABELDent'},
      {name:'Adstra'},
      {name:'Autopia'},
      {name:'Carestream'},
      {name:'ClearDent'},
      {name:'DentalWare'},
      {name:'DentiMax'},
      {name:'Dentrix'},
      {name:'DOM'},
      {name:'EagleSoft'},
      {name:'Exan'},
      {name:'iTero'},
      {name:'LiveDDM'},
      {name:'Logic Tech/Paradigm'},
      {name:'MacPractice'},
      {name:'Maxident'},
      {name:'OPES'},
      {name:'OrthoTrac'},
      {name:'TDO'},
      {name:'Tracker'},
      {name:'Other'}
    ];

    $scope.languageList = languageObjekt;
    $scope.contractTypesList = contractTypesObjekt;
    $scope.workTypesList = workTypesObjekt;
    $scope.softwareList = softwareObjekt;
  }

  //HACK AROUND - used to hide, reposition, and remove extra 
  $scope.wpUploadFileHandler = function () {
    var uploaders = document.querySelectorAll('.wfu_container');
    var destination = document.getElementById('putUpload');

    if(uploaders) {
      for(var i = 0; i < Object.keys(uploaders).length; i++) {
        uploaders[i].style.display = 'none';
      }
    }

    if(destination && uploaders) { 
      destination.innerHTML = uploaders[0].innerHTML;
      for(var i = 0; i < Object.keys(uploaders).length; i++) {
        uploaders[i].remove();
      }
    }
  }
  
  //1. Check for Unique Email - AJAXed
  $scope.emailCheck = function(user) {

    $http({
        'method': 'POST',
        'url': '/wp-admin/admin-ajax.php', 
        'params': {
            'action': 'emailCheck',
            'email_address': user.email_address
        }
      }
    )
    .then(function successCallback(response) {
      if(response.data !== "1" ) {
        $scope.emailIsUnique = false;
      } else {
        $scope.emailIsUnique = true;
      }
    }, function errorCallback(response) {
      console.log('error: ',response);
    });
  };


 //2. Register Unique Email - AJAXed
  $scope.actionRegister = function(user) {

    $scope.master = angular.copy(user);
    $scope.formState = 'success'; 

    $http({
          'method': 'POST',
          'url': '/wp-admin/admin-ajax.php', 
          'params': {
              'action': 'createAccount',
              'user_type': $scope.master.user_type,
              'email_address': $scope.master.email_address
          }
        }
      )
      .then(function successCallback(response) {
        window.location = '/' + response.data.type + '/' + response.data.slug;
      }, 
        function errorCallback(response) {
        console.log('error: ',response);
      });

  };

  $scope.createApplicant = function(user) {

    $scope.master = angular.copy(user);

    $http({
          'method': 'POST',
          'url': '/wp-admin/admin-ajax.php', 
          'params': {
              'action': 'createApplicant',
              'user_type': $scope.master.user_type,
              'first_name': $scope.master.first_name,
              'last_name': $scope.master.last_name,
              'email_address': $scope.master.email_address,
              'primary_phone': $scope.master.primary_phone,
              'postal_code': $scope.master.postal_code,
              'work_types': $scope.master.work_types,
              'contract_type': $scope.master.contract_type,
              'commute': $scope.master.commute,
              'salary': $scope.master.salary
          }
        }
      )
      .then(function successCallback(response) {
      
        $scope.formState = 'success';

      }, function errorCallback(response) {
        console.log('error: ',response);
      });

  };

  $scope.actionOffice = function(user) {
    
    $scope.master = angular.copy(user);

    $http({
          'method': 'POST',
          'url': '/wp-admin/admin-ajax.php', 
          'params': {
              'action': 'createOffice',
              'user_type': $scope.master.user_type,
              'office_name': $scope.master.office_name,
              'contact_name': $scope.master.contact_name,
              'email_address': $scope.master.email_address,
              'primary_phone': $scope.master.primary_phone,
              'secondary_phone': $scope.master.secondary_phone,
              'address': $scope.master.address,
              'work_types': $scope.master.work_types,
              'contract_type': $scope.master.contract_type,
              'salary': $scope.master.salary
          }
        }
      )
      .then(function successCallback(response) {

        $scope.formState = 'success';
        
      }, function errorCallback(response) {
        console.log('error: ',response);
      });

  };

  $scope.init();

}]);