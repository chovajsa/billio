var l = [];

angular.module('euroDate', []).filter('euroDateFilter', function() {
  return function(input) {
    return convertDateFromDb(input);
  };
});


var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap', 'ngRoute','nya.bootstrap.select', 'euroDate']);


function notify(type = 'success', msg) {
	$('#notify-'+type+' .msg').html(msg);
	$('#notify-'+type).show();
}
