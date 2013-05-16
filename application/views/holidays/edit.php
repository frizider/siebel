<?php
//dev($item);
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_holiday'), $customerName. ' | '. $customernumber, '<a class="backbutton" title="Go back" href="'.site_url('holidays/customer/'.$customernumber).'"><span><i class="icon-chevron-left"></i></span></a> '); 
?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		?>

		<div class="well">
			<div class="row">
				<div class="span6">
					<div class="control-group">
						<label for="date" class="control-label"><?php echo $this->siebel->getLang('from') ?></label>
						<div class="controls">
							<div class="input-append date" id="datepicker" data-date="<?php echo date('d/m/Y',  mysql_to_unix($item->from)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="from" value="<?php echo date('d/m/Y',  mysql_to_unix($item->from)); ?>" id="from" class="date span2">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="span5">
					<div class="control-group">
						<label for="date" class="control-label"><?php echo $this->siebel->getLang('until') ?></label>
						<div class="controls">
							<div class="input-append date" id="datepicker2" data-date="<?php echo date('d/m/Y',  mysql_to_unix($item->until)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="until" value="<?php echo date('d/m/Y',  mysql_to_unix($item->until)); ?>" id="until" class="date span2">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span11">
					<?php 
					$field = 'comment';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field.' span9',
						'type' => 'text',
						'value' => $item->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value));
					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
					<button class="btn">Cancel</button>
					<a class="btn btn-danger pull-right" data-target="#delete" data-toggle="modal"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
				</div>
			</div>
		</div>
		
		</form>

	</div>
</div>

<div class="modal fade" id="delete">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3><?php echo ucfirst($this->siebel->getLang('delete')); ?></h3>
	</div>
	<div class="modal-body">
		<p><?php echo $this->siebel->getLang('delete_sure'); ?></p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal"><?php echo ucfirst($this->siebel->getLang('cancel')); ?></a>
		<a href="<?php echo site_url('holidays/delete/'.$customernumber.'/'.$id) ?>" class="btn btn-danger"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
	</div>
</div>

<script>

$(function() {

})

</script>

