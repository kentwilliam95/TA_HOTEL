<?php
class M_payment extends CI_Model{
    private $table="depositoawal";
    private $primary="id_checkin";
    
	 function nootomatis(){
        $today=date('Ymd');
        $query=mysql_query("select max(id_reservasi) as last from reservasi where id_reservasi like '$today%'");
        $data=mysql_fetch_array($query);
        $lastNoFaktur=$data['last'];
        
        $lastNoUrut=substr($lastNoFaktur,8,3);
        
        $nextNoUrut=$lastNoUrut+1;
        
        $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
        
        return $nextNoTransaksi;
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
	function AllData()
	{
		$this->db->select("*");
		$this->db->from("booked_room");
		$this->db->join("pembayaran","booked_room.id_checkin = pembayaran.id_checkin");
		$this->db->join("promo","promo.id_promo=pembayaran.id_promo");
		
		return $this->db->get()->result();
	}
	function dataLaundry($checkinID)
	{
		$this->db->select("*");
		$this->db->from("uselaundy");
		$this->db->where("id_checkin",$checkinID);
		return $this->db->get()->result();
	}
	function dataRestaurant($checkinID)
	{
		$this->db->select("*");
		$this->db->from("userestaurant");
		$this->db->where("id_checkin",$checkinID);
		return $this->db->get()->result();
	}
	function updateData($tablename,$data,$titleName,$titlevalue)
	{
		$this->db->where($titleName,$titlevalue);
		$this->db->update($tablename,$data);
	}
	function cariMenu($kode){
		$query=$this->db->query("select * from booked_room,pembayaran,promo where booked_room.id_checkin = pembayaran.id_checkin   and promo.id_promo=pembayaran.id_promo and booked_room.id_kamar='$kode'");
        return $query;
    }
	function pencarianbuku($cari){
			$query=$this->db->query("select * from booked_room,pembayaran,promo where booked_room.id_checkin = pembayaran.id_checkin   and promo.id_promo=pembayaran.id_promo and booked_room.id_kamar like '%$cari%'");
        return $query;
    }
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
	function deleteData($tablename,$conditions)
	{
		$this->db->where($conditions);
		$this->db->delete($tablename);
	}
	function getData($tablename,$conditions)
	{
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($conditions);
		return $this->db->get()->result();
	}
}