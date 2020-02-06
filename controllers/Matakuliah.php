<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

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

	link http://localhost/API.CI/index.php/Matakuliah/view
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
		        	$resp = $this->MatakuliahModel->view();
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
    http://localhost/API.CI/index.php/Matakuliah/detail/28
    dengan parameter header:
    1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	dengan method GET
    */
    public function detail($kd_mk='') {
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
		        	$resp = $this->MatakuliahModel->detail($kd_mk);
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

	link : http://localhost/API.CI/index.php/Matakuliah/create
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
					if ($params['kd_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode can\'t empty');
					} elseif ($params['nama_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Nama Matakuliah can\'t empty');
					} elseif ($params['jum_sks'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Jumlah SKS can\'t empty');
					} elseif ($params['semester'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Semester can\'t empty');
					} elseif ($params['prasyarat_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Pra Syarat Matakuliah can\'t empty');
					} elseif ($params['kode_jur'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Jurusan can\'t empty');
					} else {
		        		$resp = $this->MatakuliahModel->create($params);
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
	link : hhttp://localhost/API.CI/index.php/Matakuliah/update/29
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
	public function update($kd_mk) {
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
					if ($kd_mk == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode can\'t empty');
					} elseif ($params['nama_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Nama Matakuliah can\'t empty');
					} elseif ($params['jum_sks'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Jumlah SKS can\'t empty');
					} elseif ($params['semester'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Semester can\'t empty');
					} elseif ($params['prasyarat_mk'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Pra Syarat Matakuliah can\'t empty');
					} elseif ($params['kode_jur'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Jurusan can\'t empty');
					} else {
		        		$resp = $this->MatakuliahModel->update($kd_mk,$params);
					}
					json_output($respStatus,$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

	/*Fungsi untuk mendelete data
	link : http://localhost/API.CI/index.php/Matakuliah/delete/4
	methode : Delete
	Header : 
	1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token

	hasil json status dan message
	*/
	public function delete($kd_mk) {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' ){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MatakuliahModel->delete($kd_mk);
					json_output($response['status'],$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

}

?>
      