app.factory('InvoicesIn', function ($resource) {
    var data = $resource(yiiApp.url + '/api/invoice-in/:id', {
        id: '@id'
    }, {
        query: {
            isArray:false
        },
        getInvoice: {
            method: 'GET',
            params: {
                number: 0
            }
        },
        createInvoice: {
            method: 'POST',
            params: 0
        },

        updateInvoice: {
            method: 'PUT',
            params: 0  
        },

        deleteInvoice: {
            method: 'DELETE',
            params: 0    
        }
    });
    return data;
});



app.factory('Supplier', function ($resource) {
    var data =  $resource(yiiApp.url + '/api/supplier/:number', {
        number: '@number'
    }, {
        query: {
            isArray:false
        },
        getSupplier: {
            method: 'GET',
            params: {
                number: 0
            }
        },
        createSupplier: {
            method: 'POST',
            params: 0
        },
    });
    return data;
});

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