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
				<input type="text" name="search_packaging_profile" id="search_profile_profile" />
			</div>

			<div class="row-fluid">
				<ul class="nav nav-pills">
					<li class="span4"><a><?php echo ucfirst($this->siebel->getLang('profile')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('version')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('tensile')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('report')); ?></a></li>
				</ul>
			</div>

			<div class="list list-striped" id="profile_list">

			<?php 
			if(!empty($profiles_content)) {
				foreach($profiles_content as $item) { 
			?>
				<div class="row-fluid">
					<div class="span4">
						<p class="profile_list_profile"><?php echo $item[param('param_asw_database_column_dm_number')] ?><br /></p>
					</div>
					<div class="span2">
						<p><?php echo $item[param('param_asw_database_column_dm_version')] ?><br /></p>
					</div>
					<div class="span3">
						<p><?php echo $item[param('param_asw_database_column_dm_tensile')] ?><br /></p>
					</div>
					<div class="span3">
						<p><?php echo $item[param('param_asw_database_column_dm_measurement_report')] ?><br /></p>
					</div>
				</div>

			<?php 
				}
			} ?>
			</div>
		</div>
	</div>

	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			// Seach profile in packaging list
			$('input#search_profile_profile').keyup(function() {

				var value = $(this).val();

				$("#profile_list > div").each(function() {
					var profile = $(this).find('.profile_list_profile').text();
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
