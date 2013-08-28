<?php
//dev($profiles_content);
?>

<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
	<div class="header">
		<h3>
			<?php echo $title; ?>
			<span class="tools pull-right">
				<a class="move"><i class="icon-move"></i></a>
			</span>
		</h3>
	</div>
	<div class="content randomborder">
		<div>
			<div class="row-fluid">
				<input type="text" name="search_packaging_profile" id="search_packaging_profile" />
			</div>

			<div class="row-fluid">
				<ul class="nav nav-pills">
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('profile')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('finish')); ?></a></li>
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('casing')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('total')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped" id="packaging_list">

				<?php foreach ($packaging_content as $item) {
					?>
					<div class="row-fluid">
						<div class="span3">
							<p>
								<strong class="packaging_list_profile"><?php echo $item[param('param_asw_database_packing_profile')] ?></strong><br />
								<?php echo $item[param('param_asw_database_packing_length')] ?>
							</p>
						</div>
						<div class="span3">
							<p><?php echo $item[param('param_asw_database_packing_finish')] ?><br /></p>
						</div>
						<div class="span4">
							<p><?php echo $item[param('param_asw_database_packing_casing')] ?><br /></p>
						</div>
						<div class="span2">
							<p><?php echo $item[param('param_asw_database_packing_total')] ?><br /></p>
						</div>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>

	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			// Seach profile in packaging list
			$('input#search_packaging_profile').keyup(function() {

				var value = $(this).val();

				$("#packaging_list > div").each(function() {
					var profile = $(this).find('.packaging_list_profile').text();
					if (profile.search(value) > -1) {
						$(this).show();
					}
					else {
						$(this).hide();
					}
				});

			});
		});
	</script>

</div>


