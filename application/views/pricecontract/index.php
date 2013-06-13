<div class="row">

	<div class="span12">

		<?= form_open(current_url(), array('class' => 'subnav')); ?>

		<ul class="nav nav-pills">
			<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('number')); ?></a></li>
			<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('until')); ?></a></li>
			<li class="span6"><a><?php echo ucfirst($this->siebel->getLang('comment')); ?></a></li>
			<li class="float-right align-right">
				<p>
					<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create')    ?></span>
				</p>
			</li>

		</ul>

		</form>

	</div> <!-- End span12 -->

</div> <!-- end row -->

<div class="container contractlist">

	<?php foreach ($items as $item) { ?>

		<div class="<?php echo ($item->close == 1) ? 'opacity50' : '' ?>">
			<div class="row heading">

				<div class="span12">
					<h3>
						<strong><?php echo $item->id ?></strong>
						<small class="pull-right">
							<span class="pull-left text-right">
								<strong>&euro; <?php echo $item->price ?></strong>
								<br />
								LME: <?php echo $item->lme ?> | 
								Pre: <?php echo $item->premium ?> | 
								Mup: <?php echo ($item->price - $item->lme - $item->premium) ?>
							</span>
							<span class="pull-left text-right">
								<a href="<?php echo current_url() . '/' . $item->id; ?>" class="link btn-small edit"><i class="icon-pencil"></i></a>
							</span>
						</small>
						<small><?php echo date('d/m/Y', mysql_to_unix($item->date)) ?> </small>
					</h3>
				</div>

			</div>

			<div class="contract">
				<div class="row contractdata">
					<div class="span12" data-toggle="collapse" href="#contractsalesline_<?php echo $item->id ?>">
						<div class="row">

							<div class="span2">
								<p>
									<?php echo date('d/m/Y', mysql_to_unix($item->startdate)) ?>
									<br />
									<?php echo date('d/m/Y', mysql_to_unix($item->enddate)) ?>
								</p>
							</div>
							<div class="span1">
								<p>
									<?php echo $item->starttonnage ?> ton
								</p>
							</div>
							<div class="span3">
								<p>
									<?php echo $item->ordertonnage ?>
									<br/>
									Tot geleverde ton
								</p>
							</div>
							<div class="span3">
								<p>
									<?php echo $item->starttonnage - $item->ordertonnage ?>
									<br/>
									rest ton geleverd
								</p>
							</div>
							<div class="span3">
								<p>
									<?php echo $item->starttonnage - $item->ordertonnage + $item->lurk ?>
									<br/>
									Sjoemel rest ton geleverd
								</p>
							</div>

						</div>
					</div>
				</div>
				<div class="row salesdata accordion-body collapse" id="contractsalesline_<?php echo $item->id ?>">
					<div class="span12">
						<?php 
						$sonumber = param('param_asw_database_column_soh_salesordernumber');
						$refcustomer = param('param_asw_database_column_soh_salesordernumbercostumer');
						$linenumber = param('param_asw_database_column_soline_line');
						$lineproduct = param('param_asw_database_column_soline_product');
						$lineproductref = param('param_asw_database_column_soline_product_customerreference');
						
						foreach($item->salesorders as $salesorder){
						?>
							<div class="row salesorder" data-toggle="collapse" href="#salesorder_<?php echo trim($salesorder->$sonumber) ?>">
								<div class="span12">
									<div class="row">
										<div class="span3">
											<p>
												<strong><?php echo trim($salesorder->$sonumber) ?></strong>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo trim($salesorder->$refcustomer) ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo trim($salesorder->ordertonnage) ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo 'geleverd tonnage' ?>
											</p>
										</div>
									</div>
									<div class="row saleslines accordion-body collapse" id="salesorder_<?php echo trim($salesorder->$sonumber) ?>">
										<div class="span12">
											<div class="well">
												<div class="fluid">
													
													<?php foreach($salesorder->orderlines as $orderline){ ?>
														<div class="row">
															<div class="span3">
																<p>
																	<strong><?php echo trim($orderline->$linenumber) ?></strong>
																	<br>
																	factuurnummer en transportnummer
																</p>
															</div>
															<div class="span3">
																<p>
																	<?php echo trim($orderline->$lineproduct) ?>
																	<br>
																	<?php echo trim($orderline->$lineproductref) ?>
																</p>
															</div>
															<div class="span3">
																<p>
																	lengte
																	<br>
																	afwerking
																</p>
															</div>
															<div class="span3">
																<p>
																	<?php echo trim($orderline->ordertonnage) ?>
																	<br>
																	geleverd
																</p>
															</div>
														</div>
													<?php } ?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
</div>
