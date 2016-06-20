<?php
class M_blockingroom extends CI_Model{
    private $table="booked_room";
    private $primary="id_reservasi";
    
	 function nootomatis(){
        $today=date('Ymd');
		//echo $today;
        $query="select max(substr(id_reservasi,9,3)) as last from reservasi where substr(id_reservasi,1,8) =".$today;
		
		$data = $this->db->query($query);
        //print_r($data->result());
		$temp = $data->result()[0]->last;
		//print $temp;
        if(!empty($temp))
		{
			$lastNoUrut=$temp;
			//print intval($lastNoUrut);
			$nextNoUrut=$lastNoUrut+1;
			//print $nextNoUrut;
			if(count($nextNoUrut) ==1)
			{
				$nextNoUrut = "00".$nextNoUrut;
			}
			else if(count($nextNoUrut) == 2)
			{
				$nextNoUrut = "0".$nextNoUrut;
			}
			return $today.$nextNoUrut;
		}
		else
		{
			//echo "hahah";
			return $today."001";
		}
	}
	function semua2(){
        $query=$this->db->query("select * from reservasi re,useroom ur where ur.id_reservasi = re.id_reservasi and ur.id_useroom not in(select id_useroom from booked_room) and re.status_reservasi='Fixed'");
        return $query;
    }
	function carikamar($data){
        $this->db->select("*");
		$this->db->from("kamar");
		$this->db->where($data);
		return $this->db->get()->result();
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
    function cariMenu($kode){
		$query=$this->db->query("select * from reservasi re,useroom ur where ur.id_reservasi = re.id_reservasi and re.nama_reservasi='$kode' and ur.id_useroom not in(select id_useroom from booked_room)");
        return $query;
    }
	function pencarianbuku($cari){
		$query=$this->db->query("select * from reservasi re,useroom ur where ur.id_reservasi = re.id_reservasi and re.nama_reservasi like'%$cari%' and ur.id_useroom not in(select id_useroom from booked_room)");
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
    
    function simpan($jenis){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }
	function update($id_kamar){
        $query=$this->db->query("update kamar set Status='BLOCKED' where id_kamar='$id_kamar'");
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