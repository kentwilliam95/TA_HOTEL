<?php
class M_upgrade extends CI_Model{
    private $table="reservasi";
    private $primary="id_reservasi";
	
    function semua2(){
		$this->db->select("*");
		$this->db->from("useroom");
		$this->db->join("reservasi","useroom.id_reservasi = reservasi.id_reservasi");
        $temp = Array("reservasi.status_reservasi"=>"Fixed");
		$this->db->where($temp);
        return $this->db->get()->result();
    }
	function ubah($info,$idtipe,$idbed){
        $query=$this->db->query("update useroom set id_tipekamar='$idtipe',id_bed='$idbed' where id_useroom='$info'");
        return $query;
    }
	function getAnggota(){
        return $this->db->get("bed");
    }
	function getTipeKamar(){
        return $this->db->get("tipe_kamar");
    }

    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
    
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    function updateRoom($tablename,$data,$condition)
	{
		
		$this->db->where("id_useroom",$condition);
		$this->db->update($tablename,$data);
	}
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
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
    
    function hapus($kode){
        $this->db->where($this->primary,$kode);
        $this->db->delete($this->table);
    }
    
    function cari($cari){
        $this->db->like($this->primary,$cari);
        $this->db->or_like("nama_item",$cari);
        return $this->db->get($this->table);
    }
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
}