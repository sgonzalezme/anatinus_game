<?php

Class Game extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        if (!isset($this->session->userdata['logged_in']) ||
                !$this->session->userdata['logged_in']){
            redirect('/login/index');
        }

        $this->load->view('templates/head_common');
        $this->load->view('templates/header');
        $this->load->view('game/index', array());
        $this->load->view('templates/footer');
    }

    public function start(){
        if($this->input->method() == 'post') {
            $options = $this->input->post('number');

            // TODO get $options random images
            var_dump(EMOTIONS);

        } else {
            show_404();
        }
    }


}
