app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  
  // lists
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=invoiceIn/list',
    animation: 'slide'
  }).
  when('/mine', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=invoiceIn/list',
    animation: 'slide'
  }).


  // actions
  when('/new', {
    controller: 'CreateController',
    templateUrl : yiiApp.url + '/template/?route=invoiceIn/update',
    animation: 'slide'
  }).
  when('/update/:id', {
    controller: 'UpdateController',
    templateUrl : yiiApp.url + '/template/?route=invoiceIn/update.php',
    animation: 'slide'
  })
}]);

