app.filter('euroDateFilter', function() {
  return function(input) {
	if(typeof input != 'undefined') {
		date = convertDateFromDb(input.substring(0,10));
		time = input.substring(10);
		return date+""+time;
	}
  };
});

app.filter('dateFromDb', function() {
  return function(input) {
    if (input !== null) 
        return convertDateFromDb(input);
  };
});

app.filter('dateToDb', function() {
  return function(input) {
    if (input !== null) 
        return convertDateToDb(input);
  };
});

app.filter('preciseRound', function() {
	return function(input) {
		if(typeof input != 'undefined') {
			decimals = 2;
			var x = (Math.round(input * Math.pow(10, decimals)) / Math.pow(10, decimals)).toFixed(decimals);
			if (isNaN(x)) return "0.00";
			return x;
		} else {
			return "0.00";
		}
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