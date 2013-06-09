<div id="footer"><hr />
	<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
		<tr>
			<td valign="top" class="leftcolumn"><b>' . $this->getUserdata('first_name') . ' ' . $this->getUserdata('last_name') . '</b></td>
			<td valign="bottom"><b>' . $this->getMailText('thanks', $lang) . '</b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
		</tr><tr>
			<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="' . param('param_company_name') . '" style="margin-top:5px;"></td>
			<td valign="top">' . $this->getUserdata('company') . ' <br/>' . param('param_company_address') . ' &#124; ' . param('param_company_location') . ' <br /><a href="mailto:' . $this->getUserdata('email') . '">M: ' . $this->getUserdata('email') . '</a> &#124; <a href="tel:' . $this->getUserdata('phone') . '">T: ' . $this->getUserdata('phone') . '</a> &#124; F: ' . param('param_company_fax') . '</td>
		</tr>
	</table></div></div></body></html>