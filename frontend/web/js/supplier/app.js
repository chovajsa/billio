var app = angular.module('supplierapp', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2', 'ngModelOnBlur']);

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

// override the default input to update on blur
angular.module('ngModelOnBlur', []).directive('ngModelOnblur', function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        priority: 1, // needed for angular 1.2.x
        link: function(scope, elm, attr, ngModelCtrl) {
            if (attr.type === 'radio' || attr.type === 'checkbox') return;

            elm.unbind('input').unbind('keydown').unbind('change');
            elm.bind('blur', function() {
                scope.$apply(function() {
                    ngModelCtrl.$setViewValue(elm.val());
                });         
            });
        }
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