<div id="content">
	
	<p>Hereby the LME for today:</p>
	<p>&nbsp;</p>
	<style>
		td {padding: 3px;}
		thead td {
			background: #5698c4;
			color: #FFFFFF;
		}
	</style>
	<table>
		<thead>
			<tr>
				<td><strong>Exchange</strong></td>
				<td colspan="2"><strong>Cash</strong></td>
				<td colspan="2"><strong>3 Month</strong></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo number_format($lme['exchange'], 4, '.', ' '); ?></td>
				<td>$ <?php echo number_format($lme['cash'], 2, '.', ' '); ?></td>
				<td>€ <?php echo number_format(round($lme['cash']/$lme['exchange'], 2), 2, '.', ' '); ?></td>
				<td>$ <?php echo number_format($lme['mth'], 2, '.', ' '); ?></td>
				<td>€ <?php echo number_format(round($lme['mth']/$lme['exchange'], 2), 2, '.', ' '); ?></td>
			</tr>
		</tbody>
	</table>
	<p>&nbsp;</p>
	<?php 
	/*
	$link_overview = site_url('lme/report');
	$link_overview = str_replace('aliweb', 'customer.aliplast.com', $link_overview);
	 */
	$link_delete = site_url('lme/mail/'.$id .'/delete');
	$link_delete = str_replace('aliweb', 'customer.aliplast.com', $link_delete);
	?>
	<!--
	<p>
		For a historical overview, click here: <br>
		<a href="<?php echo $link_overview ?>"><?php echo $link_overview ?></a>
	</p>
	-->
	<p>
		If you wish to unsubscribe from this mail list, please reply to this email with your request.
		<!--
		If you wish to unsubscribe from this mail list, click here: <br>
		<a href="<?php echo $link_delete ?>"><?php echo $link_delete ?></a>
		-->
	</p>
	
</div>
