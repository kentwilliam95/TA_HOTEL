<?php
class M_promo extends CI_Model{
    private $table="promo";
    private $primary="id_promo";
    
	 function nootomatis(){
        $today=date('Ymd');
        $query=mysql_query("select max(id_promo) as last from promo");
        $data=mysql_fetch_array($query);
        $lastNoFaktur=$data['last'];
        
        $lastNoUrut=substr($lastNoFaktur,3,3);
        
        $nextNoUrut=$lastNoUrut+1;
		if ($nextNoUrut<10)
			return "PR"."000".$nextNoUrut;
		else if ($nextNoUrut>10)
			return "PR"."00".$nextNoUrut;
		else if ($nextNoUrut<100)
			return "PR"."0".$nextNoUrut;
       
    }
    function semua($limit=10,$offset=0,$order_column='id_promo',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
			
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
	// function semua($member){
        // return $this->db->query("select * from customer where status_member='Ya'");
    // }
    
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
        $this->db->or_like("nama_promo",$cari);
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