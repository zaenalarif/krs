<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/*Fungsi Index Dipanggil ketika null method
	link http://localhost/API.CI/index.php/Api/
	sehingga otomatis akan menjalankan index*/
    public function index() {
        echo "Selamat datang dihalaman API Bagicode Yes.";
	}

	/*Fungsi ini dipanggil ketika link
	http://localhost/API.CI/index.php/Login/signin diakses
	syarat dari link ini adalah
	1. Fungsi Method Post
	2. Header value 
		Client_Service : bagicode-client
		Auth_Key : simplerestapi
		Content-Type : application/json
	3. Body value with raw JSON(application/json)
		username : user
		password : admin123
	jika benar maka akan menampilkan value json
	- status, message, id user, token
	jika salah maka akan menampilkan value json
	- status dan message */
	public function signin() {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else { 
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
				$params = json_decode(file_get_contents('php://input'), TRUE);
		        $username = $params['username'];
		        $password = $params['password'];
		        
		        $response = $this->LoginModel->login($username, $password);
				json_output($response['status'],$response);
			}
		}
	}

	/* Fungsi Logut
	fungsi ini digunakan saat user logout dari aplikasi
	semua parameter menggunakan headers
	User-ID : ID USERNAME
	Authorization : TOKEN DARI USER
	Content-Type : application/json
	Client_Service : bagicode-client
	Auth_Key : simplerestapi 

	link http://localhost/API.CI/index.php/Login/signout
	Method : POST
	*/
	public function signout() {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->LoginModel->logout();
				json_output($response['status'],$response);
			}
		}
	}

}

?>
      