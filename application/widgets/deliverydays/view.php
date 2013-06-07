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
					<li class="span7"><a><?php echo ucfirst($this->siebel->getLang('address')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('closeday')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('deliveryday')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($deliverydays as $deliveryday) { 
				$day_close = '';
				$day_delivery = '';
				if($deliveryday['id'])
				{
					foreach ($days as $day)
					{
						$day_close .= ($deliveryday[$day.'_close'] == 1) ? $this->siebel->getLang($day) : '';
						$day_delivery .= ($deliveryday[$day.'_delivery'] == 1) ? $this->siebel->getLang($day) : '';
					};
				};
			?>
				<div class="row-fluid">
					<div class="span7">
						<p><?php echo $deliveryday['addressSet'] ?></p>
					</div>
					<div class="span2">
						<p><?php echo $day_close ?></p>
					</div>
					<div class="span2">
						<p><?php echo $day_delivery ?></p>
					</div>
					<div class="text-right tools">
						<p>
							<a href="<?php echo site_url($boxId.'/edit/'. $customernumber .'/' .$deliveryday['address_id']); ?>" class="edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
