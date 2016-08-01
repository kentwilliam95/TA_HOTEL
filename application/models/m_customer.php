<?php
class M_customer extends CI_Model{
    private $table="customer";
    private $primary="id_customer";
    
	 function nootomatis(){
        // $today=date('Ymd');
        // $query=mysql_query("select max(id_customer) as last from customer");
     // //   $data=mysql_fetch_array($query);
        // $lastNoFaktur=$data['last'];
        
        // $lastNoUrut=substr($lastNoFaktur,3,3);
        
        // $nextNoUrut=$lastNoUrut+1;
		// if ($nextNoUrut<10)
			// return "CU"."000".$nextNoUrut;
		// else if ($nextNoUrut>=10)
			// return "CU"."00".$nextNoUrut;
		// else if ($nextNoUrut>=100)
			// return "CU"."0".$nextNoUrut;
		// else if ($nextNoUrut>=1000)
			// return "CU".$nextNoUrut;
       
    }
	function semua2(){
		$query=$this->db->query("select * from booked_room where id_checkin not in(select id_checkin from customer)");
        return $query;
    }
	function detail_pinjam($id){
        $this->db->select("*");
        $this->db->from("customer");
        $this->db->where("id_customer",$id);
        return $this->db->get();
    }
    function semua($limit=10,$offset=0,$order_column='id_customer',$order_type='asc'){
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
        $this->db->or_like("nama_customer",$cari);
        return $this->db->get($this->table);
    }
	function cariMenu($kode){
		$query=$this->db->query("select c.id_checkin,r.nama_reservasi from checkin c,reservasi r where r.id_reservasi=c.id_reservasi and r.nama_reservasi='$kode'");
        return $query;
    }
	function pencarianbuku($cari){
		$query=$this->db->query("select c.id_checkin,r.nama_reservasi from checkin c,reservasi r where r.id_reservasi=c.id_reservasi and r.nama_reservasi like '%$cari%'");
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