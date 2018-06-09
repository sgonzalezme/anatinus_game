<?php

class ResultModel extends CI_Model {
	public function __construct() {
		$this->load->database ();
        parent::__construct();
    }

	public function getAllResults() {
		$sql = 'SELECT game.*, user.username as username
				FROM game
				LEFT JOIN user on game.user_id = user.user_id
				WHERE user.active is true';
		$stmt = $this->db->query ( $sql );
        $games = $stmt->result_array();

		return $games;
	}

	public function getResultsFromUser($user_id) {
		$sql = 'SELECT game.*, user.username as username
				FROM game
				LEFT JOIN user on game.user_id = user.user_id
				WHERE user.active is true and user.user_id = ?';
		$stmt = $this->db->query ( $sql, array($user_id));
        $games = $stmt->result_array();

		return $games;
	}

	
}