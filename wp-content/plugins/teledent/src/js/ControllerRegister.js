angular.module('teledent', ['ngFileUpload'])
.controller('RegistrationController', 
    ['$scope', '$http','$window', 'Upload', function($scope, $http, $window, Upload) {

  // $scope.ajaxurl = $window.ajaxurl;

  //Initial data states
  $scope.master = {};
  $scope.formState = 'register';
  $scope.user = [];
  $scope.provList = [];
  $scope.genderList = [];
  $scope.languageList = [];
  $scope.lcoationList = [];
  $scope.contractTypesList = [];
  $scope.workTypesObjekt = [];
  $scope.softwareObjekt = [];


  $scope.user.province = "Ontario";
  $scope.user.gender = "Prefer not to say";
  
  //View Data
  var provObjekt = [
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

  var genderObjekt = [
    {name:'Female'},
    {name:'Male'},
    {name:'Other'},
    {name:'Prefer not to say'}
  ];

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

  var locationObjekt = [
    {name:'Acton'},
    {name:'Ajax'},
    {name:'Ancaster'},
    {name:'Aurora'},
    {name:'Barrie'},
    {name:'Bolton'},
    {name:'Bowmanville'},
    {name:'Bradford'},
    {name:'Brampton'},
    {name:'Brantford'},
    {name:'Burlington'},
    {name:'Caledon'},
    {name:'Cambridge'},
    {name:'Don Mills'},
    {name:'East Gwillimbury'},
    {name:'East York'},
    {name:'Etobicoke'},
    {name:'Georgetown'},
    {name:'Grimsby'},
    {name:'Guelph'},
    {name:'Halton Hills'},
    {name:'Hamilton'},
    {name:'Innisfil'},
    {name:'King'},
    {name:'Kitchener'},
    {name:'London'},
    {name:'Malton'},
    {name:'Maple'},
    {name:'Markham'},
    {name:'Milton'},
    {name:'Mississauga'},
    {name:'New Tecumseth'},
    {name:'Newmarket'},
    {name:'Niagara Falls'},
    {name:'North York'},
    {name:'Oakville'},
    {name:'Orangeville'},
    {name:'Oshawa'},
    {name:'Pickering'},
    {name:'Port Credit'},
    {name:'Richmond Hill'},
    {name:'Saint Catharines'},
    {name:'Scarborough'},
    {name:'Shelburne'},
    {name:'Stouffville'},
    {name:'Thornhill'},
    {name:'Toronto'},
    {name:'Vaughan'},
    {name:'Waterdown'},
    {name:'Waterloo'},
    {name:'Welland'},
    {name:'Weston'},
    {name:'Whitby'},
    {name:'Woodbridge'},
    {name:'York'},
    {name:'Other'}
  ];

  var contractTypesObjekt = [
    {name:'Full-time'},
    {name:' Part-time'},
    {name:' Permanent'},
    {name:'Temporary'}
  ];

  var workTypesObjekt = [
    {name:'Assistant (Level I)'},
    {name:'Assistant (Level II)'},
    {name:'Orthodontic Assistant (Level I)'},
    {name:'Orthodontic Assistant (Level II)'},
    {name:'Floater (Level I)'},
    {name:'Floater (Level II)'},
    {name:'Hygiene Coordinator'},
    {name:'Office Manager'},
    {name:'Receptionist'},
    {name:'Registered Dental Hygienist'},
    {name:'Orthodontic Hygienist'},
    {name:'Restorative Dental Hygienist'},
    {name:'Treatment Coordinator'}
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

  $scope.provList = provObjekt;
  $scope.genderList = genderObjekt;
  $scope.languageList = languageObjekt;
  $scope.locationList = locationObjekt;
  $scope.contractTypesList = contractTypesObjekt;
  $scope.workTypesList = workTypesObjekt;
  $scope.softwareList = softwareObjekt;

  //Funcationality
  $scope.actionRegister = function(user) {

    $scope.master = angular.copy(user);
	  // console.log('user_type',$scope.master.user.user_type);
    $scope.formState = user.user_type;
    // $scope.formState = 'office';
	
  };

  $scope.actionApplicant = function(user) {
    $scope.master = angular.copy(user);

    $http({
          'method': 'POST',
          'url': '/wp-admin/admin-ajax.php', 
          'params': {
              'action': 'prepDomAction',
              'user_type': $scope.master.user_type,
              'first_name': $scope.master.first_name,
              'last_name': $scope.master.last_name,
              'email_address': $scope.master.email_address,
              'gender': $scope.master.gender.name,
              'primary_phone': $scope.master.primary_phone,
              'secondary_phone': $scope.master.secondary_phone,
              'address': $scope.master.address,
              'city': $scope.master.city,
              'postal_code': $scope.master.postal_code,
              'province': $scope.master.province.name,
              'work_types': $scope.master.work_types,
              'contract_type': $scope.master.contract_type,
              'commute': $scope.master.commute,
              'locations': $scope.master.locations,
              'salary': $scope.master.salary
          }
        }
      )
      .then(function successCallback(response) {
        console.log(response);
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
        console.log(response);
      }, function errorCallback(response) {
        console.log('error: ',response);
      });

  };

    // upload later on form submit or something similar
    $scope.submitFile = function() {
      if ($scope.form.file.$valid && $scope.file) {
        $scope.upload($scope.file);
      }
    };

    // upload later on form submit or something similar
    $scope.emailCheck = function() {
      if ($scope.form.file.$valid && $scope.file) {
        $scope.upload($scope.file);
      }
    };

    // upload on file select or drop
    $scope.upload = function (file) {
        
        Upload.upload({
            url: '/wp-admin/admin-ajax.php', 
            method: 'POST',
            file: file,
            data: {
              targetPath : '/wp-content/plugins/resumes/',
              file: file
            },
            'params': {
              'action': 'fileUpload'
            },
        }).then(function (resp) {
            console.log(resp);
            console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
        }, function (resp) {
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };

  $scope.reset = function() {
    $scope.user = angular.copy($scope.master);
  };

  $scope.reset();
}]);