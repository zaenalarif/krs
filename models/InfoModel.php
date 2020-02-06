<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InfoModel extends CI_Model {

    public function view() {
        return $this->db->select('kd_info, judul, waktu_post')->from('tbl_info')->order_by('kd_info','desc')->get()->result();
    }

    public function detail($kd_info) { 
        return $this->db->select('kd_info, judul, waktu_post, isi')->from('tbl_info')->where('kd_info',$kd_info)->order_by('kd_info','desc')->get()->row();
    }

    public function create($data) {
        $this->db->insert('tbl_info',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function update($kd_info,$data) {
        $this->db->where('kd_info',$kd_info)->update('tbl_info',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function delete($kd_info) {
        $this->db->where('kd_info',$kd_info)->delete('tbl_info');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
