
<?php echo form_open_multipart(current_url(), 'class="form-horizontal"'); ?>
	<div class="well">
		<div class="row">
			<div class="control-group">
				<label for="comment" class="control-label">File</label>
				<div class="controls">
					<div class="">
						<input name="userfile" type="file" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Opslaan</button>
						<button class="btn">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>






<link rel="stylesheet" href="<?= base_url() ?>assets/css/dropzone_basic.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/dropzone.css" />
<script  type="text/javascript" src="<?= base_url() ?>assets/js/dropzone.js" ></script>

	<div class="row">
		<div class="span12">
			<form action="<?php echo current_url() ?>" class="dropzone" id="myDropzone" method="post" enctype="multipart/form-data">
			  <div class="fallback">
				<input name="userfile" type="file" multiple />
				<button type="submit">Submit</button>
			  </div>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		Dropzone.options.myDropzone = {
			paramName: "userfile", 
			accept: function(file, done) {
				console.log(file);
				done();
			}
		};
	</script>

