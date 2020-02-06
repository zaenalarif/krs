<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenModel extends CI_Model {

    public function view() {
        return $this->db->select('kd_dosen, nama_dosen')->from('tbl_dosen')->order_by('kd_dosen','desc')->get()->result();
    }

    public function detail($kd_dosen) { 
        return $this->db->select('kd_dosen, nidn, nama_dosen')->from('tbl_dosen')->where('kd_dosen',$kd_dosen)->order_by('kd_dosen','desc')->get()->row();
    }

    public function create($data) {
        $this->db->insert('tbl_dosen',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function update($kd_dosen,$data) {
        $this->db->where('kd_dosen',$kd_dosen)->update('tbl_dosen',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function delete($kd_dosen) {
        $this->db->where('kd_dosen',$kd_dosen)->delete('tbl_dosen');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
