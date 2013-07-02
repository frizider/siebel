<div class="row">

	<div class="span12">

		<?= form_open(current_url(), array('class' => 'subnav')); ?>

		<ul class="nav nav-pills">
			<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('from') . ' - ' . $this->siebel->getLang('until')); ?></a></li>
			<li class="span2"><a>&nbsp;</a></li>
			<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('total')); ?></a></li>
			<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('rest')); ?></a></li>
			<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('correction')); ?></a></li>
			<li class="float-right align-right">
				<p>
					<span class="btn btn-small create href" data-href="<?php echo current_url() ?>/new"><i class="icon-plus"></i> <?php //echo $this->siebel->getLang('create')    ?></span>
					<span class="btn btn-small print href" data-href="<?php echo site_url($module.'/toexcel/'.$customernumber) ?>"><i class="icon-print"></i> <?php //echo $this->siebel->getLang('print')    ?></span>
				</p>
			</li>

		</ul>

		</form>

	</div> <!-- End span12 -->

</div> <!-- end row -->

<div class="container contractlist">

	<?php
	// Test output
	/*
	foreach($items as $item) {
		foreach($item->salesorders as $salesorder) {
			foreach($salesorder->orderlines as $orderline) {
				echo $orderline->OLORNO.';'.$orderline->OLLINE.';'.$orderline->OLUNIT.';'.$orderline->ordertonnage.';'.$orderline->deliveredtonnage.';'.'<br/>';
			}
		}
	}
	 * 
	 */
	
	foreach ($items as $item) { ?>

		<div class="<?php echo ($item->closed == 1) ? 'opacity50' : '' ?> <?php echo ($item->active == 1) ? 'bg-orangelight' : '' ?>">
			<div class="row heading">

				<div class="span12">
					<h3>
						<strong><?php echo $item->id ?></strong>
						<small class="pull-right">
							<span class="pull-left text-right">
								<strong>&euro; <?php echo $item->price ?> - <?php echo $item->starttonnage ?> ton</strong>
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
							<div class="span2">
								<p class="txt-blue">
									<strong>
										<?php echo ucfirst($this->siebel->getLang('ordered')) ?> ton:
										<br/>
										<?php echo ucfirst($this->siebel->getLang('delivered')) ?> ton:
									</strong>
								</p>
							</div>
							<div class="span2">
								<p>
									<?php echo $item->ordertonnage ?>
									<br/>
									<?php echo $item->deliveredtonnage ?>
								</p>
							</div>
							<div class="span2">
								<p>
									<?php echo $item->starttonnage - $item->ordertonnage ?>
									<br/>
									<?php echo $item->starttonnage - $item->deliveredtonnage ?>
								</p>
							</div>
							<div class="span3">
								<p>
									<?php echo $item->starttonnage - $item->ordertonnage + $item->lurk ?>
									<br/>
									<?php echo $item->starttonnage - $item->deliveredtonnage + $item->lurk ?>
								</p>
							</div>

						</div>
					</div>
				</div>
				<div class="row salesdata accordion-body collapse" id="contractsalesline_<?php echo $item->id ?>">
					<div class="span12">
						<div class="row salesorder salesheader">
								<div class="span12">
									<div class="row">
										<div class="span3">
											<p>
												<strong><?php echo ucfirst($this->siebel->getLang('salesorder')); ?></strong>
												<br/>
												<?php echo ucfirst($this->siebel->getLang('reference')); ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo ucfirst($this->siebel->getLang('date')); ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo ucfirst($this->siebel->getLang('ordered')); ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo ucfirst($this->siebel->getLang('delivered')); ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php 
						$sonumber = param('param_asw_database_column_soh_salesordernumber');
						$refcustomer = param('param_asw_database_column_soh_salesordernumbercostumer');
						$linenumber = param('param_asw_database_column_soline_line');
						$lineproduct = param('param_asw_database_column_soline_product');
						$lineproductref = param('param_asw_database_column_soline_product_customerreference');
						$sodate = param('param_asw_database_column_soh_date');
						
						foreach($item->salesorders as $salesorder){
						?>
							<div class="row salesorder" data-toggle="collapse" href="#salesorder_<?php echo trim($salesorder->$sonumber) ?>">
								<div class="span12">
									<div class="row">
										<div class="span3">
											<p>
												<strong><?php echo trim($salesorder->$sonumber) ?></strong>
												<br/>
												<?php echo trim($salesorder->$refcustomer) ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo date('d/m/Y', mysql_to_unix(trim($salesorder->$sodate))) ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo trim($salesorder->ordertonnage) ?>
											</p>
										</div>
										<div class="span3">
											<p>
												<?php echo trim($salesorder->deliveredtonnage) ?>
											</p>
										</div>
									</div>
									<div class="row saleslines accordion-body collapse" id="salesorder_<?php echo trim($salesorder->$sonumber) ?>">
										<div class="span12">
											<div class="well">
												<div class="fluid">
													
													<div class="salesheader">
														<div class="row">
																<div class="span3">
																	<p>
																		<strong><?php echo ucfirst($this->siebel->getLang('line')) ?></strong>
																		<br>
																		<?php echo ucfirst($this->siebel->getLang('bill') . ' - ' . $this->siebel->getLang('date')) ?>
																		<br>
																		<?php echo ucfirst($this->siebel->getLang('transport') . ' - ' . $this->siebel->getLang('date')) ?>
																	</p>
																</div>
																<div class="span3">
																	<p>
																		<?php echo ucfirst($this->siebel->getLang('product')) ?>
																		<br>
																		<?php echo ucfirst($this->siebel->getLang('reference')) ?>
																		<br>
																		<?php echo ucfirst($this->siebel->getLang('promisdate')) ?>
																	</p>
																</div>
																<div class="span3">
																	<p>
																		<?php echo ucfirst($this->siebel->getLang('length')) ?>
																		<br>
																		<?php echo ucfirst($this->siebel->getLang('finish')) ?>
																	</p>
																</div>
																<div class="span3">
																	<p>
																		<?php echo ucfirst($this->siebel->getLang('ordered')) ?>
																		<br>
																		<?php echo ucfirst($this->siebel->getLang('delivered')) ?>
																	</p>
																</div>
															</div>
														</div>
													
														<?php foreach($salesorder->orderlines as $orderline){ 
															
														$backorder_line = param('param_asw_database_column_soline_backorderline');
														$backorder_line = trim($orderline->$backorder_line);
														$backorder = $backorder_line ? ' <i class="icon-link"></i> '.$backorder_line: '';
														$promisdate = param('param_asw_database_column_soline_promiseddate');

															?>
															<div class="row">
																<div class="span3">
																	<p>
																		<strong><?php echo trim($orderline->$linenumber) ?></strong>
																		<?php echo $backorder; ?>
																		<br>
																		<?php echo trim($orderline->invoice) .' - '. trim($orderline->invoicedate)?>
																		<br>
																		<?php echo trim($orderline->transport) .' - '. trim($orderline->transportdate)?>
																	</p>
																</div>
																<div class="span3">
																	<p>
																		<?php echo trim($orderline->$lineproduct) ?>
																		<br>
																		<?php echo trim($orderline->$lineproductref) ?>
																		<br>
																		<?php echo date('d/m/Y', mysql_to_unix(trim($orderline->$promisdate))) ?>
																	</p>
																</div>
																<div class="span3">
																	<p>
																		<?php echo trim($orderline->length) ?>
																		<br>
																		<?php echo trim($orderline->finish) ?>
																	</p>
																</div>
																<div class="span3">
																	<p>
																		<?php echo trim($orderline->ordertonnage) ?>
																		<br>
																		<?php echo trim($orderline->deliveredtonnage) ?>
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
