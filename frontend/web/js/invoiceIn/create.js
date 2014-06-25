app.controller('CreateController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$controller', function (scope, AI, SI, routeParams, modal, $controller) {

    $controller('UpdateController', {$scope:scope});

    scope.mode = 'create';
    scope.newSupplier = {};
    scope.counter = 0;

    $('#attachmentsFrame').attr('src', yiiApp.url+'/invoice-in/attachments');

    var turl = yiiApp.url+'/template?route=supplier/create';

}]);