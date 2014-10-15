var app = angular.module('supplierapp', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2']);

function notify(type, msg) {
	$('#notify-'
		+type+' .msg').html(msg);
	$('#notify-'+type).show();
}

loadingQueue = {

  inQueue:0,

  push:function() {
    this.inQueue++;
    showLoader();
  },

  remove:function() {
    this.inQueue--;
    if (this.inQueue == 0) hideLoader();
  }

}

app.config(function ($httpProvider) {
  $httpProvider.responseInterceptors.push('myHttpInterceptor');

  var spinnerFunction = function spinnerFunction(data, headersGetter) {
    loadingQueue.push();
    return data;
  };

  $httpProvider.defaults.transformRequest.push(spinnerFunction);
});

app.factory('myHttpInterceptor', function ($q, $window) {
  return function (promise) {
    return promise.then(function (response) {
      loadingQueue.remove();
      return response;
    }, function (response) {
   
      return $q.reject(response);
    });
  };
});


function showLoader() {
  $('#content').addClass('fade');
  $('#page-loader').show();
}

function hideLoader() {
  $('#content').removeClass('fade');
  $('#page-loader').hide();
}