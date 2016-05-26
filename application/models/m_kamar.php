<?php
class M_kamar extends CI_Model{
    private $table="kamar";
    private $primary="id_kamar";
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
	function getPegawai(){
        $query=$this->db->query("select * from pegawai where jabatan_pegawai='Housekeeping'");
        return $query;
    }
	function getPegawai2(){
        $query=$this->db->query("select * from pegawai where jabatan_pegawai='Housekeeping'");
        return $query;
    }
	function semua4($data){
		$this->db->from("useinventaris");
        $this->db->where(array("id_kamar"=>$data));
        return $this->db->get()->result();
    }
	function getInventory(){
        $query=$this->db->query("select * from inventaris ");
        return $query;
    }
    function getAnggota(){
        return $this->db->get("bed");
    }
	function getTipeKamar(){
        return $this->db->get("tipe_kamar");
    }
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    function detail_pinjam($id){
        $this->db->select("*");
        $this->db->from("kamar");
        $this->db->where("id_kamar",$id);
        return $this->db->get();
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
        $this->db->or_like("id_kamar",$cari);
        return $this->db->get($this->table);
    }
	function insertTo($tablename,$data)
	{
		$this->db->insert($tablename,$data);
	}
	function getDatum($tablename,$data)
	{
		$this->db->select("*");
		$this->db->from($tablename);
		$this->db->where($data);
		return $this->db->get()->result();
	}
	function updateDatum($tablename,$kondition,$data)
	{
		$this->db->where($kondition);
		$this->db->update($tablename,$data);
	}
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
}