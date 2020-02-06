<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenWaliModel extends CI_Model {

    public function view() {
        return $this->db->select('nim, kd_dosen')->from('tbl_dosen_wali')->order_by('nim','desc')->get()->result();
    }

    public function detail($nim) { 
        return $this->db->select('nim, kd_dosen')->from('tbl_dosen_wali')->where('nim',$nim)->order_by('nim','desc')->get()->row();
    }

    public function create($data) {
        $this->db->insert('tbl_dosen_wali',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function update($nim,$data) {
        $this->db->where('nim',$nim)->update('tbl_dosen_wali',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function delete($nim) {
        $this->db->where('nim',$nim)->delete('tbl_dosen_wali');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
