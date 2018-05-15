<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('PictureModel');
	}

	public function index(){

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
