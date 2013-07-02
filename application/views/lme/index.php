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
						<li class="span1"><a><?php echo ucfirst($this->siebel->getLang('exchange')); ?></a></li>
						<li class="span4"><a>Cash</a></li>
						<li class="span4"><a>3mth</a></li>
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
