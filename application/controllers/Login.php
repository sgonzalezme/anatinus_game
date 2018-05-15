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
            // TODO redirect to the game
            show_error('Nope yet');
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
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        redirect('/login/index');
    }

    private function logUser() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                // TODO redirect to the game
                show_error('Nope yet');
            }else{
                $this->redirectToLoginForm();
            }
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->UserModel->login($username, $password);
            if ($result) {
                $session_data = array(
                    'username' => $username,
                );
                $this->session->set_userdata('logged_in', $session_data);

                // TODO redirect to the game
                show_error('Nope yet');

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
