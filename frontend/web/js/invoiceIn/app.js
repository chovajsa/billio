var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2']);

app.run(function() {
  hideLoader();
});

function notify(type, msg) {
	$('#notify-'
		+type+' .msg').html(msg);
	$('#notify-'+type).show();
}

app.config(['$httpProvider', function ($httpProvider) {
    var $http,
        interceptor = ['$q', '$injector', function ($q, $injector) {
            var error;

            function success(response) {
                // get $http via $injector because of circular dependency problem
                $http = $http || $injector.get('$http');
                if($http.pendingRequests.length < 1) {
                    hideLoader();
                }
                return response;
            }

            function error(response) {
                // get $http via $injector because of circular dependency problem
                $http = $http || $injector.get('$http');
                if($http.pendingRequests.length < 1) {
                    hideLoader();
                }
                return $q.reject(response);
            }

            return function (promise) {
                showLoader();
                return promise.then(success, error);
            }
        }];

    $httpProvider.responseInterceptors.push(interceptor);
}]);

app.filter('startFrom', function () {
    return function (input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});



function showLoader() {
  $('#page-container').addClass('fade');

  $('#page-loader').removeClass('hide');
  $('#page-loader').show();
}

function hideLoader() {
  $('#page-container').removeClass('fade');
  $('#content').removeClass('fade');
  $('#page-loader').hide();
}