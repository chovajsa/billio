app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/templates/invoiceIn/list.php',
    animation: 'slide'
  }).
  when('/new', {
    controller: 'CreateController',
    templateUrl : yiiApp.url + '/templates/invoiceIn/update.php',
    animation: 'slide'
  }).
  when('/update/:id', {
    controller: 'UpdateController',
    templateUrl : yiiApp.url + '/templates/invoiceIn/update.php',
    animation: 'slide'
  })
}]);

