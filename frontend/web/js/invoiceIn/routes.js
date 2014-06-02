app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/templates/invoiceIn/list.php'
  }).
  when('/new', {
    controller: 'CreateController',
    templateUrl : yiiApp.url + '/templates/invoiceIn/update.php'
  })
}]);

