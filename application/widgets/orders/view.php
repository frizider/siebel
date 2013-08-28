<div class="<?php echo $boxClass; ?> widget" id="<?php echo $boxId; ?>" data-id="<?php echo $dataId; ?>">
	<div class="header">
		<h3>
			<?php echo $title; ?>
			<span class="tools pull-right">
				<a href="<?php echo site_url($boxId . '/customer/' . $customernumber . '/new') ?>" class="add"><i class="icon-plus"></i></a>
				<a href="<?php echo site_url($boxId . '/customer/' . $customernumber) ?>" class="manage"><i class="icon-cog"></i></a>
				<a class="move"><i class="icon-move"></i></a>
			</span>
		</h3>
	</div>
	<div class="content randomborder">
		<?php foreach($orders as $key => $value) { ?>
			<div>

				<div class="contractlist">

					<div>
						<div class="row-fluid heading">

							<div class="span12" data-toggle="collapse" href="#contractsalesline_<?php echo $key ?>">
								<h3>
									<strong><?php echo ucfirst($this->siebel->getLang($key)); ?></strong>
									<small class="pull-right text-right">
										<strong><?php echo $value->ordertonnage ?> ton</strong>
									</small>
								</h3>
							</div>

						</div>

						<div class="contract">

							<div class="row-fluid salesdata accordion-body collapse" id="contractsalesline_<?php echo $key ?>">
								<div class="span12">
									<div class="row-fluid salesorder salesheader">
										<div class="span12">
											<div class="row-fluid">
												<div class="span4">
													<p>
														<strong><?php echo ucfirst($this->siebel->getLang('salesorder')); ?></strong>
													</p>
												</div>
												<div class="span5">
													<p>
														<?php echo ucfirst($this->siebel->getLang('customer')); ?>
													</p>
												</div>
												<div class="span3">
													<p>
														<?php echo ucfirst($this->siebel->getLang('ordered')); ?>
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
									$cuno = param('param_asw_database_column_soh_customernumber');

									foreach ($value->salesorders as $salesorder) {
										?>
										<div class="row-fluid salesorder" data-toggle="collapse" href="#salesorder_<?php echo trim($salesorder->$sonumber) ?>">
											<div class="span12">
												<div class="row-fluid">
													<div class="span4">
														<p>
															<strong><?php echo trim($salesorder->$sonumber) ?></strong>
															<br>
															<?php echo trim($salesorder->$refcustomer) ?>
														</p>
													</div>
													<div class="span5">
														<p>
															<?php echo utf8_encode( trim($this->siebel->getCustomerdata($salesorder->$cuno, param('param_asw_database_column_customername'))) ) ?>
															<br>
															<?php echo trim($salesorder->$cuno) ?>
														</p>
													</div>
													<div class="span3">
														<p>
															<?php echo trim($salesorder->ordertonnage) ?>
														</p>
													</div>
												</div>
												<div class="row-fluid saleslines accordion-body collapse" id="salesorder_<?php echo trim($salesorder->$sonumber) ?>">
													<div class="span12">
														<div class="well">
															<div class="fluid">

																<div class="salesheader">
																	<div class="row-fluid">
																		<div class="span1">
																			<p>
																				<strong><?php echo ucfirst($this->siebel->getLang('line')) ?></strong>
																			</p>
																		</div>
																		<div class="span5">
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
																			</p>
																		</div>
																	</div>
																</div>

																<?php foreach ($salesorder->orderlines as $orderline) { ?>
																	<div class="row-fluid">
																		<div class="span1">
																			<p>
																				<strong><?php echo trim($orderline->$linenumber) ?></strong>
																			</p>
																		</div>
																		<div class="span5">
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

				</div>
			</div>
		<?php } ?>
	</div>
</div>
