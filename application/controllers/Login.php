<?php

//session_start(); //we need to start session in order to access it through CI

Class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('UserModel');
    }

    public function index() {
        if (isset($this->session->userdata['logged_in']) &&
                $this->session->userdata['logged_in']){
            redirect('/game/index');
        }
        if($this->input->method() == 'post') {
            $this->logUser();
        } else {
            $this->load->view('templates/head_common');
            $this->load->view('templates/header');
            $this->load->view('login/index', array());
            $this->load->view('templates/footer');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('/login/index');
    }

    private function logUser() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->redirectToLoginForm();
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_id = $this->UserModel->login($username, $password);
            if ($user_id) {
                $this->session->set_userdata('logged_in', array('username' => $username, 'user_id' => $user_id));
                redirect('/game/index');
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->redirectToLoginForm($data);
            }
        }
    }

    private function redirectToLoginForm($data = array()){
        $this->load->view('templates/head_common');
        $this->load->view('templates/header');
        $this->load->view('login/index', $data);
        $this->load->view('templates/footer');
    }

}
