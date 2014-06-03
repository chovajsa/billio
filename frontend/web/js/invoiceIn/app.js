var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap', 'ngRoute']);

function notify(type = 'success', msg) {
	$('#notify-'+type+' .msg').html(msg);
	$('#notify-'+type).show();
}
