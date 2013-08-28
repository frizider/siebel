<?php
//dev($price);
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
?>

<div class="row">
	<div class="span12">

		<?php
		echo form_open(current_url(), $form_attributes);
		echo form_hidden('weight', $price->weight);
		echo form_hidden('perim', $price->perim);
		?>
		<input type="hidden" id="formula_data" class="span10" name="formula_data" value="" />

		<div class="row">
			<div class="pull-right">
				<?php
				if(isset($price->prefer_priceunit)) {
					$totalprice_append = '<span class=add-on>/'.$this->siebel->getLang('priceunit_' . $price->prefer_priceunit).'</span>';
				} else {
					$totalprice_append = '<span class=add-on>/</span>';
				}
				
				if(isset($price->totalprice)) {
					$totalprice = $price->totalprice;
				} else {
					$totalprice = '';
				}
				
				$field = 'totalprice';
				$value = array(
					'name' => $field,
					'id' => $field,
					'class' => $field . ' disabled span2',
					'type' => 'text',
					'value' => number_format(floatval($totalprice), 2),
					'disabled' => 'disabled'
				);
				echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, $totalprice_append, '<span class=add-on>&euro;</span>');
				?>
			</div>
		</div>
		
		<h3><?php echo ucfirst($this->siebel->getLang('formula')); ?></h3>
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
							<div class="input-append date " id="datepicker" data-date="<?php echo date('d/m/Y', mysql_to_unix($price->date)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
								<input type="text" name="date"  value="<?php echo date('d/m/Y', mysql_to_unix($price->date)); ?>" id="date" class="date span2">
								<span class="add-on "><i class="icon-calendar"></i></span>
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
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => $price->$field,
					);
					$label = $this->siebel->getLang('priceunit');
					$name = (isset($value['value']) && !empty($value['value'])) ? $this->siebel->getLang('priceunit_' . $price->priceunit) : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, $label, $name, $field, $dropdown_priceunits, FALSE, FALSE, $value['value']);
					?>
				</div>
			</div>
			<hr/>
			<div class="row" id="formuladata">
				<div class="span9">
					<?php
					$formula = $this->siebel->formula_to_array($price->formula_string);
					$formula_data = ($price->formula_data) ? $this->siebel->formula_to_array($price->formula_data) : 0;
					$formula_price = $this->siebel->formula_to_plain($price->formula_data, 0);
					$formula_price = (isset($formula_price) && !empty($formula_price)) ? $this->siebel->math($formula_price) : '';
					for ($i = 0; $i < count($formula); $i++) {
						$key = $formula[$i][0];
						$name = $formula[$i][1];
						$value = ($formula_data) ? $formula_data[$i][0] : '';

						echo '<div class="pull-left formula-box block_' . $i . '">';
						switch ($key) {
							case 'value':
								echo '<label>' . $name . '</label><input type="text" class="formuladata span1" data-value="' . $value . '" value="' . number_format(floatval($value), 2) . '" /> ';
								break;

							case 'fix':
								echo '<label>&nbsp;</label><span class="formuladata" data-value="' . $name . '">' . $name . '</span>';
								break;

							case 'lme':
								echo '<label>' . $name . '</label><span class="formuladata" data-name="' . $name . '" data-value="' . $value . '"><span>' . $value . '</span> <i data-name="block_' . $i . '" data-type="' . $name . '" class="icon-edit" id="editLme"></i></span>';
								break;

							case 'weight':
								echo '<label>&nbsp;</label><span class="formuladata" data-value="' . $price->weight . '">' . $price->weight . '</span>';
								break;

							case 'perimeter':
								echo '<label>&nbsp;</label><span class="formuladata" data-value="' . $price->perim . '">' . $price->perim . '</span>';
								break;

							case 'arithmetic':
								echo '<label>&nbsp;</label><span class="formuladata" data-value="' . $name . '">' . $name . '</span>';
								break;

							default:
								break;
						}
						echo '</div>';
					}
					?>
				</div>
				<div class="pull-right">
					<?php
					if(isset($price->priceunit)) {
						$price_append = '<span class=add-on>/'.$this->siebel->getLang('priceunit_' . $price->priceunit).'</span>';
					} else {
						$price_append = '<span class=add-on>/</span>';
					}

					if(isset($price->totalprice)) {
						$totalprice = $price->totalprice;
					} else {
						$totalprice = '';
					}
					?>
					<br>
					<div class=" input-append input-prepend">
						<span class="add-on">= €</span>
						<input type="text" name="price" value="<?php echo number_format(floatval($price->price), 2); ?>" id="price" class="price span2 disabled" disabled="disabled">
						<?php echo $price_append; ?>
					</div>
				</div>
			</div>
		</div>
		
		<h3><?php echo ucfirst($this->siebel->getLang('attributes')); ?></h3>
		<div class="well">
			<div class="row">
				<div class="span3">
					<?php
					$field = 'profile';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span2',
						'type' => 'text',
						'value' => $price->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE);
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'length';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 3),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, '<span class=add-on>m</span>');
					?>

				</div>
				<div class="span4">
					<?php
					$field = 'prefer_priceunit_id';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => $price->$field,
					);
					$label = $this->siebel->getLang('prefer_priceunit');
					$name = (isset($value['value']) && !empty($value['value'])) ? $this->siebel->getLang('priceunit_' . $price->prefer_priceunit) : $this->siebel->getLang('choose');
					echo $this->bootstrap->dropdown(FALSE, $label, $name, $field, $dropdown_priceunits, FALSE, FALSE, $value['value']);
					?>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<?php
					$field = 'added_value';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="anodprice" class="control-label"><?php echo $this->siebel->getLang('anodprice'); ?></label>
						<div class="controls">
							<div class=" input-prepend">
								<span class="add-on">€</span>
								<?php
								$field = 'anodprice';
								$value = array(
									'name' => $field,
									'id' => $field,
									'class' => $field . ' span1',
									'type' => 'text',
									'value' => number_format(floatval($price->$field), 2),
								);
								echo form_input($value);
								$field = 'anodtype';
								$value = array(
									'name' => $field,
									'id' => $field,
									'class' => $field . ' span1',
									'type' => 'text',
									'value' => $price->$field,
								);
								echo form_input($value);
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="coatprice" class="control-label"><?php echo $this->siebel->getLang('coatprice'); ?></label>
						<div class="controls">
							<div class=" input-prepend">
								<span class="add-on">€</span>
								<?php
								$field = 'coatprice';
								$value = array(
									'name' => $field,
									'id' => $field,
									'class' => $field . ' span1',
									'type' => 'text',
									'value' => number_format(floatval($price->$field), 2),
								);
								echo form_input($value);
								$field = 'coatcolor';
								$value = array(
									'name' => $field,
									'id' => $field,
									'class' => $field . ' span1',
									'type' => 'text',
									'value' => $price->$field,
								);
								echo form_input($value);
								?>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="span3">
					<?php
					$field = 'cuttingprice_kg';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'cuttingprice_pc';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'insulate_price';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<?php
					$field = 'foilprice';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'brushprice';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'punchprice';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<?php
					$field = 'lme';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'premium';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
				<div class="span4">
					<?php
					$field = 'markup';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => number_format(floatval($price->$field), 2),
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value), FALSE, FALSE, '<span class=add-on>€</span>');
					?>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<?php
					$field = 'pricecontract_id';
					$value = array(
						'name' => $field,
						'id' => $field,
						'class' => $field . ' span1',
						'type' => 'text',
						'value' => $price->$field,
					);
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value));
					?>
				</div>
			</div>
		</div>

		<div class="well">
			<h4><?php echo ucfirst($this->siebel->getLang('comment')); ?></h4>
			<div class="row">
				<div class="span11">
					<div class="control-group">
						<label for="comment" class="control-label"><?php echo ucfirst($this->siebel->getLang('comment')) ?></label>
						<div class="controls">
							<?php 
							//echo '<textarea rows="10" name="'.$description['name'].'" id="'.$description['id'].'" class="'.$description['class'].' span9">'.$description['value'].'</textarea>';
							echo $this->ckeditor->editor('comment', $price->comment);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
					<button class="btn">Cancel</button>
					<?php if( $price->pricecontract_id == 0 || empty($price->pricecontract_id) ) { ?>
					<a class="btn btn-danger pull-right" href="<?php echo site_url($module . '/delete/' . $customernumber . '/' . $id) ?>"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
					<?php } ?>
					
				</div>
			</div>
		</div>

		</form>

		<div class="well" id="conversion">
			<h3>
				<?php echo ucfirst($this->siebel->getLang('conversion')); ?>
				<small id="visibles" class="float-right form-inline">
					<input type="checkbox" name="alubox" id="alubox" value="1" checked="checked" />
					<label for="alubox">alu</label>  | 
					<input type="checkbox" name="cuttingbox" id="cuttingbox" value="1" checked="checked" />
					<label for="cuttingbox">cutting</label> | 
					<input type="checkbox" name="anodbox" id="anodbox" value="1" checked="checked" />
					<label for="anodbox">anod</label> | 
					<input type="checkbox" name="coatbox" id="coatbox" value="1" checked="checked" />
					<label for="coatbox">coat</label> | 
					<input type="checkbox" name="foilbox" id="foilbox" value="1" checked="checked" />
					<label for="foilbox">foil</label> | 
					<input type="checkbox" name="brushbox" id="brushbox" value="1" checked="checked" />
					<label for="brushbox">brush</label> | 
					<input type="checkbox" name="punchbox" id="punchbox" value="1" checked="checked" />
					<label for="punchbox">punch</label>
					<input type="checkbox" name="insulatebox" id="insulatebox" value="1" checked="checked" />
					<label for="insulatebox">Insulate</label> | 
				</small>
			</h3>

			<div class="alubox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Aluminium (+ added value)</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>


			<div class="cuttingbox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>


			<div class="anodbox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Anod</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('anod_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('anod_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('anod_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Anod</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="coatbox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Coat</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('coat_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('coat_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('coat_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Coat</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="foilbox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Foil</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('foil_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('foil_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('foil_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Foil</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="brushbox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Brush + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Brush + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Brush + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="punchbox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="foilbox brushbox">
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Brush + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Brush + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Brush</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Brush + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="foilbox punchbox">
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="brushbox punchbox">
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Brush + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Brush + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_brush_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Brush + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Brush + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_brush_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Brush + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Brush + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_brush_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="foilbox brushbox punchbox">
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Brush + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Foil + Brush + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_foil_brush_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Brush + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Foil + Brush + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_foil_brush_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Brush + Punch</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_punch_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_punch_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_punch_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Foil + Brush + Punch + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_punch_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_punch_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_foil_brush_punch_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>

			<div class="insulatebox">
				<div class="row-fluid">
					<div class="span6">
						<h4>Insulate</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('insulate_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('insulate_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('insulate_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<h4>Aluminium + Insulate</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_insulate_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_insulate_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_insulate_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Insulate + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_insulate_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_insulate_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_insulate_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Insulate</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_insulate_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_insulate_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_insulate_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Anod + Insulate + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_insulate_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_insulate_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_anod_insulate_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Insulate</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_insulate_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_insulate_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_insulate_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6">
						<h4>Aluminium + Coat + Insulate + Cutting</h4>
						<div class="row-fluid">
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_insulate_cutting_kg', '', 'class="span4"'); ?>
									<span class="add-on">/kg</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_insulate_cutting_m', '', 'class="span4"'); ?>
									<span class="add-on">/m</span>
								</div>
							</div>
							<div class="span4">
								<div class="input-append input-prepend">
									<span class="add-on">€</span>
									<?php echo form_input('alu_coat_insulate_cutting_pc', '', 'class="span4"'); ?>
									<span class="add-on">/pc</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>


		</div>
	</div>

	<div class="modal fade" id="editLmeModal">
		<div class="modal-body">
			<a class="close" data-dismiss="modal">×</a>
			<div class="input-append date" id="datepicker2" data-date="<?php echo date('d/m/Y', mysql_to_unix($price->date)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
				<input type="text" value="<?php echo date('d/m/Y', mysql_to_unix($price->date)); ?>" id="date" class="date span2">
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
				$.post('<?php echo site_url() ?>/lme/lme', {date: lmeDate, type: lmeType}, function(data) {
					console.log(data);
					$('div.' + id + ' span').data('value', data);
					$('div.' + id + ' span span').text(data);
					$('#editLmeModal').modal('hide');
				});
			});


			$('form').submit(function(e) {
				//e.preventDefault();
				$('input.formuladata').each(function(i, element) {
					$(this).data('value', $(this).val());
				});
				var container = $('input#formula_data');
				var newFormula = '';
				$('.formuladata').each(function(i, element) {
					var string = $(element).data('value') + '||';
					newFormula += string;
				});

				container.val(newFormula);

			});

		});

		$(document).ready(function() {

			$('#visibles input').change(function() {
				if (this.checked) {
					$('.' + this.id).show();
				} else if (!this.checked) {
					$('.' + this.id).hide();
				}
			});

		});

	</script>

	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/conversion.js"></script>

