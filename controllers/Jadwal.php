<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

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

	link http://localhost/API.CI/index.php/Jadwal/view
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
		        	$resp = $this->JadwalModel->view();
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
    http://localhost/API.CI/index.php/Jadwal/detail/28
    dengan parameter header:
    1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	dengan method GET
    */
    public function detail($kd_jadwal='') {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' ){ //|| $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} elseif ($kd_jadwal == "") {
			json_output(401,array('status' => 401,'message' => 'Unauthorized Value'));
		} 
		else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->JadwalModel->detail($kd_jadwal);
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

	link : http://localhost/API.CI/index.php/Jadwal/create
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
						$resp = array('status' => 400,'message' =>  'Kode Matakuliah can\'t empty');
					} elseif ($params['kd_dosen'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Dosen can\'t empty');
					} elseif ($params['kd_tahun'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Tahun can\'t empty');
					} elseif ($params['jadwal'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Jadwal can\'t empty');
					} elseif ($params['kapasitas'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kapasitas can\'t empty');
					} elseif ($params['kelas_program'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kelas Program can\'t empty');
					} elseif ($params['kelas'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kelas can\'t empty');
					} else {
		        		$resp = $this->JadwalModel->create($params);
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
	link : hhttp://localhost/API.CI/index.php/Jadwal/update/29
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
						$resp = array('status' => 400,'message' =>  'Kode Matakuliah can\'t empty');
					} elseif ($params['kd_dosen'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Dosen can\'t empty');
					} elseif ($params['kd_tahun'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kode Tahun can\'t empty');
					} elseif ($params['jadwal'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Jadwal can\'t empty');
					} elseif ($params['kapasitas'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kapasitas can\'t empty');
					} elseif ($params['kelas_program'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kelas Program can\'t empty');
					} elseif ($params['kelas'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kelas can\'t empty');
					} else {
		        		$resp = $this->JadwalModel->update($kd_mk,$params);
					}
					json_output($respStatus,$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

	/*Fungsi untuk mendelete data
	link : http://localhost/API.CI/index.php/Jadwal/delete/4
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
		        	$resp = $this->JadwalModel->delete($kd_mk);
					json_output($response['status'],$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

}

?>
      