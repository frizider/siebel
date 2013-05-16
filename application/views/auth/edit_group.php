<?php echo form_open(current_url(), $form_attributes);?>
<div id="infoMessage"><?php echo $message;?></div>

<div id="smallheader">
	<div id="search" class="container">
        <div class="row">
			<div id="nl" class="floatleftbox eightcol">
				<h1 class="title"><?php echo $title; ?></h1>
			</div>
			<div id="actions" class="floatleftbox threecol">
				<?php echo form_submit('submit', 'Save Group', 'class="button blue save"');?>
			</div>
        </div>
    </div>
</div>

<div id="content">
	<div class="separator" style="height: 76px"></div>

	<div class="container">
		<div class="row">

			<div class="formbox threecol">
				<label class="title">Group Name</label>
				<?= form_input($group_name); ?>
				<div class="separator"></div>
				<label class="title">Description</label>
				<?= form_input($description); ?>
			</div>

			<div class="clear"></div>
		</div>

		<div class="clear"></div>

	</div>
	<div class="clear"></div>
	
</div>

<?php echo form_close();?>