<script type="text/javascript" src="<?php echo base_url() ?>/assets/ckeditor/ckeditor.js"></script>

<?php 
$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));
$customerLang = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customerlang')));

if(isset($id) && !empty($id))
{
?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
			echo form_hidden('id', $id);
			echo form_hidden('customernumber', $customernumber);
			echo form_hidden('global', 0);
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
					$name = (isset($category['value']) && !empty($category['value'])) ? ucfirst($this->siebel->getLang('category_'.$current_category[0]->slug)) : $this->siebel->getLang('choose');
					foreach($categories as $comments_category) {
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
		<a href="<?php echo site_url('comments/delete/'.$customernumber.'/'.$id) ?>" class="btn btn-danger"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
	</div>
</div>


<?php
}
else 
{
?>

<div class="container">

<?php 
foreach ($comments as $comment)
{
?>
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span12">
					<?php echo $this->bootstrap->heading(3, $this->siebel->getLang('category_'.$comment->slug)); ?>
				</div>
			</div>
			<div class="commentlist <?php echo $comment->color ?>">
<?php	
	foreach($comment->comments as $item) { 
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
