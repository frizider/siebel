<script type="text/javascript" src="<?php echo base_url() ?>/assets/ckeditor/ckeditor.js"></script>

<?php 
if(isset($id) && !empty($id))
{
echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_comment'),'', '<a class="backbutton" title="Go back" href="'.site_url('comments/globalcomments/').'"><span><i class="icon-chevron-left"></i></span></a>' ); 
?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
			echo form_hidden('id', $id);
			echo form_hidden('global', 1);
			?>
			
		<div class="well">
			<div class="row">
				<div class="span11">
					<?php 
					$title['class'] = $title['class'] . ' span9';
					echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('title'), 'title', array('class' => 'control-label')), array($title));
					?>
				</div>
			</div>

			<div class="row">

				<div class="span6">
					<?php 
					// Dropdown for languages
					$label = $this->siebel->getLang('priority');
					if(isset($priority['value']) && !empty($priority['value']))
					{
						switch ($priority['value'])
						{
							case '0' :
								$name = ucfirst($this->siebel->getLang('normal'));
								break;
							case '1':
								$name = ucfirst($this->siebel->getLang('important'));
								break;
							case '2':
								$name = ucfirst($this->siebel->getLang('urgent'));
								break;
						}
					}
					else
					{
						$name = ucfirst($this->siebel->getLang('normal'));
					}
					$values = array('0' => $this->siebel->getLang('normal'), '1' => $this->siebel->getLang('important'), '2' => $this->siebel->getLang('urgent'));
					echo $this->bootstrap->dropdown(FALSE, $label, $name, 'priority', $values, FALSE, FALSE, $priority['value']);
					?>
				</div>
				<div class="span5">
					<?php
					// Dropdown for Groups
					$label = $this->siebel->getLang('category');
					$current = $this->siebel->getCommentsCategories($category['value']);
					$name = (isset($category['value']) && !empty($category['value'])) ? ucfirst($this->siebel->getLang('category_'.$current[0]->slug)) : $this->siebel->getLang('choose');
					$comments_categories = $this->siebel->getCommentsCategories();
					foreach($comments_categories as $comments_category) {
						$categories_values[$comments_category->id] = $this->siebel->getLang('category_'.$comments_category->slug);
					}
					echo $this->bootstrap->dropdown(FALSE, $label, $name, 'category', $categories_values, FALSE, FALSE, $category['value']);
					?>
				</div>

			</div>
			
			<div class="row">
				<div class="span11">
					<div class="control-group">
						<label for="description" class="control-label"><?php echo ucfirst($this->siebel->getLang('description')) ?></label>
						<div class="controls">
							<?php 
							//echo '<textarea rows="10" name="'.$description['name'].'" id="'.$description['id'].'" class="'.$description['class'].' span9">'.$description['value'].'</textarea>';
							echo $this->ckeditor->editor($description['name'], $description['value']);
							?>
						</div>
					</div>
				</div>
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
		<a href="<?php echo site_url('comments/delete/global/'.$id) ?>" class="btn btn-danger"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
	</div>
</div>


<?php
}
else 
{
echo $this->bootstrap->heading(1, $this->siebel->getLang('comments'), ' <a class="btn" href="'.current_url().'/new"><i class="icon-plus"></i></a>'); 
?>

<div class="container">

<?php 

foreach ($comments as $comment)
{
	//dev($comment);
	$category = $comment['category'];
	$objects = $comment['comments'];
?>
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span12">
					<?php echo $this->bootstrap->heading(3, $this->siebel->getLang('category_'.$category->slug)); ?>
				</div>
			</div>
			<div class="commentlist <?php echo $category->color ?>">
<?php	
	foreach($objects as $item) { 
		//dev($item);
?>
			<div class="row">
				<div class="span12">
					<div class="row">
						<div class="span12 comment-head">
							<div class="row">
								<div class="span1 priority <?php echo 'priority-'.$item->priority ?>">
									<p>
										<?php if($item->priority > 0) { ?>
											<i class="icon-warning-sign icon-white"></i>
										<?php } ?>
									</p>
								</div>
								<div class="span9">
									<p><b><?php echo $item->title ?></b></p>
								</div>
								<div class="span1 align-right">
									<p>
										<?php if(!empty($item->description)) { echo '<i class="icon-comment icon-white"></i>'; } ?>
										<?php if(!empty($item->global)) { echo '<i class="icon-random icon-white"></i>'; } ?>
									</p>
								</div>
								<div class="float-right align-right">
									<p><a href="<?php echo current_url().'/'.$item->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php //echo $this->siebel->getLang('edit') ?></a></p>
								</div>
							</div>
						</div>
					</div>
					<?php if(!empty($item->description)) { ?>
					<div class="row">
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
<?php } ?>
</div>
<?php } ?>
