
<?php echo $this->bootstrap->heading(1, $this->siebel->getLang('permissions')); ?>

<div class="row">
	
	<div class="span12">
		
			<?= form_open(current_url(), array('class' => 'subnav')); ?>

				<ul class="nav nav-pills">

					<li class="span4">
						<p><input name="search_permission" class="span3 search_customer" placeholder="<?php echo ucfirst($this->siebel->getLang('permissions')) ?>..."></p>
					</li>

					<?php
					$value = (isset($_POST['search_group']) && !empty($_POST['search_group'])) ? $_POST['search_group'] : '';
					echo $this->bootstrap->dropdown(TRUE, FALSE, ucfirst($this->siebel->getLang('group')), 'search_group', $this->siebel->getUserGroups(), 'span6', FALSE, $value);
					?>
					<li class="span2 align-right">
						<p>
							<span class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i> <?php echo $this->siebel->getLang('search') ?></span>
							<span class="btn btn-small create href" data-href="<?php echo site_url('auth/create_permission'); ?>"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create') ?></span>
						</p>
					</li>

				</ul>

			</form>
	
	</div> <!-- End span12 -->
	
</div> <!-- end row -->

<div class="container list list-striped">

<?php foreach($permissions as $permission) { ?>
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span4">
					<p>
						<b><?= $permission['name'] ?></b> <br />
						<?= $permission['description'] ?>
					</p>
				</div>
				<div class="span6">
					<p>
						<?php 
						$groups = get_permissions_groups($permission['name']);
						foreach ($groups as $group):?>
							<?php 
								echo group_name($group);
								if(next($groups )) {
									echo ', ';
								};
							?>
						<?php endforeach?>
					</p>
				</div>
				<div class="span2 align-right">
					<p><a href="<?php echo site_url("auth/edit_permission/".$permission['id']); ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a><br /></p>
				</div>
			</div>
		</div>
	</div>
			
<?php } ?>
</div>
