angular.module('euroDate', []).filter('euroDateFilter', function() {
  return function(input) {
    return convertDateFromDb(input);
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
 