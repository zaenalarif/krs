<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahunAjaranModel extends CI_Model {

    /*Fungsi view all admin
    untuk melihat semua data pada tabel tbl_thn_ajaran*/
    public function view_all_tahunajaran() {
        return $this->db->select('kd_tahun, keterangan')->from('tbl_thn_ajaran')->order_by('kd_tahun','desc')->get()->result();
    }

    /*Fungsi view detail
    untuk melihat data secara mendetail pada tabel tbl_thn_ajaran*/
    public function view_detail_data($kd_tahun) { 
        return $this->db->select('kd_tahun, keterangan, tgl_kul, tgl_awal_perwalian, tgl_akhir_perwalian, stts')->from('tbl_thn_ajaran')->where('kd_tahun',$kd_tahun)->order_by('kd_tahun','desc')->get()->row();
    }

    /*Fungsi insert data pada database tbl_thn_ajaran*/
    public function tahunajaran_create_data($data) {
        $this->db->insert('tbl_thn_ajaran',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    /*Fungsi update data berdasarkan kd_tahun*/
    public function tahunajaran_update_data($kd_tahun,$data) {
        $this->db->where('kd_tahun',$kd_tahun)->update('tbl_thn_ajaran',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    /*Fungsi Deleted data bedasarkan nim*/
    public function tahunajaran_delete_data($kd_tahun) {
        $this->db->where('kd_tahun',$kd_tahun)->delete('tbl_thn_ajaran');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
