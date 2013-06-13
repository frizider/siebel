<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
	<div class="header">
		<h3>
			<?php echo $title; ?>
			<span class="tools pull-right">
				<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/new') ?>" class="add"><i class="icon-plus"></i></a>
				<a href="<?php echo site_url($boxId.'/customer/'.$customernumber) ?>" class="manage"><i class="icon-cog"></i></a>
				<a class="move"><i class="icon-move"></i></a>
			</span>
		</h3>
	</div>
	<div class="content randomborder">
		<div>
			<div class="row-fluid">
				<ul class="nav nav-pills">
					<li class="span4"><a href="#"><?php echo ucfirst($this->siebel->getLang('name')); ?></a></li>
					<li class="span3"><a href="#"><?php echo ucfirst($this->siebel->getLang('phone')).'/'.$this->siebel->getLang('fax'); ?></a></li>
					<li class="span3"><a href="#"><?php echo ucfirst($this->siebel->getLang('department')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($contacts_content as $contact) { 
			?>
				<div class="row-fluid">
					<div class="span4">
						<p><b><?php echo trim($contact[param('param_asw_database_column_contact_name')]) ?></b><br /></p>
					</div>
					<div class="span3">
					<p>
						<i class="icon-phone" title="<?php echo ucfirst($this->siebel->getLang('phone')); ?>"></i> <?php echo trim($contact[param('param_asw_database_column_contact_phone')]) ?><br/>
						<i class="icon-print" title="<?php echo ucfirst($this->siebel->getLang('fax')); ?>"></i> <?php echo trim($contact[param('param_asw_database_column_contact_fax')]) ?>
					</p>
					</div>
					<div class="span3">
						<p><ul><?php 
							foreach($contact['departments'] as $department)
							{
								if(!empty($department))
								{
									echo '<li>'.ucfirst(utf8_encode($department)).'</li>';
								}
							}
						?></ul> <br/></p>
					</div>
					<div class="text-right tools">
						<p>
							<a href="mailto:<?php echo trim($contact[param('param_asw_database_column_contact_email')]) ?>" class="email"><i class="icon-envelope"></i></a>
							<a href="<?php echo site_url($boxId."/customer/".$customernumber.'/'.trim($contact[param('param_asw_database_column_contact_id')])); ?>" class="edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>

			<?php } ?>
			</div>
		</div>
	</div>
</div>
