<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Endpoint extends CI_Controller {

	/*Fungsi Index Dipanggil ketika null method
	link http://localhost/API.CI/index.php/Endpoint/
	sehingga otomatis akan menjalankan index*/
    public function index() {
        $this->load->view('endpoint');
	}

}

?>
      