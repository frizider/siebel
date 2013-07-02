<?php

/* *********************************************************************
 * Header:
 * Always in the top of this page 
 */
$this->load->view('include/header.php');



/* *********************************************************************
 * Devmode data:
 * Print out available variables and $_REQUEST data if is in devmode
 */
if($this->config->item('devmode') != 0) {$this->load->view('include/dev.php');};



/* *********************************************************************
 * Mainheading <h1>
 */
if ($this->ion_auth->logged_in())
{
	$this->load->view('include/mainheading.php');
}



/* *********************************************************************
 * Other content below this section
 */
$this->load->view($view);


/* *********************************************************************
 * Footer
 * Always in the bottom of this page 
 */
$this->load->view('include/footer.php');

/* End of file */
/* Location: ./application/views/DomainView.php */
?>