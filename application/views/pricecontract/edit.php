<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
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
		<a href="<?php echo site_url($module.'/delete/'.$customernumber.'/'.$id) ?>" class="btn btn-danger"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
	</div>
</div>
