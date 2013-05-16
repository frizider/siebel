<script type="text/javascript">	
$(document).ready(function() {

	// Search Customer Typeahead/autocomplete
	/*
	$(".search_customer").autocomplete({  
		//define callback to format results  
		source: function(request, response){  
			//pass request to server  
			$.getJSON("<?php echo site_url()?>/typeahead/customers?term=" + encodeURI(request.term), function(data) {  
			   response(data);
			});
		},
		autoFocus: true, 
		minLength: 3
	});
	*/

	$(".search_customer").autocomplete({  
		//define callback to format results  
		source: function(request, response){  
			//pass request to server  
			$.ajax({
				url: "<?php echo site_url('/typeahead/customers')?>",
				cache: false,
				data: "term=" + encodeURI(request.term),
				dataType: "json",
				success: function(data) {
					response(data);
				}
			});
		},
		autoFocus: true, 
		minLength: 3
	});


})
</script>