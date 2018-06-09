<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
        $this->load->library('session');
		$this->load->model('PictureModel');
	}

	public function index(){
        if (!isset($this->session->userdata['logged_in']) ||
            !$this->session->userdata['logged_in']){
            redirect('/login/index');
        }

	    /** @var array $pictures */
	    $pictures = $this->PictureModel->getAllPictures();

		$data = array(
		    'pictures' => $pictures
        );
		$this->load->view('templates/head_common');
		$this->load->view('templates/header');
		$this->load->view('gallery/index', $data);
		$this->load->view('templates/footer');
	}

	
}
