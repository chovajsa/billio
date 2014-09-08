angular.module('euroDate', []).filter('euroDateFilter', function() {
  return function(input) {
    date = convertDateFromDb(input.substring(0,10));
	time = input.substring(10);
    //return date+""+time;
	return date+""+time;
  };
});


var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2', 'euroDate']);


app.filter('dateFromDb', function() {
  return function(input) {
    if (input !== null) 
        return convertDateFromDb(input);
  };
});


function convertDateFromDb(d) {
    if (d == null) return '';
    var from = d.split("-");
    // var dateObject = new Date(from[2], from[1] - 1, from[0]);
    return from[2]+'.'+from[1]+'.'+from[0];
}

function convertDateToDb(d) {
    if (d == null) return '';
    var from = d.split(".");
    // var dateObject = new Date(from[2], from[1] - 1, from[0]);
    return from[2]+'-'+from[1]+'-'+from[0];
}

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