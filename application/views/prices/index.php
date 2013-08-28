<?php
if(isset($id) && !empty($id))
{
	$this->load->view('prices/edit');
}
else 
{
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone_basic.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css" />
<script  type="text/javascript" src="<?php echo base_url() ?>assets/js/dropzone.js" ></script>

	<div class="row">

		<div class="span12">

				<?php
				echo form_open(current_url(), array('class' => 'subnav')); 
				$value_profile = (isset($_POST['search_profile']) && !empty($_POST['search_profile'])) ? $_POST['search_profile'] : '';
				$value_reference = (isset($_POST['search_reference']) && !empty($_POST['search_reference'])) ? $_POST['search_reference'] : '';
				$value_price = (isset($_POST['search_price']) && !empty($_POST['search_price'])) ? $_POST['search_price'] : '';
				$value_anodprice = (isset($_POST['search_anodprice']) && !empty($_POST['search_anodprice'])) ? $_POST['search_anodprice'] : '';
				$value_anodtype = (isset($_POST['search_anodtype']) && !empty($_POST['search_anodtype'])) ? $_POST['search_anodtype'] : '';
				$value_coatprice = (isset($_POST['search_coatprice']) && !empty($_POST['search_coatprice'])) ? $_POST['search_coatprice'] : '';
				$value_coatcolor = (isset($_POST['search_coatcolor']) && !empty($_POST['search_coatcolor'])) ? $_POST['search_coatcolor'] : '';
				$value_length = (isset($_POST['search_length']) && !empty($_POST['search_length'])) ? $_POST['search_length'] : '';
				?>

					<ul class="nav nav-pills">
						<li class="span2">
							<p>
								<input name="search_profile" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('profile')); ?>" value="<?php echo $value_profile ?>">
								<br>
								<input name="search_reference" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('reference')); ?>" value="<?php echo $value_reference ?>">
							</p>
						</li>
						<li class="span2">
							<p>
								<input name="search_price" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('price')); ?>" value="<?php echo $value_price ?>">
								<br>
								<input name="search_length" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('length')); ?>" value="<?php echo $value_length ?>">
							</p>
						</li>
						<?php
						$name = (isset($_POST['search_priceunit']) && !empty($_POST['search_priceunit'])) ? $this->siebel->getLang('priceunit_'.$search_priceunit_name) : ucfirst($this->siebel->getLang('priceunit'));
						$current = (isset($_POST['search_priceunit']) && !empty($_POST['search_priceunit'])) ? $_POST['search_priceunit'] : '';
						echo $this->bootstrap->dropdown(TRUE, FALSE, $name, 'search_priceunit', $dropdown_priceunits, 'span1', FALSE, $current);
						?>
						<?php
						
						$name = (isset($_POST['search_prefer_priceunit']) && !empty($_POST['search_prefer_priceunit'])) ? $this->siebel->getLang('priceunit_'.$search_prefer_priceunit_name) : ucfirst($this->siebel->getLang('prefer_priceunit'));
						$current = (isset($_POST['search_prefer_priceunit']) && !empty($_POST['search_prefer_priceunit'])) ? $_POST['search_prefer_priceunit'] : '';
						echo $this->bootstrap->dropdown(TRUE, FALSE, $name, 'search_prefer_priceunit', $dropdown_priceunits, 'span1', FALSE, $current);
						?>
						<li class="span2">
							<p>
								<input name="search_anodprice" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('anodprice')); ?>" value="<?php echo $value_anodprice ?>">
								<br>
								<input name="search_anodtype" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('anodtype')); ?>" value="<?php echo $value_anodtype ?>">
							</p>
						</li>
						<li class="span2">
							<p>
								<input name="search_coatprice" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('coatprice')); ?>" value="<?php echo $value_coatprice ?>">
								<br>
								<input name="search_coatcolor" class="span2" placeholder="<?php echo ucfirst($this->siebel->getLang('coatcolor')); ?>" value="<?php echo $value_coatcolor ?>">
							</p>
						</li>
						<li class="float-right align-right">
							<p>
								<?php echo ucfirst($this->siebel->getLang('date')); ?>
								<br>
								<button type="submit" class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i></button>
								<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i></span>
								<span class="btn btn-small print href" data-href="<?php echo site_url($module.'/toexcel/'.$customernumber) ?>"><i class="icon-print"></i> <?php //echo $this->siebel->getLang('print')    ?></span>
							</p>
						</li>

					</ul>

				</form>

		</div> <!-- End span12 -->

	</div> <!-- end row -->
	
	<!-- Upload form via Drag and Drop -->
	<div class="row">
		<div class="span8">
			<form action="<?php echo site_url('prices/readsheet/'.$customernumber) ?>" class="dropzone" id="myDropzone" method="post" enctype="multipart/form-data">
			  <div class="fallback">
				<input name="userfile" type="file" multiple />
				<button type="submit">Submit</button>
			  </div>
			</form> <!-- Form -->
		</div>
		
		<div class="span4">
			<select name="pricesheet_upload_time" id="pricesheet_upload_time">
				<option value="0" selected>Verwijder pricesheet</option>
				<?php foreach($pricesheet_upload_times as $pricesheet_upload_time) {
					echo '<option value="'.$pricesheet_upload_time.'">'.$pricesheet_upload_time.'</option>';
				}
				?>
			</select>
			<a id="deletepricesheet" class="btn btn-small btn-danger" href="#"><i class="icon-remove"></i></a>
		</div>
	</div>

	<div class="container list list-striped">

	<?php foreach($prices as $price) { 
	?>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span2">
						<p>
							<strong><?php echo $price->profile ?></strong>
							<br>
							<?php echo $price->reference ?>
						</p>
					</div>
					<div class="span2">
						<p>
							<strong><?php echo (!empty($price->price)) ? '&euro; ' . number_format($price->price, 2) : '' ?></strong>
							<br><?php echo (!empty($price->length)) ? number_format($price->length, 3).' m' : '' ?></p>
					</div>
					<div class="span1">
						<p>
							<?php echo (!empty($price->priceunit)) ?$this->siebel->getLang('priceunit_'.$price->priceunit) : '' ?>
						</p>
					</div>
					<div class="span1">
						<p>
							<?php echo (!empty($price->prefer_priceunit)) ? $this->siebel->getLang('priceunit_'.$price->prefer_priceunit) : '' ?>
						</p>
					</div>
					<div class="span2">
						<p>
							<?php echo (!empty($price->anodprice)) ? '&euro; ' . number_format($price->anodprice, 2) : '' ?>
							<br>
							<?php echo $price->anodtype ?>
						</p>
					</div>
					<div class="span2">
						<p>
							<?php echo (!empty($price->coatprice)) ? '&euro; ' . number_format($price->coatprice, 2) : '' ?>
							<br>
							<?php echo $price->coatcolor ?>
						</p>
					</div>
					<div class="align-right span2">
						<p>
							<?php echo date('d/m/Y',  mysql_to_unix($price->date)) ?>
							<br>
							<a href="<?php echo current_url().'/'. $price->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i></a>
							<a href="<?php echo current_url().'/'. $price->id.'/copy'; ?>" class="btn btn-small edit"><i class="icon-copy"></i></a>
						</p>
					</div>
				</div>
				<?php if(!empty($price->comment)) {  ?>
				<div class="row">
					<div class="span2 txt-blue"><p><strong><?php echo ucfirst($this->siebel->getLang('comment')); ?></strong></p></div>
					<div class="span9"><p><?php echo $price->comment ?></p></div>
				</div>
				<?php } ?>
			</div>
		</div>

	<?php } ?>
	</div>
	
	<script type="text/javascript">
		Dropzone.options.myDropzone = {
			paramName: "userfile",
			success: function() {
				window.location.href = "<?php echo current_url();?>";
			}
		};
		
		$(document).ready( function() {
			
			$(document).on('click', 'a#deletepricesheet', function(e) {
				e.preventDefault();
				
				var selected_pricesheet_time = $('select#pricesheet_upload_time').val();
				var data = {
					pricesheet_time: selected_pricesheet_time
				};
				
				console.log(data);
				
				$.post('<?php echo site_url('prices/deletepricesheet/'.$customernumber);?>', data, function(data) {
					window.location.href = "<?php echo current_url();?>";
				});
				
			});
			
		});
	</script> <!-- script -->
			
<?php } ?>
