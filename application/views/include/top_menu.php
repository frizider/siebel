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
							echo $this->bootstrap->navItem('View prices', 'prices/toexcel/', '/prices/toexcel/', 'price_excel');
							echo $this->bootstrap->navItem('View prices', 'pricecontract/toexcel/', '/pricecontract/toexcel/', 'pricecontract');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('View LME', 'lme', '/lme', 'lme');
							echo $this->bootstrap->navItem('View LME subscribers', 'lme/mail', '/lme/mail', 'lme_subscribers');
							echo $this->bootstrap->navItem('View prices', 'prices/defaultpremium', '/prices/defaultpremium', 'defaultpremium');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('View tonnagelist', 'tonnagelist', '/tonnagelist', 'tonnagelist');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('View Global Comments', 'comments/globalcomments', '/comments/globalcomments', 'global_comments');
							echo $this->bootstrap->navItem('View comments categories', 'categories', '/comments/categories', 'categories');
							echo '<li class="divider"></li>';
							echo $this->bootstrap->navItem('View deliverydays', 'deliverydays/filter', '/deliverydays/filter', 'filter_deliverydays');
							echo $this->bootstrap->navItem('Export deliveryterms', 'deliveryterms/toexcel', '/deliveryterms/toexcel', 'export_deliveryterms');
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
							echo $this->bootstrap->navItem('Edit own account', 'auth/edit_user/:any', '/auth/edit_user/'.$this->ion_auth->getUserdata('id'), 'account');
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
						echo $this->bootstrap->navItem('Edit own account', 'auth/edit_user/:any', '/auth/edit_user/'.$this->ion_auth->getUserdata('id'), 'account');
					}
					?>
				</ul>
				<form class="navbar-search form-search pull-right" action="<?php echo base_url() ?>" method="post">
					<div class="sb-search">
							<input type="text" name="search_customer" id="search" class="sb-search-input search-query search_customer" placeholder="...">
					</div>
				</form>				

				<?php if($this->config->item('devmode') != 0 && $this->ion_auth->is_admin()) { ?>
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Diamond <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li <?php if($current_page=="index"){echo'class="active"';} ?>>
								<?php echo anchor('diamond/grid', 'Grid', 'title="Go to Scaffolding"'); ?>
							</li>
							<li <?php if($current_page=="base_css"){echo'class="active"';} ?>>
								<?php echo anchor('diamond/base', 'Base CSS', 'title="Go to Base CSS"'); ?>
							</li>
							<li <?php if($current_page=="components"){echo'class="active"';} ?>>
								<?php echo anchor('diamond/components', 'Components', 'title="Go to Components"'); ?>
							</li>
							<li <?php if($current_page=="components"){echo'class="active"';} ?>>
								<?php echo anchor('diamond/buttons', 'Buttons', 'title="Go to Components"'); ?>
							</li>
							<li <?php if($current_page=="components"){echo'class="active"';} ?>>
								<?php echo anchor('diamond/icons', 'Icons', 'title="Go to Components"'); ?>
							</li>
							<li <?php if($current_page=="javascript"){echo'class="active"';} ?>>
								<?php echo anchor('diamond/javascript', 'Javascript', 'title="Go to Javascript"'); ?>
							</li>
						</ul>
					</li>
				</ul>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>


<!--
* customers		* contacts			* deliverydays		* profiles
* prices		* pricecontracts	* orders			* packaging
-->

<div id="searchresults" class="container-fluid">
	<div class="inner">

		<div class="row-fluid">

			<div class="span3 widget" id="searchresults_customers">
				<div class="header">
					<h4><?php echo ucfirst($this->siebel->getLang('customer')); ?></h4>
				</div>
				<div class="content randomborder">
					<div>
						<!--
						<div class="header row-fluid">
							<div class="span4">Lipsum</div>
							<div class="span4">Dolor</div>
							<div class="span4">Ebimt</div>
						</div>
						-->

						<div class="list list-striped">
							
							<div class="row-fluid searchitem">
								<div class="row-fluid">
									<div class="span10"><strong>Lipsum est emet</strong></div>
									<div class="span2 pull-right">Ebimt</div>
								</div>
								<div class="row-fluid">
									<div class="span12 pull-right">Dolor</div>
								</div>
							</div>
							
							<div class="row-fluid searchitem">
								<div class="row-fluid">
									<div class="span10"><strong>Lipsum est emet</strong></div>
									<div class="span2 pull-right">Ebimt</div>
								</div>
								<div class="row-fluid">
									<div class="span12 pull-right">Dolor</div>
								</div>
							</div>
							
							<div class="row-fluid searchitem">
								<div class="row-fluid">
									<div class="span10"><strong>Lipsum est emet</strong></div>
									<div class="span2 pull-right">Ebimt</div>
								</div>
								<div class="row-fluid">
									<div class="span12 pull-right">Dolor</div>
								</div>
							</div>
							
							<div class="row-fluid searchitem">
								<div class="row-fluid">
									<div class="span10"><strong>Lipsum est emet</strong></div>
									<div class="span2 pull-right">Ebimt</div>
								</div>
								<div class="row-fluid">
									<div class="span12 pull-right">Dolor</div>
								</div>
							</div>
							
							<div class="row-fluid searchitem">
								<div class="row-fluid">
									<div class="span10"><strong>Lipsum est emet</strong></div>
									<div class="span2 pull-right">Ebimt</div>
								</div>
								<div class="row-fluid">
									<div class="span12 pull-right">Dolor</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>

			</div>

			<div class="span3" id="searchresults_contacts">

			</div>

			<div class="span3" id="searchresults_deliverydays">

			</div>

			<div class="span3" id="searchresults_profiles">

			</div>

		</div>

		<div class="row-fluid">

			<div class="span3" id="searchresults_prices">

			</div>

			<div class="span3" id="searchresults_pricecontracts">

			</div>

			<div class="span3" id="searchresults_orders">

			</div>

			<div class="span3" id="searchresults_packaging">

			</div>

		</div>

	</div>
</div>
