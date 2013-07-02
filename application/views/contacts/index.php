
<div class="container list list-striped">

<?php foreach($customers as $customer) { 
	$customernumber = $customer[param('param_asw_database_column_customernumber')];
	?>
	<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span2">
						<p><?php echo $customer[param('param_asw_database_column_customernumber')]; ?> <br /></p>
					</div>
					<div class="span4">
						<p><b><?php echo utf8_encode($customer[param('param_asw_database_column_customername')]); ?></b> <br/></p>
					</div>
					<div class="pull-right" style="padding-right: 10px;">
							<div class="btn-group">
								<a class="btn btn-success" href="<?php echo site_url('dashboard/customer/'.$customernumber); ?>"><i class="icon-dashboard icon-white"></i> Dashboard</a>
								<a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu align-left pull-right">
									<?php
									echo $this->bootstrap->navItem('View contacts', 'contacts/customer', '/contacts/customer/'.$customernumber, 'contacts', FALSE, 'icon-envelope');
									echo $this->bootstrap->navItem('View comments', 'comments/customer', '/comments/customer/'.$customernumber, 'comments', FALSE, 'icon-comment');
									echo $this->bootstrap->navItem('View prices', 'prices/customer', '/prices/customer/'.$customernumber, 'prices', FALSE, 'icon-tags');
									echo $this->bootstrap->navItem('View pricecontract', 'pricecontract/customer', '/pricecontract/customer/'.$customernumber, 'pricecontract', FALSE, 'icon-folder');
									echo $this->bootstrap->navItem('View deliverydays', 'deliverydays/customer', '/deliverydays/customer/'.$customernumber, 'deliverydays', FALSE, 'icon-truck');
									echo $this->bootstrap->navItem('View holidays', 'holidays/customer', '/holidays/customer/'.$customernumber, 'holidays', FALSE, 'icon-plane');
									echo $this->bootstrap->navItem('View delivery terms', 'deliveryterms/customer', '/deliveryterms/customer/'.$customernumber, 'deliveryterms', FALSE, 'icon-calendar');
									?>
								</ul>
							</div>
					</div>
				</div>
			</div>
	</div>
			
<?php } ?>
</div>
