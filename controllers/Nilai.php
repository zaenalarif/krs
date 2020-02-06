<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	/*Fungsi Index Dipanggil ketika null method
	link http://localhost/API.CI/index.php/Api/
	sehingga otomatis akan menjalankan index*/
    public function index() {
        $this->load->view('hidden');
	}

	/* Fungsi view 
	untuk melihat semua data pada database table tbl_admin
	untuk mengakses fungsi ini, kita menggunakan method get
	dan parameter header
	1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	hasilnya berupa json username dan nama lengkap

	link http://localhost/API.CI/index.php/Nilai/view
	*/
	public function view() {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->NilaiModel->view_all_nilai();
	    			json_output($response['status'],$resp);
		        } else {
		        	json_output($response['status'],$response);
		        }

			}
		}
	}
    
    /*Fungsi detail view
    fungsi ini untuk membaca data dengan id
    sehingga urlnya akan menjadi seperti berikut ini :
    http://localhost/API.CI/index.php/Nilai/detail/28
    dengan parameter header:
    1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	dengan method GET
    */
    public function detail($id='') {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' ){ //|| $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} elseif ($id == "") {
			json_output(401,array('status' => 401,'message' => 'Unauthorized Value'));
		} 
		else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->NilaiModel->view_detail_data($id);
					json_output($response['status'],$resp);
		        } else {
		        	json_output($response['status'],$response);
		        }
			}
		}
	}

	/* Fungsi create
	digunakan untuk menambahkan data dengan metode POST
	serta value Header :
	1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	dan juga value Body

	link : http://localhost/API.CI/index.php/nilai/create
	*/
	public function create() {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					if ($params['nim'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Nim can\'t empty');
					} elseif ($params['kd_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Matakuliah can\'t empty');
					} elseif ($params['kd_dosen'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Dosen can\'t empty');
					} elseif ($params['kd_tahun'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Tahun can\'t empty');
					} elseif ($params['semester_ditempuh'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Semester ditempuh can\'t empty');
					} elseif ($params['grade'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Grade can\'t empty');
					} else {
		        		$resp = $this->NilaiModel->nilai_create_data($params);
					}
					json_output($respStatus,$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

	/*
	Fungsi Update data
	link : hhttp://localhost/API.CI/index.php/nilai/update/29
	ganteng adalah username
	Menthod menggunakan PUT
	dengan body
	nama_lengkap : updatedata
	dan header 
	1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	*/
	public function update($id) {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'PUT' ){//|| $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					//$params['updated_at'] = date('Y-m-d H:i:s');
					if ($id == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'ID can\'t empty');
					} elseif ($params['nim'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Nim can\'t empty');
					} elseif ($params['kd_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Matakuliah can\'t empty');
					} elseif ($params['kd_dosen'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Dosen can\'t empty');
					} elseif ($params['kd_tahun'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Tahun can\'t empty');
					} elseif ($params['semester_ditempuh'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Semester ditempuh can\'t empty');
					} elseif ($params['grade'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Grade can\'t empty');
					} else {
		        		$resp = $this->NilaiModel->nilai_update_data($id,$params);
					}
					json_output($respStatus,$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

	/*Fungsi untuk mendelete data
	link : http://localhost/API.CI/index.php/nilai/delete/4
	methode : Delete
	Header : 
	1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token

	hasil json status dan message
	*/
	public function delete($id) {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' ){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->NilaiModel->nilai_delete_data($id);
					json_output($response['status'],$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

}

?>
      