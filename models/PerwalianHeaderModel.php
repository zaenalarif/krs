<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerwalianHeaderModel extends CI_Model {

    /*Fungsi view all admin
    untuk melihat semua data pada tabel tbl_perwalian_header*/
    public function view_all_perwalianheader() {
        return $this->db->select('nim, tgl_perwalian')->from('tbl_perwalian_header')->order_by('nim','desc')->get()->result();
    }

    /*Fungsi view detail
    untuk melihat data secara mendetail pada tabel tbl_perwalian_header*/
    public function view_detail_data($nim) { 
        return $this->db->select('nim, tgl_perwalian, tgl_persetujuan, status, semester')->from('tbl_perwalian_header')->where('nim',$nim)->order_by('nim','desc')->get()->row();
    }

    /*Fungsi insert data pada database tbl_perwalian_header*/
    public function perwalianheader_create_data($data) {
        $this->db->insert('tbl_perwalian_header',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    /*Fungsi update data berdasarkan nim*/
    public function perwalianheader_update_data($nim,$data) {
        $this->db->where('nim',$nim)->update('tbl_perwalian_header',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    /*Fungsi Deleted data bedasarkan nim*/
    public function perwalianheader_delete_data($nim) {
        $this->db->where('nim',$nim)->delete('tbl_perwalian_header');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
