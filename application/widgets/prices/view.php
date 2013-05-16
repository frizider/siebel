<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>">
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
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('price')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('profil')); ?></a></li>
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('finish')) .' / '. $this->siebel->getLang('length'); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('date')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($prices_content as $price) { 
			?>
				<div class="row-fluid">
					<div class="span2">
						<p><b>&euro; <?php echo $price->price ?></b><br /></p>
					</div>
					<div class="span3">
						<p><?php echo $price->profile ?><br /></p>
					</div>
					<div class="span4">
						<p><?php echo $price->finish ?><br /><?php echo $price->length ?></p>
					</div>
					<div class="span2">
						<p><?php echo date('d/m/Y',  mysql_to_unix($price->date)) ?><br /></p>
					</div>
					<div class="align-right tools">
						<p>
							<a href="<?php echo site_url().'/prices/customer/'.$customernumber.'/'. $price->id; ?>" class="edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>

			<?php } ?>
			</div>
		</div>
	</div>
</div>
