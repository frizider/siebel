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
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('from')); ?></a></li>
					<li class="span5"><a><?php echo ucfirst($this->siebel->getLang('until')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($holidays_content as $holiday) { 
			?>
				<div class="row-fluid">
					<div class="span4">
						<p><?php echo date('d/m/Y',  mysql_to_unix($holiday->from)) ?><br /></p>
					</div>
					<div class="span5">
						<p><?php echo date('d/m/Y',  mysql_to_unix($holiday->until)) ?><br /></p>
					</div>
					<div class="span1">
						<p>
							<?php if(!empty($holiday->comment) || $holiday->comment != '')
							{
								echo ucfirst($holiday->comment);
							};
							?>
						</p>
					</div>
					<div class="text-right tools">
						<p>
							<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/'. $holiday->id); ?>" class="edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>

			<?php } ?>
			</div>
		</div>
	</div>
</div>
