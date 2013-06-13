<?php

$lang_edit = (isset($id) && !empty($id)) ? 'edit_' : '' ;
$heading_txt = $this->siebel->getLang($lang_edit.$module);
$customername = trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername')));	
$heading_small = $customername . ' | ' . $customernumber;
$backbutton = ($module == 'dashboard')? FALSE : '<a class="backbutton" title="Go back" href="' . site_url('dashboard/customer/' . $customernumber) . '"><span><i class="icon-chevron-left"></i></span></a> ';
echo $this->bootstrap->heading(1, $heading_txt, $heading_small, $backbutton);

?>
