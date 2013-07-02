<?php

$lang_edit = (isset($id) && !empty($id)) ? 'edit_' : '' ;
$heading_txt = (isset($module) && !empty($module)) ? $this->siebel->getLang($lang_edit.$module) : '';
$customername = (isset($customernumber) && !empty($customernumber)) ?  trim($this->siebel->getCustomerdata($customernumber, param('param_asw_database_column_customername'))) : '';	
$heading_small_extra = (isset($heading_small_extra) && !empty($heading_small_extra)) ?  $heading_small_extra : '';	
$heading_small = (!empty($customername) || !empty($customernumber)) ? $customername . ' | ' . $customernumber . $heading_small_extra : '';
$backbutton = ($module == 'dashboard' || $module == 'auth' || empty($module))? FALSE : '<a class="backbutton" title="Go back" href="' . site_url('dashboard/customer/' . $customernumber) . '"><span><i class="icon-chevron-left"></i></span></a> ';
$containerClassContent = (isset($containerClassContent) && !empty($containerClassContent)) ? $containerClassContent : '';
echo $this->bootstrap->heading(1, $heading_txt, $heading_small, $backbutton, $containerClassContent);
?>
