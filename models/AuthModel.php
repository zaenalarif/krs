<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    var $client_service = "bagicode-client";
    var $auth_key       = "simplerestapi";

    /*Fungsi Method Check Auth Client
    untuk mengecek bagian header, 
    jika kosong maka akan menampilkan json dengan
    status dan message.
    jika benar maka akan mengembalikan value boolean true dan
    dilanjutkan ke fungsi lainnya*/
    public function check_auth_client(){
        $input_client_service = $this->input->get_request_header('Client_Service', TRUE);
        $input_auth_key  = $this->input->get_request_header('Auth_Key', TRUE);

        if($input_client_service == $this->client_service && $input_auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized Headers.'));
        }
    }

    /*Fungsi Auth
    berguna untuk melakukan pengecekkan token
    apakah token telah habis masa aktif (kadaluarsa) atau tidak
    parameter untuk fungsin ini adalah
    1. User-ID = Id User
    2. Authorization = Token User
    Hasil kembaliannya adalah status dan user*/
    public function auth() {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);

        if ($users_id == ""){
                return array('status' => 204,'message' => 'Headers ID is Null.');
                // return json_output(204,array('status' => 204,'message' => 'Headers ID is Null.'));
            } elseif ($token == "") {
                return array('status' => 204,'message' => 'headers Auth is Null.');
                // return json_output(204,array('status' => 204,'message' => 'headers Auth is Null.'));
            } else {
                $q  = $this->db->select('expired_at')->from('tbl_users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
                if($q == ""){
                    return array('status' => 401,'message' => 'Unauthorized.');
                    // return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
                } else {
                    if($q->expired_at < date('Y-m-d H:i:s')){
                        return array('status' => 401,'message' => 'Your session has been expired.');
                        // return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
                    } else {
                        $updated_at = date('Y-m-d H:i:s');
                        $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                        $this->db->where('users_id',$users_id)->where('token',$token)->update('tbl_users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                        return array('status' => 200,'message' => 'Authorized.');
                    }
                }
        }
    }

}
