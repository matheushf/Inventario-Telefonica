/**
 * 
 */

$(function() {
	var that = this;
	var toolitup = $(".medico").jRate({
		startColor : 'yellow',
		endColor : 'red',
		rating : 1,
		strokeColor : 'black',
		precision : 1,
		minSelected : 1,
		onChange : function(rating) {
//			 console.log("OnChange: Rating: "+rating);
		},
		onSet : function(rating) {
			console.log("OnSet: Rating: " + rating);
			$("#medico").val(rating);
		}
	});

	$('#btn-click').on('click', function() {
		toolitup.setRating(0);
	});

});

$(function() {
	var that = this;
	var toolitup = $(".equipe").jRate({
		startColor : 'yellow',
		endColor : 'red',
		rating : 1,
		strokeColor : 'black',
		precision : 1,
		minSelected : 1,
		onChange : function(rating) {
			// console.log("OnChange: Rating: "+rating);
		},
		onSet : function(rating) {
			console.log("OnSet: Rating: " + rating);
			$("#equipe").val(rating);
		}
	});

	$('#btn-click').on('click', function() {
		toolitup.setRating(0);
	});

});

$(function() {
	var that = this;
	var toolitup = $(".horario").jRate({
		startColor : 'yellow',
		endColor : 'red',
		rating : 1,
		strokeColor : 'black',
		precision : 1,
		minSelected : 1,
		onChange : function(rating) {
			// console.log("OnChange: Rating: "+rating);
		},
		onSet : function(rating) {
			console.log("OnSet: Rating: " + rating);
			$("#horario").val(rating);
		}
	});

	$('#btn-click').on('click', function() {
		toolitup.setRating(0);
	});

});