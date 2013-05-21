<?php 
	
	$current_page = $this->uri->uri_string();

?>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container<?php echo (isset($containerClassMainnav))?$containerClassMainnav:''; ?>">
			<a class="brand" href="<?= base_url() ?>" rel="tooltip" title="Version <?= $this->config->item('appversion'); ?>"><?= param('param_pagetitle'); ?></a>
			<div class="nav-collapse">
				<ul class="nav">
					<?php if(perm('View globals')) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo ucfirst($this->siebel->getLang('globals')) ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php
							echo $this->bootstrap->navItem('View formulas', 'formulas', '/formulas', 'formulas');
							echo $this->bootstrap->navItem('View LME', 'lme', '/lme', 'lme');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('View Global Comments', 'comments/globalcomments', '/comments/globalcomments', 'global_comments');
							echo $this->bootstrap->navItem('View comments categories', 'categories', '/comments/categories', 'categories');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('View deliverydays', 'deliverydays/filter', '/deliverydays/filter', 'filter_deliverydays');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('messenger', 'messenger', '/messenger', 'messenger');
							?>
						</ul>
					</li>
					<?php } ?>
					<?php if(perm('View users')) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo ucfirst($this->siebel->getLang('users')) ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php
							echo $this->bootstrap->navItem('Edit own account', 'auth/edit_user/:any', '/auth/edit_user/'.$this->siebel->getUserdata('id'), 'account');
							echo $this->bootstrap->navItem('View users', 'auth', '/auth', 'users');
							echo $this->bootstrap->navItem('View permissions', 'auth/permissions', '/auth/permissions', 'permissions');
							echo $this->bootstrap->navItem('Create user', 'auth/create_user', '/auth/create_user', 'create_user');
							echo $this->bootstrap->navItem('Create group', 'auth/create_group', '/auth/create_group', 'create_group');
							?>
						</ul>
					</li>
					<?php 
					}
					else
					{
						echo $this->bootstrap->navItem('Edit own account', 'auth/edit_user/:any', '/auth/edit_user/'.$this->siebel->getUserdata('id'), 'account');
					}
					?>
				</ul>
				<form class="navbar-search pull-right" action="<?php echo base_url() ?>" method="post">
					<input type="text" name="search_customer" class="search-query span2 search_customer" placeholder="Klant...">
				</form>				
				<?php if($this->config->item('devmode') != 0 && $this->ion_auth->is_admin()) { ?>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Bootstrap <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li <?php if($current_page=="index"){echo'class="active"';} ?>>
								<?php echo anchor('twitterbootstrap/scaffolding', 'Scaffolding', 'title="Go to Scaffolding"'); ?>
							</li>
							<li <?php if($current_page=="base_css"){echo'class="active"';} ?>>
								<?php echo anchor('twitterbootstrap/base', 'Base CSS', 'title="Go to Base CSS"'); ?>
							</li>
							<li <?php if($current_page=="components"){echo'class="active"';} ?>>
								<?php echo anchor('twitterbootstrap/components', 'Components', 'title="Go to Components"'); ?>
							</li>
							<li <?php if($current_page=="javascript"){echo'class="active"';} ?>>
								<?php echo anchor('twitterbootstrap/javascript', 'Javascript', 'title="Go to Javascript"'); ?>
							</li>
						</ul>
					</li>
				</ul>
				
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>