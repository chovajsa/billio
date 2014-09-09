
var app = angular.module('orderIn', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2']);


function notify(type, msg) {
	$('#notify-'+type+' .msg').html(msg);
	$('#notify-'+type).show();
}
 