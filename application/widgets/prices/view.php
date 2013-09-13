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
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('profil')); ?></a></li>
					<li class="span3">&nbsp;</li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('price')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('priceunit')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('date')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($prices_content as $price) { 
			?>
				<div class="row-fluid <?php echo ($price->pricecontract_closed == 1) ? 'opacity50' : '' ?> <?php echo ($price->pricecontract_id != 0) ? 'active' : '' ?>">
					<div class="span12">
						<div class="row-fluid">
							
						<div class="span2">
							<p>
								<strong><?php echo $price->profile ?></strong>
							</p>
						</div>
						<div class="span3">
							<p>
								<?php echo $price->finish; ?>
							</p>
						</div>
						<div class="span2">
							<p>
								<strong> <?php echo '&euro;' . number_format($price->totalprice, 2); ?></strong>
							</p>
						</div>
						<div class="span2">
							<p>
								<?php echo $price->prefer_priceunit ?>
							</p>
						</div>

						<div class="span3">
							<?php echo date('d/m/Y',  mysql_to_unix($price->date)) ?>
							<div class="text-right tools">
									<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/'. $price->id); ?>" class="edit"><i class="icon-pencil"></i></a>
							</div>
						</div>
						</div>
						<?php if(!empty($price->comment)) {  ?>
						<div class="row-fluid">
							<div class="span2">
								<p>
									<strong><?php echo ucfirst($this->siebel->getLang('comment')); ?></strong>
								</p>
							</div>
							<div class="span10">
								<p>
									<?php echo $price->comment ?>
								</p>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>

			<?php } ?>
			</div>
		</div>
	</div>
</div>
