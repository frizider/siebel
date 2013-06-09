<?php

/* *********************************************************************
 * Header:
 * Always in the bottom of this page 
 */
$this->load->view('include/header.php');


if($this->config->item('devmode') != 0) 
{
	if(isset($_POST) && !empty($_POST))
	{
		dev($_POST);
	}
};



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