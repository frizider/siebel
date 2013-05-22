<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
	<div class="header">
		<h3>
			<?php 
			$category = $this->siebel->getCommentsCategories($_GET['dataId']);
			echo $title .' '.$this->siebel->getLang('category_'.$category[0]->slug); 
			?>
			<span class="tools pull-right">
				<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/new') ?>" class="add"><i class="icon-plus"></i></a>
				<a href="<?php echo site_url($boxId.'/customer/'.$customernumber) ?>" class="manage"><i class="icon-cog"></i></a>
				<a class="move"><i class="icon-move"></i></a>
			</span>
		</h3>
	</div>
	<div class="content commentlist <?php echo $category[0]->color ?> border-<?php echo $category[0]->color ?>">
		<div>
			<div class="list list-striped">

			<?php foreach($comments_content[$_GET['dataId']] as $item) { 
			?>
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span12 comment-head">
								<div class="row-fluid">
									<div class="span1 priority <?php echo 'priority-'.$item->priority ?>">
										<p>
											<?php if($item->priority > 0) { ?>
												<i class="icon-warning-sign icon-white"></i>
											<?php } ?>
										</p>
									</div>
									<div class="span8">
										<p><b><?php echo $item->title ?></b></p>
									</div>
									<div class="span1 align-right">
										<p>
											<?php if(!empty($item->description)) { echo '<i class="icon-comment icon-white"></i>'; } ?>
											<?php if(!empty($item->global)) { echo '<i class="icon-random icon-white"></i>'; } ?>
										</p>
									</div>
									<div class="float-right align-right tools">
										<p><a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/'. $item->id); ?>" class="edit"><i class="icon-pencil"></i></a></p>
									</div>
								</div>
							</div>
						</div>
						<?php if(!empty($item->description)) { ?>
						<div class="row-fluid">
							<div class="span12 comment-description" style="display:none;">
								<div class="inner">
									<?php echo $item->description ?>
								</div>
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
