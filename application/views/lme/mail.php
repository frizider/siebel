<?php
if(isset($id) && !empty($id))
{
	$this->load->view('lme/editmail');
}
else 
{
?>
	<div class="row">

		<div class="span12">

				<?= form_open(current_url(), array('class' => 'subnav')); ?>

					<ul class="nav nav-pills">
						<li>
							<p>
								<input name="email" class="span10" placeholder="<?php echo ucfirst($this->siebel->getLang('email')); ?>" value="<?php echo $this->input->post('email') ?>">
							</p>
						</li>
						<li class="align-right">
							<p>
								<button type="submit" class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i></button>
								<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i></span>
							</p>
						</li>

					</ul>

				</form>

		</div> <!-- End span12 -->

	</div> <!-- end row -->

	<div class="container list list-striped">

	<?php foreach($lme_mails as $lme_mail) { 
	?>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span10">
						<p><?php echo $lme_mail->email ?></p>
					</div>
					<div class="align-right">
						<p>
							<a href="<?php echo current_url().'/'. $lme_mail->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
	</div>
<?php } ?>
