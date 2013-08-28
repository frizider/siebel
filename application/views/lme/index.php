<?php
if(isset($id) && !empty($id))
{
	$this->load->view('lme/edit');
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
								<input name="exchange" class="span1" placeholder="<?php echo ucfirst($this->siebel->getLang('exchange')); ?>" value="<?php echo $this->input->post('exchange') ?>">
							</p>
						</li>
						<li>
							<p>
								<input name="cash" class="span3" placeholder="Cash" value="<?php echo $this->input->post('cash') ?>">
							</p>
						</li>
						<li>
							<p>
								<input name="mth" class="span3" placeholder="3mth" value="<?php echo $this->input->post('mth') ?>">
							</p>
						</li>
						<li>
							<p>
								<input name="date" class="span3" placeholder="<?php echo ucfirst($this->siebel->getLang('date')); ?>" value="<?php echo $this->input->post('date') ?>">
							</p>
						</li>
						<li class="float-right align-right">
							<p>
								<button type="submit" class="btn btn-small btn-primary search submit"><i class="icon-search icon-white"></i></button>
								<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create') ?></span>
							</p>
						</li>

					</ul>

				</form>

		</div> <!-- End span12 -->

	</div> <!-- end row -->

	<div class="container list list-striped">

	<?php foreach($lmes as $lme) { 
	?>
		<div class="row">
			<div class="span12">
				<div class="row">
					<div class="span1">
						<p><?php echo number_format($lme->exchange, 4, '.', ' ') ?><br /></p>
					</div>
					<div class="span2">
						<p>
							$ <?php echo number_format(round($lme->cash, 2), 2, '.', ' ') ?><br />
						</p>
					</div>
					<div class="span2">
						<p>
							&euro; <?php echo number_format(round(($lme->cash/$lme->exchange), 2), 2, '.', ' ') ?><br />
						</p>
					</div>
					<div class="span2">
						<p>
							$ <?php echo number_format(round($lme->mth, 2), 2, '.', ' ') ?><br />
						</p>
					</div>
					<div class="span2">
						<p>
							&euro; <?php echo number_format(round(($lme->mth/$lme->exchange), 2), 2, '.', ' ') ?><br />
						</p>
					</div>
					<div class="span2">
						<p><?php echo date('d/m/Y',  mysql_to_unix($lme->date)) ?><br /></p>
					</div>
					<div class="align-right">
						<p>
							<a href="<?php echo current_url().'/'. $lme->id; ?>" class="btn btn-small edit"><i class="icon-pencil"></i></a>
						</p>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
	</div>
<?php } ?>
