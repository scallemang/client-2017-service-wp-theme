angular.module('teledent', [])
.controller('RegistrationController', 
    ['$scope', '$http','$window', function($scope, $http, $window) {

  // $scope.ajaxurl = $window.ajaxurl;

  //Initial data states
  $scope.master = {};
  $scope.formState = 'register';
  $scope.provList = [];
  $scope.genderList = [];
  $scope.languageList = [];
  $scope.lcoationList = [];
  $scope.contractTypesList = [];
  $scope.workTypesObjekt = [];
  $scope.softwareObjekt = [];
  
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
	  //ajax - create user, 
    $scope.formState = 'applicant';
	
  };

  $scope.actionApplicant = function(user) {
    $scope.master = angular.copy(user);

    $http({
          'method': 'POST',
          'url': '/wp-admin/admin-ajax.php', 
          'params': {
              'action': 'prepDomAction',
              'first_name': $scope.master.first_name,
              'last_name': $scope.master.last_name,
              'email_address': $scope.master.email_address,
              'gender': $scope.master.gender.name,
              'primary_phone': $scope.master.primary_phone,
              'secondary_phone': $scope.master.secondary_phone,
              'fax': $scope.master.postal_code,
              'street_name': $scope.master.street_name,
              'street_number': $scope.master.street_number,
              'unit_number': $scope.master.unit_number,
              'city': $scope.master.city,
              'province': $scope.master.province.name,
              'postal_code': $scope.master.postal_code
          }
        }
      )
      .then(function successCallback(response) {
        console.log(response);
      }, function errorCallback(response) {
        console.log('error: ',response);
      });

  };

  $scope.reset = function() {
    $scope.user = angular.copy($scope.master);
  };

  $scope.reset();
}]);