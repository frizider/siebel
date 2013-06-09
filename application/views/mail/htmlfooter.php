<?php
echo'<div id="footer"><hr />
	<table border=0 cellspacing=0 cellpadding=0 width="100%" style="width:100%; border-collapse:collapse;" class="footer">
		<tr>
			<td valign="top" class="leftcolumn"><b>' . $this->ion_auth->getUserdata('first_name') . ' ' . $this->ion_auth->getUserdata('last_name') . '</b></td>
			<td valign="bottom"><b>' . $this->messenger_model->getMailText('thanks', $lang) . '</b> <span style="float:right; font-style: italic; text-align:right;">Think before you <img width=20 height=20 src="http://customer.aliplast.com/vp/public/img/mail_green_print.png" alt="">print</span></td>
		</tr><tr>
			<td valign="top" class="leftcolumn"><img border=0 width=113 height=24 src="http://customer.aliplast.com/vp/public/img/mail_logo_aliplast.jpg" alt="' . param('param_company_name') . '" style="margin-top:5px;"></td>
			<td valign="top">' . $this->ion_auth->getUserdata('company') . ' <br/>' . param('param_company_address') . ' &#124; ' . param('param_company_location') . ' <br /><a href="mailto:' . $this->ion_auth->getUserdata('email') . '">M: ' . $this->ion_auth->getUserdata('email') . '</a> &#124; <a href="tel:' . $this->ion_auth->getUserdata('phone') . '">T: ' . $this->ion_auth->getUserdata('phone') . '</a> &#124; F: ' . param('param_company_fax') . '</td>
		</tr>
	</table></div></div></body></html>';
?>