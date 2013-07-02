<?php 
//dev($profiles_content);
?>

<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
	<div class="header">
		<h3>
			<?php echo $title; ?>
			<span class="tools pull-right">
				<a class="move"><i class="icon-move"></i></a>
			</span>
		</h3>
	</div>
	<div class="content randomborder">
		<div>
			<div class="row-fluid">
				<ul class="nav nav-pills">
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('profile')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('finish')); ?></a></li>
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('casing')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('total')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped">

			<?php foreach($packaging_content as $item) { 
			?>
				<div class="row-fluid">
					<div class="span3">
						<p>
							<strong><?php echo $item[param('param_asw_database_packing_profile')] ?></strong><br />
							<?php echo $item[param('param_asw_database_packing_length')] ?>
						</p>
					</div>
					<div class="span3">
						<p><?php echo $item[param('param_asw_database_packing_finish')] ?><br /></p>
					</div>
					<div class="span4">
						<p><?php echo $item[param('param_asw_database_packing_casing')] ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo $item[param('param_asw_database_packing_total')] ?><br /></p>
					</div>
				</div>

			<?php } ?>
			</div>
		</div>
	</div>
</div>
