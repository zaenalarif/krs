<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerwalianDetailModel extends CI_Model {

    /*Fungsi view all admin
    untuk melihat semua data pada tabel tbl_perwalian_detail*/
    public function view_all_perwaliandetail() {
        return $this->db->select('id, nim, kd_jadwal')->from('tbl_perwalian_detail')->order_by('nim','desc')->get()->result();
    }

    /*Fungsi view detail
    untuk melihat data secara mendetail pada tabel tbl_perwalian_detail*/
    public function view_detail_data($id) { 
        return $this->db->select('id, nim, kd_jadwal')->from('tbl_perwalian_detail')->where('id',$id)->order_by('nim','desc')->get()->row();
    }

    /*Fungsi insert data pada database tbl_perwalian_detail*/
    public function perwaliandetail_create_data($data) {
        $this->db->insert('tbl_perwalian_detail',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    /*Fungsi update data berdasarkan nim*/
    public function perwaliandetail_update_data($id,$data) {
        $this->db->where('id',$id)->update('tbl_perwalian_detail',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    /*Fungsi Deleted data bedasarkan nim*/
    public function perwaliandetail_delete_data($id) {
        $this->db->where('id',$id)->delete('tbl_perwalian_detail');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
