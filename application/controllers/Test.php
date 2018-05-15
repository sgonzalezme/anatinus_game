<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		//$this->load->library('image_lib');
	}

	public function index(){
		$data = array();
		$this->load->view('templates/head_common');
		$this->load->view('templates/header');
		$this->load->view('test/test_index', $data);
		$this->load->view('templates/footer');
	}
	
	public function create(){
		try{
			if($this->input->method() == 'post'){
				$url = $_POST['url'];

				// api

                $curl = curl_init(API_URL . "?returnFaceId=false&returnFaceAttributes=emotion");
                $data = array(
                    'url' => $url
                );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true );
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Ocp-Apim-Subscription-Key: ' . API_KEY
                ));
                // TEMPORAL, por el https de la llamada a la api
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

                // Make the REST call, returning the result
                $curl_response = curl_exec($curl);
                $response = json_decode($curl_response, true);

                var_dump($response);

                curl_close($curl);

                // Build of the results
                $results = array();
                foreach ($response as $num => $face){
                    $emotions = $face['faceAttributes']['emotion'];
                    arsort($emotions);
                    reset($emotions);
                    $results[$num] = key($emotions);
                }

				$data = array();
				$data['results'] = $results;

				// -------

                $this->load->view('templates/head_common');
                $this->load->view('templates/header');
                $this->load->view('test/test_index', $data);
                $this->load->view('templates/footer');

				//redirect('/test');
	
			} else{
				$data = array();
	
				$this->load->view('templates/head_common');
				$this->load->view('templates/header');
				$this->load->view('test/test_create', $data);
				$this->load->view('templates/footer');
			}
		}
		catch(Exception $e){
			show_404();
		}
	}

	public function delete($id){
//		try{
//
//			$deleted = $this->brandModel->deleteBrand($id);
//			if($deleted){
//				redirect('/brands');
//			} else{
//				throw new Exception();
//			}
//
//		}
//		catch(Exception $e){
//			show_error('No se ha podido eliminar la marca #' . $id);
//		}
	}

	
}
