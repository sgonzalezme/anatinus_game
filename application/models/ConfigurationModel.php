<?php

class ConfigurationModel extends CI_Model {
	public function __construct() {
		$this->load->database ();
        parent::__construct();
    }

	public function getAllConfiguration() {
		$sql = 'SELECT *
				FROM configuration
				WHERE configuration.active = 1';
		$stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        return $config;
	}

	public function getUploadPath() {
		$sql = 'SELECT value
				FROM configuration
				WHERE configuration.path = "upload_path"';
		$stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        if($config){
            $config = $config[0]['value'];
        }

        return $config;
	}

	public function getAdminDomain() {
		$sql = 'SELECT value
				FROM configuration
				WHERE configuration.path = "admin_domain"';
		$stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        if($config){
            $config = $config[0]['value'];
        }

        return $config;
	}

	public function getDomain() {
		$sql = 'SELECT value
				FROM configuration
				WHERE configuration.path = "domain"';
		$stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        if($config){
            $config = $config[0]['value'];
        }

        return $config;
	}

	public function getApiKey() {
		$sql = 'SELECT value
				FROM configuration
				WHERE configuration.path = "api_key"';
		$stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        if($config){
            $config = $config[0]['value'];
        }

        return $config;
	}

	public function getApiUrl() {
		$sql = 'SELECT value
				FROM configuration
				WHERE configuration.path = "api_url"';
		$stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        if($config){
            $config = $config[0]['value'];
        }

        return $config;
	}

    public function getAvailableEmotions() {
        $sql = 'SELECT value
				FROM configuration
				WHERE configuration.path = "available_emotions"';
        $stmt = $this->db->query ( $sql );
        $config = $stmt->result_array();

        if($config){
            $config = $config[0]['value'];
            $config = json_decode($config);
        }

        return $config;
    }


	
}