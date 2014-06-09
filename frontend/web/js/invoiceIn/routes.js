app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=invoiceIn/list',
    animation: 'slide'
  }).
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

