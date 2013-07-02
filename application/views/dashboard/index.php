<?php
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
?>
<hr/>
<div class="row-fluid" id="dashboard">
	
	<div class="span6 column">
		<div class="row-fluid sortrow">
			<?php
			if(!empty($userDashboard[1]))
			{
				foreach ($userDashboard[1] as $widget)
				{
					if(array_key_exists($widget[0].'__'.$widget[1], $widgets))
					{
						widget::run($widget[0], $widget[1], 'row-fluid'); 
						unset($widgets[$widget[0].'__'.$widget[1]]);
					}
				}
			}
			?> 
		</div>
		<div class="clear"></div>
	</div>

	<div class="span3 column">
		<div class="row-fluid sortrow">
			<?php
			if(!empty($userDashboard[2]))
			{
				foreach ($userDashboard[2] as $widget)
				{
					if(array_key_exists($widget[0].'__'.$widget[1], $widgets))
					{
						widget::run($widget[0], $widget[1], 'row-fluid'); 
						unset($widgets[$widget[0].'__'.$widget[1]]);
					}
				}
			}
			?> 
		</div>
		<div class="clear"></div>
	</div>

	<div class="span3 column">
		<div class="row-fluid sortrow">
			<?php
			if(!empty($userDashboard[3]))
			{
				foreach ($userDashboard[3] as $widget)
				{
					if(array_key_exists($widget[0].'__'.$widget[1], $widgets))
					{
						widget::run($widget[0], $widget[1], 'row-fluid'); 
						unset($widgets[$widget[0].'__'.$widget[1]]);
					}
				}
			}
			?> 
		</div>
		<div class="clear"></div>
	</div>
</div>
<hr/>
<div class="row-fluid" id="dashboard2">
	<div class="span8 column">
		<div class="row-fluid sortrow">
			<?php
			// Load the rest of the widgets
			if(!empty($widgets))
			{
				foreach ($widgets as $widget)
				{
					widget::run($widget[0], $widget[1], 'row-fluid'); 
				}
			}
			?> 
		</div>
	</div>
</div>


<script>
$(function() {
	$( ".column > .sortrow" ).sortable({
		connectWith: ".column > .sortrow", 
		items: ".widget", 
		opacity: 0.5,
		cursor: "move", 
		cursorAt: { right: 5, top: 5 }, 
		handle: ".move", 
		revert: true, 
		tolerance: "pointer",
		placeholder: "ui-placeholder"
		}
	);
	
	var newSorting = '';
	
	$( "#dashboard, #dashboard2" ).on( "sortstop", function( event, ui ) {
		$(".column > .sortrow").each(function() {
			newSorting += $(this).sortable("toArray", { attribute: 'data-id' })+'||';
		});
		console.log(newSorting);
		$.post('<?php echo site_url() ?>/dashboard/saveUserDashboard', {sort:newSorting}, function() {
			newSorting = '';
		});
	});
	
	$( ".widget" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix" )
		.find( ".widget .header" )
		.addClass( "ui-widget-header" )
		.end()
		.find( ".widget .content" );

	$( ".column > .sortrow" ).disableSelection();
});

</script>