<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messenger_model extends CI_Model
{

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
	
	/* *********************************************************************
	 * Other function below this section
	 */
	
	public function getContacts($department = FALSE) {
		$dbContact = $this->load->database('contact', TRUE);
		if($department)
		{
			$dbContact->where($department, 1);
		}
		$dbContact->where(param('param_asw_database_column_contact_state').' != ', 99);
		$contacts = $dbContact->get(param('param_asw_database_table_contact'))->result_array();
		
		foreach($contacts as $contact)
		{
			$contact['RELANG'] = $this->siebel->getCustomerdata(trim($contact['RECUNO']), param('param_asw_database_column_customerlang'));
			$contactlist[] = $contact;
		}
		
		return $contactlist;
	}
	
	public function getMailText($short, $language) {
		$dbDefault = $this->load->database('default', TRUE);
		$dbDefault->select($language);
		$dbDefault->where('short', $short);
		$result = $dbDefault->get('mailtext')->row();
		return $result->$language;
	}

	public function sendMail($type, $subject, $content = array('custom' => FALSE, 'short' => FALSE), $lang, $to, $from = FALSE, $extra = FALSE) {
		$ci = & get_instance();

		$ci->load->library('email');
		$ci->email->set_crlf("\r\n");

		$config['protocol'] = 'SMTP';
		$config['mailtype'] = 'html';
		$config['newline'] = '\n';
		$ci->email->initialize($config);

		if ($from) {
			$ci->email->from(param('param_mailhost'), $from);
		} else {
			$ci->email->from(param('param_mailhost'), $ci->ion_auth->getUserdata('first_name') . ' ' . $ci->ion_auth->getUserdata('last_name') . ' @ ' . param('param_company_name'));
		}
		$ci->email->to($to);
		$ci->email->reply_to($ci->ion_auth->getUserdata('email'));
		$ci->email->bcc($ci->ion_auth->getUserdata('email'));

		$mail = ($content['custom']) ? $content['custom'] : $this->getMailText($content['short'], $lang);
		$message = $ci->load->view('mail/htmlheader', $data) . '<div id="content">' . $mail . '</div>' . $ci->load->view('mail/htmlfooter', $data);

		$ci->email->subject($subject);
		$ci->email->message($message);

		if ($ci->email->send()) {
			$email = ($from) ? $from : $ci->ion_auth->getUserdata('email');
			if ($this->set_return_to_sender($email, $type, $extra)) {
				return TRUE;
			};
		};
	}

	public function newContactMail($customerNo, $lang, $md5) {
		$url = 'http://customer.aliplast.com/vp/siebel/index.php/newcustomer/' . $customerNo . '/' . $lang . '/' . $md5;
		$return = $this->getMailText('newcontact', $lang);
		$return .= '<p><a href="' . $url . '">' . $url . '</a></p>';

		return $return;
	}

	public function setReturnToSender($email, $type, $extra = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);
		$data = array(
			'email' => $email,
			'type' => $type,
			'extra' => $email
		);
		if ($dbDefault->insert('return_to_sender', $data)) {
			return TRUE;
		};
	}

	public function getReturnToSender($type, $extra = FALSE) {
		$dbDefault = $this->load->database('default', TRUE);

		$dbDefault->where('type', $type);
		if ($extra) {
			$dbDefault->where('extra', $extra);
		}
		$dbDefault->order_by('date', 'desc');
		$return = $dbDefault->get('return_to_sender')->result();

		return $return[0];
	}

}

/* End of file */