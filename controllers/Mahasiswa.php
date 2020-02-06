<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	/*Fungsi Index Dipanggil ketika null method
	link http://localhost/API.CI/index.php/Api/
	sehingga otomatis akan menjalankan index*/
    public function index() {
        echo "Selamat datang dihalaman API Bagicode Yes.";
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

	link http://localhost/API.CI/index.php/Mahasiswa/view
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
		        	$resp = $this->MahasiswaModel->view_all_mahasiswa();
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
    http://localhost/API.CI/index.php/Mahasiswa/detail/0960011001
    dengan parameter header:
    1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token
	dengan method GET
    */
    public function detail($nim='') {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' ){ //|| $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} elseif ($nim == "") {
			json_output(401,array('status' => 401,'message' => 'Unauthorized Value'));
		} 
		else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MahasiswaModel->view_detail_data($nim);
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
	nim, nama_mahasiswa, angkatan, jurusan dan kelas_program

	link : http://localhost/API.CI/index.php/Mahasiswa/create
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
					} elseif ($params['nama_mahasiswa'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Nama Mahasiswa  can\'t empty');
					} elseif ($params['angkatan'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Angkatan  can\'t empty');
					} elseif ($params['jurusan'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Jurusan  can\'t empty');
					} elseif ($params['kelas_program'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kelas Program  can\'t empty');
					} else {
		        		$resp = $this->MahasiswaModel->mahasiswa_create_data($params);
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
	link : http://localhost/API.CI/index.php/Mahasiswa/update/0960011003
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
	public function update($nim) {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'PUT' ){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					//$params['updated_at'] = date('Y-m-d H:i:s');
					if ($params['nama_mahasiswa'] == "") { 
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Nama mahasiwa can\'t empty');
					} elseif ($params['angkatan'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Angkatan can\'t empty');
					} elseif ($params['jurusan'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Jurusan can\'t empty');
					} elseif ($params['kelas_program'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Kelas Program can\'t empty');
					} else {
		        		$resp = $this->MahasiswaModel->mahasiswa_update_data($nim,$params);
					}
					json_output($respStatus,$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

	/*Fungsi untuk mendelete data
	link : http://localhost/API.CI/index.php/Mahasiswa/delete/0960011003
	methode : Delete
	Header : 
	1. Client_Service : bagicode-client
	2. Auth_Key : simplerestapi
	3. Content-Type : application/json
	4. User-ID : id username
	5. Authorization : Token

	hasil json status dan message
	*/
	public function delete($nim) {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' ){//|| $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->AuthModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MahasiswaModel->mahasiswa_delete_data($nim);
					json_output($response['status'],$resp);
		        } else {
		        	json_output($respStatus,$response);
		        }
			}
		}
	}

}

?>
      