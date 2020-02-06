<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    /*Fungsi Method Login
    untuk melakukan login dengan parameter username dan password
    Pengecekkan dimulai ada atau tidaknya user tersebut.
    Jika ada maka akan diteruskan ke pengecekkan password
    namun jika tidak ada akan menampilkan json error
    dengan status dan message.

    pada pengecekkan password, input pertama mengalami enskripsi
    kemudian dilanjutkan pengecekan pada database dan jika benar
    akan menampilkan json :
    status, message, id dan token 
    serta menyimpan token tersebut pada tbl_users_authentication
    namun jika salah akan menampilkan error dengan json :
    status dan message*/
    public function login($username, $password) {
        $q  = $this->db->select('password,id,nim')->from('tbl_users')->where('username',$username)->get()->row();
        if($q == ""){
            return array('status' => 204,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
            $nim             = $q->nim;

            // echo $hashed_password." true ".crypt($password, $hashed_password)
            // ." >>> ".hash_equals($hashed_password, crypt($password, $hashed_password));
            // echo "ini".hash_equals($hashed_password, crypt($password, $hashed_password));
            // $1$Dtqyvz7/$B54yWIpYvDUixvWvJOwhp1 true 
            // $1$Dtqyvz7/$xFbAP/sDh7IkPoHg0WOOE0
            // $1$Dtqyvz7/$xFbAP/sDh7IkPoHg0WOOE0
            // $1$Dtqyvz7/$xFbAP/sDh7IkPoHg0WOOE0

            // $db1 = "1234567891011";
            // $value2 = "122344";
            // 123456 ==> $1064.m7bMkqk
            // 12AsNtCgHE/rE
            // echo "hasilnya adalah ".crypt($db1)."\n";
            // echo "hasilnya adalah ".crypt($value2, $db1);

            $passwordMD5 = substr( md5($password), 0, 32);

            if (hash_equals($hashed_password, $passwordMD5)) {
            // if (hash_equals($hashed_password, crypt($password, $hashed_password))) {

               $last_login = date('Y-m-d H:i:s');

               $token = substr( md5(rand()), 0, 7);
               // $token = crypt($password,substr( md5(rand()), 0, 7));
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));

               $this->db->trans_start();
               $this->db->where('id',$id)->update('tbl_users',array('last_login' => $last_login));
               $this->db->insert('tbl_users_authentication',array('users_id' => $id,
                                    'token' => $token,'expired_at' => $expired_at));

               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');

               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token, 'nim' => $nim);

               }
            } else {
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    /*Fungsi Logout
    Fungsi ini bertugas untuk melakukan logout
    step by stepnya
    kita akan menghapus token pada tbl_users_authentication
    dengan parameter header User-ID dan Authorization
    jika berhasil maka akan menampilkan json status dan message*/
    public function logout() {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);

        if ($users_id == ""){
            return array('status' => 204,'message' => 'Headers ID is Null.');
        } elseif ($token == "") {
            return array('status' => 204,'message' => 'headers Auth is Null.');
        } else {
            $this->db->where('users_id',$users_id)->where('token',$token)->delete('tbl_users_authentication');
            return array('status' => 200,'message' => 'Successfully logout.');
        }
    }

}
