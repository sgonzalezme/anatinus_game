<?php

class PictureModel extends CI_Model {
	public function __construct() {
		$this->load->database ();
        parent::__construct();
    }

    public function saveImage($url, $emotion){

        // crear la entidad
        $sql = 'INSERT INTO images
				( url, emotion )
				VALUES (?, ?)';
        $this->db->query ( $sql, array($url, $emotion));

        return  $this->db->insert_id();

    }

	public function getAllPictures() {
		$sql = 'SELECT *
				FROM images
				WHERE active is true
				ORDER BY emotion';
		$stmt = $this->db->query ( $sql );
        $pictures = $stmt->result_array();

		return $pictures;
	}

    public function getRandomImages($number_of_images) {
        $sql = 'SELECT *
				FROM images
				WHERE active is true
				ORDER BY RAND()
				LIMIT ?';
        $stmt = $this->db->query ( $sql, array($number_of_images) );
        $pictures = $stmt->result_array();

        return $pictures;
    }




}