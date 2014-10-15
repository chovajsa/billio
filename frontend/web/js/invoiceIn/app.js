var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap', 'ngRoute', 'ui.select2']);

app.run(function() {
  hideLoader();
});

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

function showLoader() {
  $('#content').addClass('fade');
  $('#page-loader').show();
}

function hideLoader() {
  $('#content').removeClass('fade');
  $('#page-loader').hide();
}
