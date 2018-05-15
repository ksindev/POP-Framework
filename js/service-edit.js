/**
 * 
 */
$("#district").on('change', function(){
	var district_id = $("#district").val();
	$.ajax({
		  method: "GET",
		  url: "ajax/locations.php",
		  data: { district_id: district_id }
	}).done(function( result ) {
		  $("#location_area").html(result);
	});
});