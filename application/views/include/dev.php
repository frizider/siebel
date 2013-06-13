<?php 
$defined_vars = get_defined_vars();
$defined_vars = $defined_vars['this']->_ci_cached_vars; 
$txt_class_resuest = (isset($_REQUEST) && !empty($_REQUEST)) ? "txt_blue" : "txt_gray" ;
?>

<div class="row">
	<div class="span12">
		<div class="accordion" id="devaccordion">
			
			<?php if(isset($defined_vars) && !empty($defined_vars)) { ?>
			
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseData">
						Data
					</a>
				</div>
				<div id="collapseData" class="accordion-body collapse" style="height: 0px;">
					<div class="accordion-inner">
						<?php dev($defined_vars); ?>
					</div>
				</div>
			</div>
			
			<?php 
			}
			if(isset($_REQUEST) && !empty($_REQUEST)) {
			?>
			
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseRequest">
						Post
					</a>
				</div>
				<div id="collapseRequest" class="accordion-body collapse" style="height: 0px;">
					<div class="accordion-inner">
						<?php dev($_REQUEST); ?>
					</div>
				</div>
			</div>
			
			<?php } ?>
			
		</div>
	</div>
</div>