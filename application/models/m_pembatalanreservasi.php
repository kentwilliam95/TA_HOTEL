<?php
class M_pembatalanreservasi extends CI_Model{
    private $table="reservasi";
    private $primary="id_reservasi";
	
    function semua2(){
       $this->db->select("*");
	   $this->db->from("reservasi");
	   $this->db->join("useroom","useroom.id_reservasi = reservasi.id_reservasi");
        return $this->db->get()->result();
    }
	function deleteData($tablename,$data)
	{
		$this->db->delete($tablename,$data);
	}
	function batal($info){
        $query=$this->db->query("update reservasi set status_reservasi='cancelled' where id_reservasi='$info'");
        return $query;
    }
	function getAnggota(){
        return $this->db->get("bed");
    }
	function getTipeKamar(){
        return $this->db->get("tipe_kamar");
    }
	function detail_pinjam($id){
        $this->db->select("*");
        $this->db->from("reservasi");
        $this->db->where("id_reservasi",$id);
        return $this->db->get();
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
    
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    
    function simpan($jenis){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }
    
    function update($data,$conditions){
        $this->db->where($conditions);
        $this->db->update($this->table,$data);
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