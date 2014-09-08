
angular.module('euroDate', []).filter('euroDateFilter', function() {
  return function(input) {
    if(typeof input != 'undefined') {
		date = convertDateFromDb(input.substring(0,10));
		time = input.substring(10);
		return date+""+time;
	}
  };
});


var app = angular.module('orderIn', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2', 'euroDate']);


function notify(type, msg) {
	$('#notify-'+type+' .msg').html(msg);
	$('#notify-'+type).show();
}
 