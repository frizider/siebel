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
					<li class="span2"><a></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('morning')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('afternoon')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('closeday')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('deliveryday')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($deliverydays as $deliveryday) { 
			?>
				<div class="row-fluid">
					<div class="span11">
						<p><?php echo $deliveryday['addressSet'] ?></p>
					</div>
					<div class="align-right tools">
						<p>
							<a href="<?php echo site_url('deliverydays/edit/'. $customernumber .'/' .$deliveryday['address_id']); ?>" class="edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>
				<?php 
				if($deliveryday['id'])
				{
					foreach ($days as $day)
					{
					?>
					<div class="row-fluid">
						<div class="line">
							<div class="row-fluid">
								<div class="span2">
									<p><?php echo ucfirst($this->siebel->getLang($day)); ?></p>
								</div>
								<div class="span3">
									<p><?php echo $deliveryday[$day.'_am_from']. ' - ' .$deliveryday[$day.'_am_to']; ?></p>
								</div>
								<div class="span3">
									<p><?php echo $deliveryday[$day.'_pm_from']. ' - ' .$deliveryday[$day.'_pm_to']; ?></p>
								</div>
								<div class="span2">
									<p><?php echo ($deliveryday[$day.'_close'] == 1) ? '<i class="icon-check"></i>' : ''; ?></p>
								</div>
								<div class="span2">
									<p><?php echo ($deliveryday[$day.'_delivery'] == 1) ? '<i class="icon-check"></i>' : ''; ?></p>
								</div>
							</div>
						</div>
					</div>

				<?php 
					}
				}
					echo '<hr/>';
			} 
			?>
			</div>
		</div>
	</div>
</div>
