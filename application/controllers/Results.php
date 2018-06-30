<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->model('GameModel');
		$this->load->model('UserModel');
	}

	public function index(){
        if (!isset($this->session->userdata['logged_in']) ||
            !$this->session->userdata['logged_in']){
            redirect('/login/index');
        }
        /** @var array $connected_user */
        $connected_user = $this->session->userdata('logged_in');
        /** @var array $user */
        $user = $this->UserModel->getUserById($connected_user['user_id']);
        /** @var array $user_games */
        $user_games = $this->GameModel->getResultsFromUser($user['user_id']);

        $data = array(
            'games'     => $user_games,
            'username'  => $user['username']
        );
        $this->load->view('templates/head_common');
        $this->load->view('templates/header');
        $this->load->view('results/user', $data);
        $this->load->view('templates/footer');
	}


}
