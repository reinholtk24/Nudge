var myapp = angular.module("myapp", ["firebase", "ngRoute", "ngSanitize", "textAngular"]);

myapp.config(function ($routeProvider) {
	$routeProvider
		.when('/',
			{
				controller: 'MyController',
				templateUrl: 'assets/partials/admin.html',
			})
		.when('/scenario',
			{
				controller: 'MyController',
				templateUrl: 'assets/partials/scenario.html'
			})
		.otherwise({ redirectTo: '/' });
	
	//$locationProvider.html5Mode(true);

});



myapp.controller('MyController', function($scope, $firebase, $firebaseSimpleLogin, $sanitize) { 
	var ref = new Firebase("https://luminous-fire-6908.firebaseio.com/");

	$scope.scenarios = $firebase(ref).$child("scenarios");
	$scope.narratives = $firebase(ref).$child("narratives");
	$scope.decisionOptions = $firebase(ref).$child("decisionOptions");
	$scope.loginObj = $firebaseSimpleLogin(ref);


//User account management

	$scope.createNewUser = function() {
		console.log($scope.email + ' ' + $scope.password);
		$scope.loginObj.$createUser($scope.email, $scope.password);	
		$scope.email = "";
		$scope.password = "";
	};

	$scope.userLogin = function() {
		$scope.loginObj.$login('password', {
		   email: $scope.email,
		   password: $scope.password
		}).then(function(user) {
		   console.log('Logged in as: ', user.uid);
		}, function(error) {
		   console.error('Login failed: ', error);
		});
		$scope.email = "";
		$scope.password = "";
	};

	$scope.userLogout = function() {
		console.log("userLogout loaded");
		$scope.loginObj.$logout();
		location.reload(); //Need to find a better solution for this
	};
//uid management

	function fauxGuid() { //Generates unique IDs for scenarios, narratives, decisionOptions, etc.
	  function s4() {
		return Math.floor((1 + Math.random()) * 0x10000)
		           .toString(16)
		           .substring(1);
	  }
	  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
		     s4() + '-' + s4() + s4() + s4();
	}


//scenario, narrative, decisionOption management

	$scope.addScenario = function() {
		uid = fauxGuid();

		var url = "https://luminous-fire-6908.firebaseio.com/scenarios/" + uid;
		var myScenario = new Firebase(url);
		
		myScenario.child('id').set(uid);
		myScenario.child('title').set($scope.scenarioTitle);
		myScenario.child('summary').set($scope.scenarioSummary);
		//$scope.scenarios.$add({id: uid, title: $scope.scenarioTitle, summary: $scope.scenarioSummary});
		$scope.scenarioTitle="";
		$scope.scenarioSummary="";

		narrativeUid = fauxGuid();
		var firstFlag = "Y";
		var narrativeUrl = "https://luminous-fire-6908.firebaseio.com/narratives/" + narrativeUid;
		var myNarrative = new Firebase(narrativeUrl);
		myNarrative.child('id').set(narrativeUid);
		myNarrative.child('description').set($scope.firstNarrative);
		myNarrative.child('associatedScenario').set(uid);
		myNarrative.child('firstInScenario').set(firstFlag);

		myScenario.child('firstNarrative').set(narrativeUid);

    };


	$scope.addNarrative = function() {
		uid = fauxGuid();
		var firstFlag = "N";
		var url = "https://luminous-fire-6908.firebaseio.com/narratives/" + uid;
		var myNarrative = new Firebase(url);
		myNarrative.child('id').set(uid);
		myNarrative.child('description').set($scope.story);
		myNarrative.child('associatedScenario').set($scope.selectedScenario);
		myNarrative.child('firstInScenario').set(firstFlag);
		//$scope.narratives.$add({id: uid, description: $scope.story, associatedScenario: $scope.selectedScenario});
		$scope.story = "";
    };


	$scope.addDecisionOption = function() {	
		uid = fauxGuid();
		var url = "https://luminous-fire-6908.firebaseio.com/decisionOptions/" + uid;
		var myDecisionOption = new Firebase(url);
		myDecisionOption.child('id').set(uid);
		myDecisionOption.child('description').set($scope.optionDescription);
		myDecisionOption.child('associatedNarrative').set($scope.mainNarrative.id);
		myDecisionOption.child('nextStep').set($scope.selectNextNarrative.id);
		//$scope.decisionOptions.$add({id: uid, title: $scope.optionTitle, description: $scope.optionDescription, associatedNarrative: $scope.mainNarrative.id, nextStep: $scope.selectNextNarrative.id});
		$scope.optionDescription = "";
    };

	$scope.deleteNarrative = function(narrativeToDelete) {
		var answer = confirm("Are you sure you want to delete this narrative?")
		if (answer){
			var itemRef = new Firebase("https://luminous-fire-6908.firebaseio.com/narratives/" + narrativeToDelete);
			itemRef.remove();
		}
		else{
			return;
		}		
	};

	$scope.deleteScenario = function(scenarioToDelete) {
		var answer = confirm("Are you sure you want to delete this scenario?")
		if (answer){
			var itemRef = new Firebase("https://luminous-fire-6908.firebaseio.com/scenarios/" + scenarioToDelete);
			itemRef.remove();
		}
		else{
			return;
		}		
	};

	$scope.playScenario = function() {
		$scope.scenarioToPlay = this.scenario;

		var narrativeToFind = this.scenario.firstNarrative;
		url = "https://luminous-fire-6908.firebaseio.com/narratives/" + narrativeToFind;
		initialNarrative = new Firebase(url).once('value', function(snap) {			
			$scope.narrativeToPlay = snap.val();
		});

	};

	$scope.setSelected = function() {	
		$scope.mainNarrative = this.narrative;
	};

	$scope.loadNextStep = function() {
		var narrativeToFind = this.decisionOption.nextStep;
		url = "https://luminous-fire-6908.firebaseio.com/narratives/" + narrativeToFind;
		console.log(url);
		nextNarrative = new Firebase(url).once('value', function(snap) {
			console.log('I fetched a narrative!', snap.val());
			$scope.mainNarrative = snap.val();
		});

		//nextNarrative = new Firebase(url).once('value', function(narrativeSnapshot) {
		//	var y = narrativeSnapshot.val();
		//});
		//$scope.mainNarrative = y;

	};
});
