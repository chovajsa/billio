app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  
  // lists
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=orderIn/list',
    animation: 'slide'
  }).
  when('/mine', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=orderIn/list',
    animation: 'slide'
  }).


  // actions
  when('/new', {
    controller: 'CreateController',
    templateUrl : yiiApp.url + '/template/?route=orderIn/update',
    animation: 'slide'
  }).
  when('/update/:id', {
    controller: 'UpdateController',
    templateUrl : yiiApp.url + '/template/?route=orderIn/update.php',
    animation: 'slide'
  })
}]);

