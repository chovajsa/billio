app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  
  // lists
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=supplier/list',
    animation: 'slide'
  })

}]);

