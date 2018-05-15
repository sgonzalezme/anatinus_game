<?php

Class Game extends CI_Controller {

    const NUM_ANSWERS = 3;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('PictureModel');
        $this->load->model('GameModel');
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
        if (!isset($this->session->userdata['logged_in']) ||
            !$this->session->userdata['logged_in']){
            redirect('/login/index');
        }
        if($this->input->method() == 'post') {
            $number_of_options = intval($this->input->post('number'));
            $images = $this->PictureModel->getRandomImages($number_of_options);

            $game_options = array();
            foreach ($images as $image){
                $answers = $this->getAnswersArray($image['emotion']);
                $game_options[] = array('image' => $image, 'answers' => $answers);
            }

            $this->session->set_userdata('game', $game_options);

            $this->load->view('templates/head_common');
            $this->load->view('templates/header');
            $this->load->view('game/start', array('options' => $game_options));
            $this->load->view('templates/footer');

        } else {
            show_404();
        }
    }

    public function resolve(){
        if (!isset($this->session->userdata['logged_in']) ||
            !$this->session->userdata['logged_in']){
            redirect('/login/index');
        }
        if($this->input->method() == 'post') {
            $answers = $this->input->post();
            $game = $this->session->userdata('game');
            $user = $this->session->userdata('logged_in');

            $results = array();
            $total_questions = count($game);
            $right_answers = 0;
            foreach ($game as $position => $question) {
                $image_emotion = $question['image']['emotion'];
                $answered_emotion = $answers["answer_$position"];
                $result = strcmp($answered_emotion, $image_emotion) == 0;
                if($result){
                    $right_answers++;
                }
                $results[$position] = array(
                    'image' => $image_emotion,
                    'answered' => $answered_emotion,
                    'result' => $result
                );
            }

            $this->GameModel->saveScore($user['user_id'], $right_answers, $total_questions);

            $data = array(
                'options' => $game,
                'results' => $results,
                'score'   => $right_answers,
                'total'   => $total_questions
            );

            $this->load->view('templates/head_common');
            $this->load->view('templates/header');
            $this->load->view('game/results', $data);
            $this->load->view('templates/footer');

        } else {
            show_404();
        }
    }

    private function getAnswersArray($right_answer){
        $all_sorted_emotions = EMOTIONS;
        shuffle($all_sorted_emotions);
        $sorted_emotions = array_slice($all_sorted_emotions, 0, self::NUM_ANSWERS);

        if(!in_array($right_answer, $sorted_emotions)){
            $sorted_emotions[0] = $right_answer;
            shuffle($sorted_emotions);
        }
        return $sorted_emotions;
    }

}
