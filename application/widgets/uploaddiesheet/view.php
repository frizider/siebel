<?php 
//dev($profiles_content);
?>
<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone_basic.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css" />
<script  type="text/javascript" src="<?php echo base_url() ?>assets/js/dropzone.js" ></script>

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
			<!-- Upload form via Drag and Drop -->
			<div class="row-fluid">
				<div class="span12">
					<form action="<?php echo site_url('diemaintance/readdiesheet/'.$customernumber) ?>" class="dropzone" id="myDropzone" method="post" enctype="multipart/form-data">
					  <div class="fallback">
						<input name="userfile" type="file" multiple />
						<button type="submit">Submit</button>
					  </div>
					</form> <!-- Form -->
				</div>
			</div>
			<script type="text/javascript">
				Dropzone.options.myDropzone = {
					paramName: "userfile"
				};
			</script> <!-- script -->
			

		</div>
	</div>
</div>
