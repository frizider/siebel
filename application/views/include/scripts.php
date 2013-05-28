<script type="text/javascript">	
$(document).ready(function() {

	// Search Customer Typeahead/autocomplete
	$("#search").autocomplete({  
		//define callback to format results  
		source: function(request, response){  
			//pass request to server  
			$.ajax({
				url: "<?php echo site_url('/search')?>",
				cache: false,
				data: {term: encodeURI(request.term)},
				data: "term=" + encodeURI(request.term),
				dataType: "json",
				success: function(data) {
					response(data);
				}
			});
		},
		autoFocus: true, 
		minLength: 3, 
		messages: {
			noResults: '',
			results: function() {}
		}, 
		 position: { my : "right top", at: "right bottom" }
	})
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a href=\"<?php echo site_url('dashboard/customer') ?>/"+item.value+"\"><strong>" + item.label + "</strong><small class=\"pull-right\">" + item.value + "</small><br>" + item.address + "</a>" )
        .appendTo( ul );
    };


})
</script>