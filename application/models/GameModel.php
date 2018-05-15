<?php

class GameModel extends CI_Model {
	public function __construct() {
		$this->load->database ();
        parent::__construct();
    }

    public function saveScore($user_id, $right_answers, $total){
        $sql = 'INSERT INTO game
				( user_id, num_questions, right_answers, wrong_answers )
				VALUES (?, ?, ?, ?)';
        $this->db->query ( $sql, array($user_id, $total, $right_answers, intval($total-$right_answers)));

        return  $this->db->insert_id();
    }
	
}