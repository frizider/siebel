<?php echo $this->bootstrap->heading(1, $this->siebel->getLang('users')); ?>

<div class="row">
	<div class="span12">
		<?= form_open(current_url(), array('class' => 'subnav')); ?>
			<input type="hidden" name="search_userlang" class="search_userlang" />
			<input type="hidden" name="search_usergroup" class="search_usergroup" />
			
			<ul class="nav nav-pills">
				
				<li class="span3 first">
					<input name="search_username" class="span2" placeholder="Username..." value="<?php echo (isset($_POST['search_username']) && !empty($_POST['search_username'])) ? $_POST['search_username'] : '' ?>">
				</li>

				<li class="span3">
					<input name="search_useremail" class="span2" placeholder="Email..." value="<?php echo (isset($_POST['search_useremail']) && !empty($_POST['search_useremail'])) ? $_POST['search_useremail'] : '' ?>">
				</li>
				
				<?php 
				$name = (isset($_POST['search_userlang']) && !empty($_POST['search_userlang'])) ? $_POST['search_userlang'] : '';
				$values = array('nl' => 'NL', 'fr' => 'FR', 'de' => 'DE', 'en' => 'EN');
				echo $this->bootstrap->dropdown(TRUE, FALSE, $name, 'search_userlang', $values, 'span1', 'icon-flag');
				
				if(isset($_POST['search_usergroup']) && !empty($_POST['search_usergroup'])) {
					$group = $this->ion_auth->group($_POST['search_usergroup'])->result();
					$name = $group[0]->description;
				} else {
					$name = 'Group';
				}
				echo $this->bootstrap->dropdown(TRUE, FALSE, $name, 'search_usergroup', $usergroups, 'span2'); 
				?>
				
				<li class="dropdown pull-right">
					<div class="btn btn-small btn-primary search"><i class="icon-search icon-white submit"></i> Zoeken</div>
					<div data-href="<?php echo site_url('auth/create_user'); ?>" class="btn btn-small create href"><i class="icon-user"></i> + User</div>
					<div data-href="<?php echo site_url('auth/create_group'); ?>" class="btn btn-small create href"><i class="icon-tags"></i> + Group</div>
				</li>

				
			</ul>
			
		</form>
	
	</div> <!-- End span12 -->
	
</div> <!-- end row -->

<div class="container list list-striped">
	
<?php foreach($users as $user) { ?>
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span3">
					<p><b><?php echo $user->username;?></b> <br /></p>
				</div>
				<div class="span3">
					<p><?= $user->email ?> <br/></p>
				</div>
				<div class="span1">
					<p><?= $user->lang ?> <br/></p>
				</div>
				<div class="span2">
					<p><?php foreach ($user->groups as $group) { echo $group->name;} ?> <br/></p>
				</div>
				<div class="span3 align-right">
					<p><a href="<?php echo site_url("auth/edit_user/".$user->id); ?>" class="btn btn-small edit"><i class="icon-pencil"></i> Edit</a><br /></p>
				</div>
			</div>
		</div>
	</div>
			
<?php } ?>
</div>
