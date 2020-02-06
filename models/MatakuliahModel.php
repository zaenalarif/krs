<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MatakuliahModel extends CI_Model {

    public function view() {
        return $this->db->select('kd_mk, nama_mk')->from('tbl_mk')->order_by('kd_mk','desc')->get()->result();
    }

    public function detail($kd_mk) { 
        return $this->db->select('kd_mk, nama_mk, jum_sks, semester, prasyarat_mk, kode_jur')->from('tbl_mk')->where('kd_mk',$kd_mk)->order_by('kd_mk','desc')->get()->row();
    }

    public function create($data) {
        $this->db->insert('tbl_mk',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function update($kd_mk,$data) {
        $this->db->where('kd_mk',$kd_mk)->update('tbl_mk',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function delete($kd_mk) {
        $this->db->where('kd_mk',$kd_mk)->delete('tbl_mk');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
