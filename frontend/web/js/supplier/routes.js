app.config(['$routeProvider',
function($routeProvider) {

$routeProvider.
  
  // lists
  when('/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=supplier/list',
    animation: 'slide'
  }).
  
  when('/search/', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=supplier/list',
    animation: 'slide'
  }).
  when('/search/:fulltext', {
    controller: 'ListController',
    templateUrl : yiiApp.url + '/template/?route=supplier/list',
    animation: 'slide'
  })

}]);

