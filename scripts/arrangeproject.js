$(function() {
	$( '#sortable' ).sortable();
	$( '#sortable' ).disableSelection();
	$('#updateOrder').click(function(){
		updateOrder();
	});
});

function updateOrder(){
	var sortedIDs = $( '#sortable' ).sortable( 'toArray' )
	console.log(sortedIDs);

	$.ajax({
		type: 'POST',
		url: 'updateorder',
		dataType: 'text',
		data: {
			'action': 'updateorder',
			'newOrder': sortedIDs,
		},
		success: function(msg){
		alert('Home page successfully reorganised. You will now be redirected.');
		window.location.href = "/adminhome";

		}
	});
}