<?php
class M_dinein extends CI_Model{
    private $table="menu_restaurant";
    
    function nootomatis(){
        $today=date('Ymd');
        $query=mysql_query("select max(id_penyajian) as last from menu_restaurant where id_penyajian like '$today%'");
        $data=mysql_fetch_array($query);
        $lastNoFaktur=$data['last'];
        
        $lastNoUrut=substr($lastNoFaktur,8,3);
        
        $nextNoUrut=$lastNoUrut+1;
        
        $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
        
        return "R".$nextNoTransaksi;
    }
    function semua2(){
        $query=$this->db->query("select * from restaurant");
        return $query;
    }
    function getAnggota(){
        return $this->db->get("chef");
    }
     function getKategori(){
        return $this->db->get("kategori_fb");
    }
    
    function cariAnggota($nis){
        $this->db->where("nis",$nis);
        return $this->db->get("anggota");
    }
    
    function simpanTmp($info){
        $this->db->insert("tmp",$info);
    }
    
    function tampilTmp(){
        return $this->db->get("tmp");
    }
    
    function cekTmp($kode){
        $this->db->where("id_menu",$kode);
        return $this->db->get("tmp");
    }
    
    function jumlahTmp(){
        return $this->db->count_all("tmp");
    }
  
    function hapusTmp($kode){
        $this->db->where("id_menu",$kode);
        $this->db->delete("tmp");
    }
    
    function simpan($info){
        $this->db->insert("menu_restaurant",$info);
    }
    function cari($cari){
        $query=$this->db->query("select * from restaurant where nama_menu like'%$cari%'");
        return $query;
	}
	function pencarianbuku($cari){
        $this->db->like("nama_menu",$cari);
        return $this->db->get("restaurant");
    }
    function cariMenu($kode){
        $this->db->where("nama_menu",$kode);
        return $this->db->get("restaurant");
    }
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
}