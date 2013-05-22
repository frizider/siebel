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
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('term')); ?></a></li>
					<li class="span5"><a><?php echo ucfirst($this->siebel->getLang('date')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($deliveryterms_content as $item) { 
			?>
				<div class="row-fluid">
					<div class="span4">
						<p><b><?php echo $item->term ?></b><br /></p>
					</div>
					<div class="span5">
						<p><?php echo date('d/m/Y',  mysql_to_unix($item->date)) ?><br /></p>
					</div>
					<div class="span1">
						<p>
							<?php if(!empty($item->comment) || $item->comment != '')
							{
								echo '<a href="#" class="comment" rel="tooltip" title="'.$item->comment.'"><i class="icon-comment"></i></a>';
							};
							?>
						</p>
					</div>
					<div class="align-right tools">
						<p>
							<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/'. $item->id); ?>" class="edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>

			<?php } ?>
			</div>
		</div>
	</div>
</div>
