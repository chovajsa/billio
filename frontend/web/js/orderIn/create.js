app.controller('CreateController', ['$scope', 'OrdersIn', 'Supplier', '$routeParams', '$modal', '$controller', function (scope, AI, SI, routeParams, modal, $controller) {

    $controller('UpdateController', {$scope:scope});

    scope.mode = 'create';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.currentOrder = {
        rows:[]
    };

    $('#attachmentsFrame').attr('src', yiiApp.url+'/order-in/attachments');

    var turl = yiiApp.url+'/template?route=supplier/create';

}]);