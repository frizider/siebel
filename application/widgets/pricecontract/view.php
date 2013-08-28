<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
	<div class="header">
		<h3>
			<?php echo $title; ?>
			<span class="tools pull-right">
				<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/new') ?>" class="add"><i class="icon-plus"></i></a>
				<a href="<?php echo site_url($boxId.'/customer/'.$customernumber) ?>" class="manage"><i class="icon-cog"></i></a>
				<a class="move"><i class="icon-move"></i></a>
			</span>
		</h3>
	</div>
	<div class="content randomborder">
		<div>
			<div class="row-fluid">
				<ul class="nav nav-pills">
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('from') . ' - ' . $this->siebel->getLang('until')); ?></a></li>
					<li class="span2"><a>&nbsp;</a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('total')); ?></a></li>
					<li class="span2"><a><?php echo ucfirst($this->siebel->getLang('rest')); ?></a></li>
					<li class="span3"><a><?php echo ucfirst($this->siebel->getLang('correction')); ?></a></li>
				</ul>
			</div>

			<div class="contractlist">

			<?php foreach($pricecontracts_content as $item) { ?>

				<div class="<?php echo ($item->closed == 1) ? 'opacity50' : '' ?> <?php echo ($item->active == 1) ? 'active' : '' ?>">
					<div class="row-fluid heading">

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
									<span class="pull-left text-right tools">
										<a href="<?php echo site_url($boxId.'/customer/'.$customernumber.'/'. $item->id); ?>" class="edit"><i class="icon-pencil"></i></a>
									</span>
								</small>
								<small><?php echo date('d/m/Y', mysql_to_unix($item->date)) ?> </small>
							</h3>
						</div>

					</div>

					<div class="contract">
						<div class="row-fluid contractdata">
							<div class="span12" data-toggle="collapse" href="#contractsalesline_<?php echo $item->id ?>">
								<div class="row-fluid">

									<div class="span2">
										<p>
											<?php echo date('d/m/Y', mysql_to_unix($item->startdate)) ?>
											<br />
											<?php echo date('d/m/Y', mysql_to_unix($item->enddate)) ?>
										</p>
									</div>
									<div class="span2">
										<p class="txt-blue">
											<small>
												<strong>
													<?php echo ucfirst($this->siebel->getLang('ordered')) ?> ton:
													<br/>
													<?php echo ucfirst($this->siebel->getLang('delivered')) ?> ton:
												</strong>
											</small>
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
											<?php echo round($item->starttonnage - $item->ordertonnage + $item->lurk, 2) ?>
											<br/>
											<?php echo round($item->starttonnage - $item->deliveredtonnage + $item->lurk, 2) ?>
										</p>
									</div>

								</div>
								<div class="row-fluid">
									<div class="span2">
										<p class="txt-blue"><strong><?php echo ucfirst($this->siebel->getLang('comment')) ?></strong></p>
									</div>
									<div class="span10">
										<p><?php echo $item->comment ?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid salesdata accordion-body collapse" id="contractsalesline_<?php echo $item->id ?>">
							<div class="span12">
								<div class="row-fluid salesorder salesheader">
										<div class="span12">
											<div class="row-fluid">
												<div class="span3">
													<p>
														<strong><?php echo ucfirst($this->siebel->getLang('salesorder')); ?></strong>
													</p>
												</div>
												<div class="span3">
													<p>
														<?php echo ucfirst($this->siebel->getLang('reference')); ?>
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

								foreach($item->salesorders as $salesorder){
								?>
									<div class="row-fluid salesorder" data-toggle="collapse" href="#salesorder_<?php echo trim($salesorder->$sonumber) ?>">
										<div class="span12">
											<div class="row-fluid">
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
														<?php echo trim($salesorder->deliveredtonnage) ?>
													</p>
												</div>
											</div>
											<div class="row-fluid saleslines accordion-body collapse" id="salesorder_<?php echo trim($salesorder->$sonumber) ?>">
												<div class="span12">
													<div class="well">
														<div class="fluid">

															<div class="salesheader">
																<div class="row-fluid">
																		<div class="span3">
																			<p>
																				<strong><?php echo ucfirst($this->siebel->getLang('line')) ?></strong>
																				<br>
																				<?php echo ucfirst($this->siebel->getLang('bill') . ' - ' . $this->siebel->getLang('transport')) ?>
																			</p>
																		</div>
																		<div class="span3">
																			<p>
																				<?php echo ucfirst($this->siebel->getLang('product')) ?>
																				<br>
																				<?php echo ucfirst($this->siebel->getLang('reference')) ?>
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

																<?php foreach($salesorder->orderlines as $orderline){ ?>
																	<div class="row-fluid">
																		<div class="span3">
																			<p>
																				<strong><?php echo trim($orderline->$linenumber) ?></strong>
																				<br>
																				<?php echo 'F# '.trim($orderline->invoice) .' T# '. trim($orderline->transport)?>
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
		</div>
	</div>
</div>
