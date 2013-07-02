<?php

$customerName = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));

if(isset($id) && !empty($id))
{
	$this->load->view('prices/edit');
}
else 
{
?>
	<div class="row">

		<div class="span12">

				<?php
				echo form_open(current_url(), array('class' => 'subnav')); 
				$value_price = (isset($_POST['search_price']) && !empty($_POST['search_price'])) ? $_POST['search_price'] : '';
				$value_profile = (isset($_POST['search_profile']) && !empty($_POST['search_profile'])) ? $_POST['search_profile'] : '';
				$value_finish = (isset($_POST['search_finish']) && !empty($_POST['search_finish'])) ? $_POST['search_finish'] : '';
				$value_length = (isset($_POST['search_length']) && !empty($_POST['search_length'])) ? $_POST['search_length'] : '';
				?>

					<ul class="nav nav-pills">
						<li class="span1">
							<p>
								<input name="search_price" class="span1" placeholder="<?php echo ucfirst($this->siebel->getLang('price')); ?>" value="<?php echo $value_price ?>">
							</p>
						</li>
						<?php
						$name = (isset($_POST['search_priceunit']) && !empty($_POST['search_priceunit'])) ? $this->siebel->getLang('priceunit_'.$search_priceunit_name) : '';
						$current = (isset($_POST['search_priceunit']) && !empty($_POST['search_priceunit'])) ? $_POST['search_priceunit'] : '';
						echo $this->bootstrap->dropdown(TRUE, FALSE, $name, 'search_priceunit', $dropdown_priceunits, 'span1', FALSE, $current);
						?>
						<li class="span2">
							<p>
								<input name="search_profile" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('profile')); ?>" value="<?php echo $value_profile ?>">
							</p>
						</li>
						<li class="span2">
							<p>
								<input name="search_finish" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('finish')); ?>" value="<?php echo $value_finish ?>">
							</p>
						</li>
						<li class="span2">
							<p>
								<input name="search_length" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('length')); ?>" value="<?php echo $value_length ?>">
							</p>
						</li>
						<li class="span2">
							<a><?php echo ucfirst($this->siebel->getLang('date')); ?></a>
						</li>
						<li class="float-right align-right">
							<p>
								<span class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i> <?php echo $this->siebel->getLang('search') ?></span>
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
							<?php echo ' /'. $this->siebel->getLang('priceunit_'.$price->priceunit) ?><br />
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
