<?php

class UserModel extends CI_Model {
	public function __construct() {
		$this->load->database ();
        parent::__construct();
    }

    public function createUser($username, $password){
	    $encoded_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO user
				( username, password )
				VALUES (?, ?)';
        $this->db->query ( $sql, array($username, $encoded_password));

        return  $this->db->insert_id();
    }

    public function login($username, $password){
        $sql = 'SELECT * FROM user
				WHERE username = ?';
        $statement = $this->db->query($sql, array($username));
        $result = $statement->row();

        if(empty($result)){
            return false;
        } else{
            $hashed_password = $result->password;
            $password_check = password_verify($password, $hashed_password);
            return $password_check;
        }
    }


	
}