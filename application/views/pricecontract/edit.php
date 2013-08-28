<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		echo form_hidden('price_id', $item->price_id);
		?>
		
		<h3><?php echo $item->id; ?></h3>
		
		<div class="well">
			<h4><?php echo ucfirst($this->siebel->getLang('date')) ?></h4>
			<div class="row">
				<div class="span6">
					<div class="control-group">
						<label for="date" class="control-label"><?php echo ucfirst($this->siebel->getLang('date')) ?></label>
						<div class="controls">
							<div class="input-append date datepicker" id="datepicker_date" data-date="<?php echo date('d/m/Y',  mysql_to_unix($fields->date['value'])); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="date" value="<?php echo date('d/m/Y',  mysql_to_unix($fields->date['value'])); ?>" id="date" class="date span2">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<div class="control-group">
						<label for="startdate" class="control-label"><?php echo ucfirst($this->siebel->getLang('from')) ?></label>
						<div class="controls">
							<div class="input-append date datepicker" id="datepicker_startdate" data-date="<?php echo date('d/m/Y',  mysql_to_unix($fields->startdate['value'])); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="startdate" value="<?php echo date('d/m/Y',  mysql_to_unix($fields->startdate['value'])); ?>" id="startdate" class="date span2">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="span5">
					<div class="control-group">
						<label for="enddate" class="control-label"><?php echo ucfirst($this->siebel->getLang('until')) ?></label>
						<div class="controls">
							<div class="input-append date datepicker" id="datepicker_enddate" data-date="<?php echo date('d/m/Y',  mysql_to_unix($fields->enddate['value'])); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="enddate" value="<?php echo date('d/m/Y',  mysql_to_unix($fields->enddate['value'])); ?>" id="enddate" class="date span2">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="well">
			<h4><?php echo ucfirst($this->siebel->getLang('price')); ?></h4>
			<div class="row">
				<div class="span6"><?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('price'), 'price', array('class' => 'control-label')), array($fields->price)); ?></div>
				<?php if (isset($item->price_id) && !empty($item->price_id) && $item->price_id != 0 ) { ?>
				<div class="span5"><a class="btn"href="<?php echo site_url('prices/customer/'.$customernumber.'/'.$item->price_id) ?>"><i class="icon-tags"></i> <?php echo $this->siebel->getLang('prices'); ?></a></div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="span6"><?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('lme'), 'lme', array('class' => 'control-label')), array($fields->lme)); ?></div>
				<div class="span5"><?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('premium'), 'premium', array('class' => 'control-label')), array($fields->premium)); ?></div>
			</div>
		</div>
			
		<div class="well">
			<div class="row">
				<div class="span6"><?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('starttonnage'), 'starttonnage', array('class' => 'control-label')), array($fields->starttonnage)); ?></div>
				<div class="span5"><?php echo $this->bootstrap->checkbox(array($this->siebel->getLang('close'), 'closed', array('class' => 'control-label')), 'closed', $fields->closed['value'], array('1' => '')); ?></div>
			</div>
			<div class="row">
				<div class="span6"><?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('correction'), 'lurk', array('class' => 'control-label')), array($fields->lurk)); ?></div>
				<div class="span5"><?php echo $this->bootstrap->checkbox(array($this->siebel->getLang('active'), 'active', array('class' => 'control-label')), 'active', $fields->active['value'], array('1' => '')); ?></div>
			</div>
		</div>
			
		<div class="well">
			<h4><?php echo ucfirst($this->siebel->getLang('comment')); ?></h4>
			<div class="row">
				<div class="span11">
					<div class="control-group">
						<label for="description" class="control-label"><?php echo ucfirst($this->siebel->getLang('comment')) ?></label>
						<div class="controls">
							<?php 
							//echo '<textarea rows="10" name="'.$description['name'].'" id="'.$description['id'].'" class="'.$description['class'].' span9">'.$description['value'].'</textarea>';
							echo $this->ckeditor->editor($fields->comment['name'], $fields->comment['value']);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="well">
			<h4><?php echo ucfirst($this->siebel->getLang('multi_customer')); ?></h4>
			<div class="row">
				<div class="span11">
					<ul id="multiCustomerTags">
						
						<?php
						if(isset($item->multiCust) && !empty($item->multiCust)) {
							foreach($item->multiCust as $multiCust) {
								echo '<li>'.$multiCust.'</li>';
							}
						}
						?>
						
					</ul>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
					<button class="btn">Cancel</button>
					<a class="btn btn-danger pull-right" href="<?php echo site_url($module.'/delete/'.$customernumber.'/'.$id) ?>"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
				</div>
			</div>
		</div>
		
		</form>

	</div>
</div>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/tagit.js" ></script>
<script>

$(document).ready(function() {
	
	$('#multiCustomerTags').tagit({
		fieldName: "multiCust[]", 
		removeConfirmation: true, 
		autocomplete: {  
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
		}
	});

	
});

</script>
