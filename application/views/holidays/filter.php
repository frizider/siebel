<?php
echo form_open(current_url(), array('class' => 'form-horizontal'));

echo '<div class="well">';
echo '<div class="row">';
echo '<div class="span6">';

$fieldname = 'customernumber';
$field = array(
	'name' => $fieldname,
	'class' => $fieldname,
	'id' => $fieldname,
	'type' => 'text',
	'value' => (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) ? $_POST[$fieldname] : '',
);
echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($fieldname), $fieldname, array('class' => 'control-label')), array($field));

echo '</div>';

echo '</div>';
echo '<div class="row">';

echo '<div class="span6">';

$fieldname = 'from';
$field = array(
	'name' => $fieldname,
	'class' => $fieldname,
	'id' => $fieldname,
	'type' => 'text',
	'value' => (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) ? $_POST[$fieldname] : '',
);
echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($fieldname), $fieldname, array('class' => 'control-label')), array($field));

echo '<span class="txt-red">Date format = DD/MM/YYYY</span>';
echo '</div>';
echo '<div class="span5">';

$fieldname = 'until';
$field = array(
	'name' => $fieldname,
	'class' => $fieldname,
	'id' => $fieldname,
	'type' => 'text',
	'value' => (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) ? $_POST[$fieldname] : '',
);
echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($fieldname), $fieldname, array('class' => 'control-label')), array($field));

echo '</div>';
echo '</div>';
echo '</div>';
?>
<div class="row">
	<div class="span12">
		<div class="form-actions">
			<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('search')); ?></button>
		</div>
	</div>
</div>

</form>

<script type="text/javascript">	
$(document).ready(function() {

	// Search Customer Typeahead/autocomplete
	$(".customernumber").autocomplete({  
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
	});

});
</script>
