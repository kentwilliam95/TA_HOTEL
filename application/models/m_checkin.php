<?php
class M_checkin extends CI_Model{
    private $table="booked_room";
    private $primary="id_reservasi";
    
    function nootomatis(){
        $today=date('Ymd');
		//echo $today;
        $query="select max(substr(id_checkin,9,3)) as last from checkin where substr(id_checkin,1,8) =".$today;
		
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
		$query=$this->db->query("select * from booked_room br where id_checkin not in (select id_checkin from checkin) and Status='Blocked'");
        return $query;
    }
	function carikamar($tipekamar,$tipebed){
        $this->db->where(array("id_tipekamar"=>$tipekamar,"id_bed"=>$tipebed,"Status"=>"VACANT READY"));
		$this->db->from("kamar");
        return $this->db->get()->result();
    }
	function carikamar2($tipekamar,$tipebed){
        $query=$this->db->query("select k.*,b.status from kamar k,booked_room b where k.id_kamar not in (select b.id_kamar from booked_room)");
        return $query;
    }
	 function simpan($idcheckin,$tglcheckin,$tglcheckin2,$tglcheckout,$passengers,$idtipekamar,$idbed,$nama,$status,$idkamar){
		$query=$this->db->query("insert into booked_room(id_checkin,tgl_checkin,id_tipekamar,id_bed,passengers,nama_reservasi,status,tgl_checkout,tgl_masuk) values('$idcheckin','$tglcheckin2','$idtipekamar','$idbed','$passengers','$nama','$status','$tglcheckout','$tglcheckin') ");
        return $query;
    }
	function cariMenu($kode){
		$query=$this->db->query("select * from booked_room br where id_checkin not in (select id_checkin from checkin) and Status='Blocked' and nama_reservasi='$kode'");
        return $query;
    }
	function pencarianbuku($cari){
		$query=$this->db->query("select * from booked_room br where id_checkin not in (select id_checkin from checkin) and Status='Blocked' and nama_reservasi like'%$cari%'");
        return $query;
    }
	function gettipebed(){
        return $this->db->get("bed")->result();
    }
	function gettipekamar(){
        return $this->db->get("tipe_kamar")->result();
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
    
    function batal($idcheckin,$tglcheckin,$info){
        $query=$this->db->query("update booked_room set status='Occupied',id_checkin='$idcheckin',tgl_checkin='$tglcheckin' where id_reservasi='$info'");
        return $query;
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
	//script halal
	function insertData($tablename,$data)
	{
		$this->db->insert($tablename,$data);
	}
	function getDataWhere($tablename,$conditions)
	{
		$this->db->select("*");
		$this->db->from($tablename);
		$this->db->where($conditions);
		return $this->db->get()->result();
	}
	 function updateValue($tablename,$conditions,$data)
	 {
		 $this->db->where($conditions);
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