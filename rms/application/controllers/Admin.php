<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -  
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in 
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->library('ion_auth');
		$this->load->library('hmw');
	}

	public function index()
	{		
		
		$this->hmw->keyLogin();
				
		$change_bu = $this->input->post('bus');
		if(!empty($change_bu)) { 
			$bu_info = $this->hmw->getBus($change_bu);
			$session_data = array('bu_id'  => $change_bu, 'bu_name' => $bu_info[0]->name);
			$this->hmw->updateUserBu($change_bu, $this->session->userdata('user_id')); 
			$this->session->set_userdata($session_data); 
		}
		$user = $this->ion_auth->user()->row();
		$user_groups = $this->ion_auth->get_users_groups()->result();
		$bus_list = $this->hmw->getBus(null, $user->id);

		$data = array(
			'user_groups'		=> $user_groups[0],
			'bus_list'			=> $bus_list,
			'bu_name'			=> $this->session->userdata('bu_name'),
			'bu_id'				=> $this->session->userdata('bu_id'),
			'ticket'			=> '',
			'last_ticket'		=> '',
			'username'			=> $user->username
		);
		
		$header['title'] = "Admin Hank";

	}

}
?>
