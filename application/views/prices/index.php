<?php
echo $this->bootstrap->alert('<h3>LOOK OUT!</h3><p>Please notice that this part is currently in development. It will not work fine for the moment.</p>', 'alert-error');

$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));

if(isset($id) && !empty($id))
{
	$this->load->view('prices/edit');
}
else 
{

	//dev($prices);

	echo $this->bootstrap->heading(1, $this->siebel->getLang('prices'), $customerName. ' | '. $customernumber, '<a class="backbutton" title="Go back" href="'.site_url('dashboard/customer/'.$customernumber).'"><span><i class="icon-chevron-left"></i></span></a> '); 
?>
	<div class="row">

		<div class="span12">

				<?= form_open(current_url(), array('class' => 'subnav')); ?>

					<ul class="nav nav-pills">
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('price')); ?></a></li>
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('profil')); ?></a></li>
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('finish')); ?></a></li>
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('length')); ?></a></li>
						<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('date')); ?></a></li>
						<li class="float-right align-right">
							<p>
								<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create') ?></span>
							</p>
						</li>

					</ul>

				</form>

		</div> <!-- End span12 -->

	</div> <!-- end row -->

	<div class="container list list-striped">

	<?php foreach($prices as $price) { 
	?>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span2">
						<p>
							<b><?php echo '&euro; ' . $price->price ?></b>
							<?php echo ' /'. $this->siebel->getLang('priceunit_'.$this->siebel->getPriceUnit($price->priceunit_id)->short) ?><br />
						</p>
					</div>
					<div class="span2">
						<p><?php echo $price->profile ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo $price->finish ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo $price->length ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo date('d/m/Y',  mysql_to_unix($price->date)) ?><br /></p>
					</div>
					<div class="align-right">
						<p>
							<a href="<?php echo current_url().'/'. $price->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a>
							<a href="<?php echo current_url().'/'. $price->id.'/copy'; ?>" class="btn btn-small edit"><i class="icon-share"></i> <?php echo $this->siebel->getLang('duplicate') ?></a>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="span2"></div>
					<div class="span9"><p><?php echo $price->comment ?></p></div>
				</div>
			</div>
		</div>

	<?php } ?>
	</div>
<?php } ?>
