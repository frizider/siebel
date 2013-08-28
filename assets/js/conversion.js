$(document).ready(function() {
	init();
	$('form input').on('blur', function() {
		init();
	});
});

function init() {
	var basicPrices = getBasicPrices();
	var prices = convertionBasicPrices(basicPrices);
	fillInPrices(prices);
}

function fillInPrices(prices) {
	$('#conversion input').each(function(index, element) {
		var myPrice = 0;
		var names = splitName(element.name);
		$.each(names.basics, function(index, value) {
			var priceKey = value + '_' + names.unit;
			myPrice += parseFloat(prices[priceKey]);
		});
		$(this).val(Number(Math.round(myPrice*100)/100).toFixed(2));
	});
}

function splitName(name) {
	var split = name.split('_');
	var length = split.length;
	var unit = split[length-1];
	split.splice(length-1, 1);
	
	return {
		'basics': split,
		'unit': unit
	};
}

function getBasicPrices() {
	return {
		'weight': $('input[name="weight"]').val(),
		'perim': $('input[name="perim"]').val(),
		'length': $('input[name="length"]').val(),
		'alu_kg': $('input.formuladata').val(),
		'added_value': $('input.added_value').val(),
		'anodprice': $('input[name="anodprice"]').val(),
		'coatprice': $('input[name="coatprice"]').val(),
		'cuttingprice_kg': $('input[name="cuttingprice_kg"]').val(),
		'cuttingprice_pc': $('input[name="cuttingprice_pc"]').val(),
		'insulate_price': $('input[name="insulate_price"]').val(),
		'foilprice': $('input[name="foilprice"]').val(),
		'brushprice': $('input[name="brushprice"]').val(),
		'punchprice': $('input[name="punchprice"]').val()
	};
};

function convertionBasicPrices(basicPrices) {
	// Set weight and length and perim
	var weight = basicPrices.weight;
	var length = basicPrices.length;
	var perim = basicPrices.perim;
	
	// Alu prices
	var alu_kg = basicPrices.alu_kg+basicPrices.added_value;
	var alu_m = convertKgToMeter(alu_kg, weight);
	var alu_pc = convertMeterToPiece(alu_m, length);

	// Cutting prices
	var cuttingPrices = convertCuttingPrices(basicPrices.cuttingprice_kg, basicPrices.cuttingprice_pc, weight, length);
	var cutting_kg = cuttingPrices.cutting_kg;
	var cutting_m = cuttingPrices.cutting_m;
	var cutting_pc = cuttingPrices.cutting_pc;

	// Anod prices
	var anod_kg = convertSqureMeterToKg(basicPrices.anodprice, weight);
	var anod_m = convertSqureMeterToMeter(basicPrices.anodprice, perim);
	var anod_pc = anod_m * length;

	// Coat prices
	var coat_kg = convertSqureMeterToKg(basicPrices.coatprice, weight);
	var coat_m = convertSqureMeterToMeter(basicPrices.coatprice, perim);
	var coat_pc = coat_m * length;
	
	// Foil prices
	var foil_m = basicPrices.foilprice;
	var foil_kg = convertMeterToKg(foil_m, weight);
	var foil_pc = convertMeterToPiece(foil_m, length);
	
	// Brush prices
	var brush_m = basicPrices.foilprice;
	var brush_kg = convertMeterToKg(brush_m, weight);
	var brush_pc = convertMeterToPiece(brush_m, length);
	
	// Punch prices
	var punch_m = basicPrices.foilprice;
	var punch_kg = convertMeterToKg(punch_m, weight);
	var punch_pc = convertMeterToPiece(punch_m, length);
	
	// Punch prices
	var insulate_m = basicPrices.insulate_price;
	var insulate_kg = convertMeterToKg(insulate_m, weight);
	var insulate_pc = convertMeterToPiece(insulate_m, length);
	
	return {
		'alu_kg': alu_kg,
		'alu_m': alu_m,
		'alu_pc': alu_pc,
		'cutting_kg' : cutting_kg,
		'cutting_m' : cutting_m,
		'cutting_pc' : cutting_pc,
		'anod_kg' : anod_kg,
		'anod_m' : anod_m,
		'anod_pc' : anod_pc,
		'coat_kg' : coat_kg,
		'coat_m' : coat_m,
		'coat_pc' : coat_pc,
		'foil_kg' : foil_kg,
		'foil_m' : foil_m,
		'foil_pc' : foil_pc,
		'brush_kg' : brush_kg,
		'brush_m' : brush_m,
		'brush_pc' : brush_pc,
		'punch_kg' : punch_kg,
		'punch_m' : punch_m,
		'punch_pc' : punch_pc,
		'insulate_kg' : insulate_kg,
		'insulate_m' : insulate_m,
		'insulate_pc' : insulate_pc
	};
};

function convertKgToMeter(kiloPrice, weight) {
	if( ! kiloPrice == "" || ! kiloPrice == "undefined" || ! kiloPrice == 0
		|| ! weight == "" || ! weight == "undefined" || ! weight == 0) {
		
		return kiloPrice * weight;
		
	} else {
		return 0;
	}
}

function convertMeterToKg(meterPrice, weight) {
	if( ! meterPrice == "" || ! meterPrice == "undefined" || ! meterPrice == 0
		|| ! weight == "" || ! weight == "undefined" || ! weight == 0) {
		
		return meterPrice / weight;
		
	} else {
		return 0;
	}
}

function convertMeterToPiece(meterPrice, length) {
	if( ! meterPrice == "" || ! meterPrice == "undefined" || ! meterPrice == 0
		|| ! length == "" || ! length == "undefined" || ! length == 0) {
		
		return meterPrice * length;
		
	} else {
		return 0;
	}
}

function convertSqureMeterToKg(squareMeterPrice, weight) {
	if( ! squareMeterPrice == "" || ! squareMeterPrice == "undefined" || ! squareMeterPrice == 0
		|| ! weight == "" || ! weight == "undefined" || ! weight == 0) {
		
		return squareMeterPrice / weight;
		
	} else {
		return 0;
	}
}

function convertSqureMeterToMeter(squareMeterPrice, perim) {
	if( ! squareMeterPrice == "" || ! squareMeterPrice == "undefined" || ! squareMeterPrice == 0
		|| ! perim == "" || ! perim == "undefined" || ! perim == 0) {
		
		return squareMeterPrice * perim;
		
	} else {
		return 0;
	}
}

function convertCuttingPrices(cutting_kg, cutting_pc, weight, length) {
	var cutting_kg = 0;
	var cutting_m = 0;
	var cutting_pc = 0;
	
	if( ! cutting_kg == "" || ! cutting_kg == "undefined" || ! cutting_kg == 0) {
		
		cutting_kg = cutting_kg;
		cutting_m = cutting_kg*weight;
		cutting_pc = cutting_m*length;
		
	} else if( ! cutting_pc == "" || ! cutting_pc == "undefined" || ! cutting_pc == 0) {
		
		cutting_pc = cutting_pc;
		cutting_m = cutting_pc/length;
		cutting_kg = cutting_m/weight;
		
	};

	return {
		'cutting_kg' : cutting_kg,
		'cutting_m' : cutting_m,
		'cutting_pc' : cutting_pc

	};
};

