<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {

    /*Fungsi view all admin
    untuk melihat semua data pada tabel tbl_mahasiswa*/
    public function view_all_mahasiswa() {
        return $this->db->select('nim, nama_mahasiswa')->from('tbl_mahasiswa')->order_by('nim','desc')->get()->result();
    }

    /*Fungsi view detail
    untuk melihat data secara mendetail pada tabel tbl_mahasiswa*/
    public function view_detail_data($nim) { 
        return $this->db->select('nim, nama_mahasiswa, angkatan, jurusan, kelas_program')->from('tbl_mahasiswa')->where('nim',$nim)->order_by('nim','desc')->get()->row();
    }

    /*Fungsi insert data pada database tbl_mahasiswa*/
    public function mahasiswa_create_data($data) {
        $this->db->insert('tbl_mahasiswa',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    /*Fungsi update data berdasarkan nim*/
    public function mahasiswa_update_data($nim,$data) {
        $this->db->where('nim',$nim)->update('tbl_mahasiswa',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    /*Fungsi Deleted data bedasarkan nim*/
    public function mahasiswa_delete_data($nim) {
        $this->db->where('nim',$nim)->delete('tbl_mahasiswa');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
