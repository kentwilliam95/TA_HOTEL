<?php
class M_petugas extends CI_Model{
    private $table="pegawai";
    
    function cek($username,$password){
        $this->db->where("id_pegawai",$username);
        $this->db->where("password_pegawai",$password);
        return $this->db->get("pegawai");
    }
    function cek2($username,$password){
       $query=$this->db->query("select tipe_pegawai from pegawai where username='$username' and password_pegawai='$password'");
        return $query->result();
    }
    
    function semua(){
        return $this->db->get("pegawai");
    }
    
    function cekKode($kode){
        $this->db->where("id_pegawai",$kode);
        return $this->db->get("pegawai");
    }
    
    function cekId($kode){
        $this->db->where("id_pegawai",$kode);
        return $this->db->get("pegawai");
    }
    
    function update($id,$info){
        $this->db->where("id_pegawai",$id);
        $this->db->update("pegawai",$info);
    }
    
    function simpan($info){
        $this->db->insert("pegawai",$info);
    }
    
    function hapus($kode){
        $this->db->where("id_pegawai",$kode);
        $this->db->delete("pegawai");
    }
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
}