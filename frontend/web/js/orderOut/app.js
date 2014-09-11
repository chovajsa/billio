var app = angular.module('orderOut', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2']);

function notify(type, msg) {
	$('#notify-'
		+type+' .msg').html(msg);
	$('#notify-'+type).show();
}
 
app.config(function ($httpProvider) {
  $httpProvider.responseInterceptors.push('myHttpInterceptor');

  var spinnerFunction = function spinnerFunction(data, headersGetter) {
    $("#spinner").show();
    return data;
  };

  $httpProvider.defaults.transformRequest.push(spinnerFunction);
});

app.factory('myHttpInterceptor', function ($q, $window) {
  return function (promise) {
    return promise.then(function (response) {
      $("#spinner").hide();
      return response;
    }, function (response) {
      $("#spinner").hide();
      return $q.reject(response);
    });
  };
});