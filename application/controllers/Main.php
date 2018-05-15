<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{

		$data = array();//$this->common_model->get_pending_to_validation_to_php();
		$this->load->view('templates/head_common');
		$this->load->view('templates/header', $data);
		$this->load->view('main/index');
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */