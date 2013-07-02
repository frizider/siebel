<?php
//dev($price);
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
		?>
		<input type="hidden" id="formula_data" class="span10" name="formula_data" value="" />
	
		<div class="row">
			<div class="span5 offset7">
				<?php 
				$field = 'price';
				$value = array(
					'name' => $field,
					'id' => $field,
					'class' => $field.' disabled',
					'type' => 'text',
					'value' => $price->$field,
					'disabled' => 'disabled'
				);
				echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>&euro;</span>');
				?>
			</div>
		</div>

		<div class="well">
			<div class="row">
				<div class="span4">
					<?php 
					$field = 'formula_id';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field,
						'type' => 'text',
						'value' => $price->$field,
					);
					$label = $this->siebel->getLang('formula');
					$name = (isset($value['value']) && !empty($value['value'])) ? $this->siebel->getFormula($price->formula_id)->formulaname : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, $label, $name, $field, $dropdown_formulas, FALSE, FALSE, $value['value']);
					?>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="date" class="control-label"><?php echo $this->siebel->getLang('date') ?></label>
						<div class="controls">
							<div class="input-append date" id="datepicker" data-date="<?php echo date('d/m/Y',  mysql_to_unix($price->date)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="date" value="<?php echo date('d/m/Y',  mysql_to_unix($price->date)); ?>" id="date" class="date span2">
								<span class="add-on"><i class="icon-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="span3">
					<?php 
					$field = 'priceunit_id';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field.' span1',
						'type' => 'text',
						'value' => $price->$field,
					);
					$label = $this->siebel->getLang('priceunit');
					$name = (isset($value['value']) && !empty($value['value'])) ? $this->siebel->getLang('priceunit_'.$price->priceunit) : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, $label, $name, $field, $dropdown_priceunits, FALSE, FALSE, $value['value']);
					?>
				</div>
			</div>
			<hr/>
			<div class="row" id="formuladata">
				<div class="span11">
				<?php
				$formula = $this->siebel->formula_to_array($price->formula_string);
				$formula_data = ($price->formula_data) ? $this->siebel->formula_to_array($price->formula_data) : 0;
				for ($i = 0; $i < count($formula); $i++)
				{
					$key = $formula[$i][0];
					$name= $formula[$i][1];
					$value = ($formula_data) ? $formula_data[$i][0] : '';
					
					echo '<div class="pull-left formula-box block_'.$i.'">';
					switch ($key) {
						case 'value':
							echo '<label>'.$name.'</label><input type="text" class="formuladata span1" data-value="'.$value.'" value="'.$value.'" /> ';
							break;
						
						case 'fix':
							echo '<label>&nbsp;</label><span class="formuladata" data-value="'.$name.'">'.$name.'</span>';
							break;
						
						case 'lme':
							echo '<label>'.$name.'</label><span class="formuladata" data-name="'.$name.'" data-value="'.$value.'"><span>'.$value.'</span> <i data-name="block_'.$i.'" data-type="'.$name.'" class="icon-edit" id="editLme"></i></span>';
							break;
						
						case 'weight':
							echo '<label>&nbsp;</label><span class="formuladata" data-value="'.$value.'">'.$value.'</span>';
							break;
						
						case 'perimeter':
							echo '<label>&nbsp;</label><span class="formuladata" data-value="'.$value.'">'.$value.'</span>';
							break;
						
						case 'arithmetic':
							echo '<label>&nbsp;</label><span class="formuladata" data-value="'.$name.'">'.$name.'</span>';
							break;
						
						default:
							break;
					}
					echo '</div>';
					
				}
				?>
				</div>
			</div>
		</div>
		<div class="well">
			<div class="row">
				<div class="span3">
					<?php 
					$field = 'profile';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field.' span1',
						'type' => 'text',
						'value' => $price->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>AL</span>');
					?>
				</div>
				<div class="span4">
					<?php 
					$field = 'finish';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field.'',
						'type' => 'text',
						'value' => $price->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value));
					?>
				</div>
				<div class="span3">
					<?php 
					$field = 'length';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field.' span1',
						'type' => 'text',
						'value' => $price->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, '<span class=add-on>m</span>');
					?>
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
						'value' => $price->$field,
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
		<a href="<?php echo site_url('prices/delete/'.$customernumber.'/'.$id) ?>" class="btn btn-danger"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
	</div>
</div>

<div class="modal fade" id="editLmeModal">
	<div class="modal-body">
		<a class="close" data-dismiss="modal">×</a>
		<div class="input-append date" id="datepicker2" data-date="<?php echo date('d/m/Y',  mysql_to_unix($price->date)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
			<input type="text" value="<?php echo date('d/m/Y',  mysql_to_unix($price->date)); ?>" id="date" class="date span2">
			<span class="add-on"><i class="icon-calendar"></i></span>
		</div>
		<button class="btn btn-primary save" type="button"><i class="icon-ok icon-white"></i></button>
	</div>
</div>

<script>

$(function() {
	
	$('#datepicker2').datepicker();

	// Trigger for modal to edit the value of a block
	$("#formuladata").on("click", "i#editLme", function() {
		$('#editLmeModal .save').data('name', $(this).data('name'));
		$('#editLmeModal .save').data('type', $(this).data('type'));
		$('#editLmeModal').modal();
	});

	// Trigger for modal to edit the value of a block
	$('#editLmeModal').on('click', '.save', function() {
		var id = $(this).data('name');
		var lmeDate = $('#editLmeModal input#date').val();
		var lmeType = ($(this).data('type') == 'LME-cash') ? 'cash' : 'mth';
		$.post('<?php echo site_url() ?>/lme/lme', {date:lmeDate, type:lmeType}, function(data) {
			console.log(data);
			$('div.'+id+' span').data('value', data);
			$('div.'+id+' span span').text(data);
			$('#editLmeModal').modal('hide')
		});
	})


	$('form').submit(function(e) {
		//e.preventDefault();
		$('input.formuladata').each(function(i, element) {
			$(this).data('value', $(this).val());
		});
		var container = $('input#formula_data');
		var newFormula = '';
		$('.formuladata').each(function(i, element) {
			var string = $(element).data('value')+'||';
			newFormula += string;
		});

		container.val(newFormula)
		
	})
	
})

</script>

