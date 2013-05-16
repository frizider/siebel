
<?php echo $this->bootstrap->heading(1, $this->siebel->getLang('contactslist')); ?>

<div class="row">
	
	<div class="span12">
		
			<?= form_open(current_url(), array('class' => 'subnav')); ?>

				<ul class="nav nav-pills">

					<li class="span6">
						<p><input name="search_customer" class="span5 search_customer" placeholder="Klant..."></p>
					</li>

					<li class="float-right align-right">
						<p><span class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i> <?php echo $this->siebel->getLang('search') ?></span></p>
					</li>

				</ul>

			</form>
	
	</div> <!-- End span12 -->
	
</div> <!-- end row -->

<div class="container list list-striped">

<?php foreach($customers as $customer) { 
	$customernumber = $customer[param('param_asw_database_column_customernumber')];
	?>
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span2">
					<p><?= $customer[param('param_asw_database_column_customernumber')] ?> <br /></p>
				</div>
				<div class="span4">
					<p><b><?= utf8_encode($customer[param('param_asw_database_column_customername')]) ?></b> <br/></p>
				</div>
				<div class="align-right" style="padding-right: 10px;">
						<div class="btn-group">
							<a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i> <?php echo ucfirst($this->siebel->getLang('actions')); ?> <span class="caret"></span></a>
							<ul class="dropdown-menu align-left pull-right">
								<?php
								echo $this->bootstrap->navItem('View contacts', 'contacts/customer', '/contacts/customer/'.$customernumber, 'contacts', FALSE, 'icon-envelope');
								echo $this->bootstrap->navItem('View comments', 'comments/customer', '/comments/customer/'.$customernumber, 'comments', FALSE, 'icon-comment');
								echo $this->bootstrap->navItem('View deliverydays', 'deliverydays/customer', '/deliverydays/customer/'.$customernumber, 'deliverydays', FALSE, 'icon-map-marker');
								echo $this->bootstrap->navItem('View delivery terms', 'deliveryterms/customer', '/deliveryterms/customer/'.$customernumber, 'deliveryterms', FALSE, 'icon-calendar');
								echo $this->bootstrap->navItem('View prices', 'prices/customer', '/prices/customer/'.$customernumber, 'prices', FALSE, 'icon-tags');
								?>
							</ul>
						</div>
				</div>
			</div>
		</div>
	</div>
			
<?php } ?>
</div>
