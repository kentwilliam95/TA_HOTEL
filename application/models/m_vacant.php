<?php
class M_vacant extends CI_Model{
    private $table="booked_room";
    private $primary="id_kamar";
	
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
      function semua2(){
        $query=$this->db->query("select k.id_kamar,c.tgl_checkin,c.tgl_checkout,k.Status from kamar k,checkin c where k.Status like '%VACANT%' and k.id_kamar=c.id_kamar");
        return $query;
    }
	 function semua3(){
        $query=$this->db->query("select k.id_kamar,c.tgl_checkin,c.tgl_checkout,k.Status from kamar k,checkin c where k.Status like '%Vacant%' and k.id_kamar=c.id_kamar and k.id_tipekamar like '%Standard%' ");
        return $query;
    }
	 function semua4(){
         $query=$this->db->query("select k.id_kamar,c.tgl_checkin,c.tgl_checkout,k.Status from kamar k,checkin c where k.Status like '%Vacant%' and k.id_kamar=c.id_kamar and k.id_tipekamar like '%Superior%' ");
        return $query;
    }
	 function semua5(){
         $query=$this->db->query("select k.id_kamar,c.tgl_checkin,c.tgl_checkout,k.Status from kamar k,checkin c where k.Status like '%Vacant%' and k.id_kamar=c.id_kamar and k.id_tipekamar like '%Deluxe%' ");
        return $query;
    }
	function jumlah(){
        return $this->db->count_all($this->table);
    }
	 function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
     function tampilBuku($no){
        $query=$this->db->query("select * from kamar where id_kamar like'%$no%'");
        return $query;
    }
     
    function simpan($jenis){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }
	
    function update($kode,$jenis){
        $this->db->where($this->primary,$kode);
        $this->db->update($this->table,$jenis);
    }
    function cari($cari){
        $query=$this->db->query("select * from booked_room where id_kamar like'%$cari%' and status like '%Vacant%'");
        return $query;
    }
   
    function cari_by_nis($nis){
        $query=$this->db->query("select * from kamar where id_kamar like'%$nis%'");
        return $query;
    }
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
}