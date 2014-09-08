app.controller('CreateController', ['$scope', 'OrdersOut', 'Supplier', '$routeParams', '$modal', '$controller', function (scope, AI, SI, routeParams, modal, $controller) {

    $controller('UpdateController', {$scope:scope});

    scope.mode = 'create';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.currentInvoice = {
        rows:[],
        supplier:false
    };

    $('#attachmentsFrame').attr('src', yiiApp.url+'/order-out/attachments');

    var turl = yiiApp.url+'/template?route=supplier/create';

}]);