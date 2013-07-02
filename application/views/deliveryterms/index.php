<?php
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));

if(isset($id) && !empty($id))
{
?>

	<div class="row">
		<div class="span12">

			<?php 
			echo form_open(current_url(), $form_attributes);
				?>

			<div class="well">
				<div class="row">
					<div class="span6">
						<?php 
						$field = 'term';
						$value = array(
							'name' => $field,
							'id' => $field,
							'class' => $field.' span3',
							'type' => 'text',
							'value' => $term->$field,
						);
						echo $this->bootstrap->formControlGroup(array($this->siebel->getLang($field), $field, array('class' => 'control-label')), array($value));
						?>
					</div>
					<div class="span5">
						<div class="control-group">
							<label for="date" class="control-label"><?php echo $this->siebel->getLang('date') ?></label>
							<div class="controls">
								<div class="input-append date" id="datepicker2" data-date="<?php echo date('d/m/Y',  mysql_to_unix($term->date)); ?>" data-date-format="dd/mm/yyyy" data-date-weekstart="1">
									<input type="text" name="date" value="<?php echo date('d/m/Y',  mysql_to_unix($term->date)); ?>" id="date" class="date span2">
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
							'value' => $term->$field,
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
					</div>
				</div>
			</div>

			</form>

		</div>
	</div>



<?php
	
}
else 
{
?>
	<div class="row">

		<div class="span12">

				<?= form_open(current_url(), array('class' => 'subnav')); ?>

					<ul class="nav nav-pills">
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('term')); ?></a></li>
						<li class="span6"><a><?php echo ucfirst($this->siebel->getLang('comment')); ?></a></li>
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('date')); ?></a></li>
						<li class="float-right align-right">
							<p>
								<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create') ?></span>
							</p>
						</li>

					</ul>

				</form>

		</div> <!-- End span12 -->

	</div> <!-- end row -->

	<div class="container list list-striped">

	<?php foreach($terms as $term) { 
	?>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span2">
						<p><b><?php echo $term->term ?></b><br /></p>
					</div>
					<div class="span6">
						<p><?php echo $term->comment ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo date('d/m/Y',  mysql_to_unix($term->date)) ?><br /></p>
					</div>
					<div class="align-right">
						<p>
							<a href="<?php echo current_url().'/'. $term->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a>
						</p>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
	</div>
<?php } ?>
