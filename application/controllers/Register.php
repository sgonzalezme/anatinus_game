<?php

Class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('UserModel');
    }

    public function index() {
        if(isset($this->session->userdata['logged_in'])) {
            // TODO redirect to the game
            show_error('Nope yet');
        }

        if($this->input->method() == 'post') {
            $this->registerNewUser();
        } else {
            $this->load->view('templates/head_common');
            $this->load->view('templates/header');
            $this->load->view('register/index', array());
            $this->load->view('templates/footer');
        }
    }


    private function registerNewUser() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('repeat_password', 'Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/head_common');
            $this->load->view('templates/header');
            $this->load->view('register/index');
            $this->load->view('templates/footer');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->UserModel->createUser($username, $password);
            if ($result == TRUE) {
                redirect('/login/index');
            } else {
                $data['message_display'] = 'There was some error';
                $this->load->view('register/index', $data);
            }
        }
    }
}
