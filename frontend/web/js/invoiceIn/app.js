
angular.module('euroDate', []).filter('euroDateFilter', function() {
  return function(input) {
    return convertDateFromDb(input);
  };
});


var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2', 'euroDate']);


function notify(type, msg) {
	$('#notify-'+type+' .msg').html(msg);
	$('#notify-'+type).show();
}
 