<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NilaiModel extends CI_Model {

    /*Fungsi view all admin
    untuk melihat semua data pada tabel tbl_nilai*/
    public function view_all_nilai() {
        return $this->db->select('id, nim, kd_mk')->from('tbl_nilai')->order_by('id','desc')->get()->result();
    }

    /*Fungsi view detail
    untuk melihat data secara mendetail pada tabel tbl_perwalian_detail*/
    public function view_detail_data($id) { 
        return $this->db->select('id, nim, kd_mk, kd_dosen, kd_tahun, semester_ditempuh, grade')->from('tbl_nilai')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    /*Fungsi insert data pada database tbl_perwalian_detail*/
    public function nilai_create_data($data) {
        $this->db->insert('tbl_nilai',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    /*Fungsi update data berdasarkan nim*/
    public function nilai_update_data($id,$data) {
        $this->db->where('id',$id)->update('tbl_nilai',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    /*Fungsi Deleted data bedasarkan nim*/
    public function nilai_delete_data($id) {
        $this->db->where('id',$id)->delete('tbl_nilai');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
