<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model {

    public function view() {
        return $this->db->select('kd_jadwal, jadwal')->from('tbl_jadwal')->order_by('kd_jadwal','desc')->get()->result();
    }

    public function detail($kd_jadwal) { 
        return $this->db->select('kd_jadwal, kd_mk, kd_dosen, kd_tahun, jadwal, kapasitas, kelas_program, kelas')->from('tbl_jadwal')->where('kd_jadwal',$kd_jadwal)->order_by('kd_jadwal','desc')->get()->row();
    }

    public function create($data) {
        $this->db->insert('tbl_jadwal',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function update($kd_jadwal,$data) {
        $this->db->where('kd_jadwal',$kd_jadwal)->update('tbl_jadwal',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function delete($kd_jadwal) {
        $this->db->where('kd_jadwal',$kd_jadwal)->delete('tbl_jadwal');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
