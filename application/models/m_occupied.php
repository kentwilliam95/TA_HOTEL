<?php
class M_occupied extends CI_Model{
    private $table="booked_room";
    private $primary="id_kamar";
	
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
      // function semua2(){
        // $query=$this->db->query("select k.id_kamar,k.Status,br.id_checkin,k.status, ch.tgl_checkin,ch.tgl_checkout from kamar k left JOIN booked_room br ON br.id_kamar = k.id_Kamar left JOIN checkin ch ON ch.id_checkin = br.id_checkin order by k.status asc");
        // return $query;
    // }
	function semua2(){
        $query=$this->db->query("select id_kamar,id_tipekamar,id_bed,Status from kamar");
        return $query;
    }
	function jumlah(){
        return $this->db->count_all($this->table);
    }
	 function cek($kode){
        $this->db->from("kamar");
		$this->db->where($this->primary,$kode);
        $query=$this->db->get();
        
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
        $query=$this->db->query("select * from booked_room where id_kamar like'%$cari%' and status like '%Occupied%'");
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