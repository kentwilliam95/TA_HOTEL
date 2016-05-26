<?php
class M_reservasi extends CI_Model{
    private $table="reservasi";
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
        $this->db->select("*");
		$this->db->from("reservasi re");
		$this->db->join("useroom ur","ur.id_reservasi= re.id_reservasi");
		$this->db->order_by("re.id_reservasi","asc");
		return $this->db->get();
    }
    
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    function semua2(){
        $query=$this->db->query("select * from reservasi");
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
	function insertInto($tablename,$data)
	{
		$this->db->insert($tablename,$data);
	}
	function cariTipe($nama)
	{
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where("username",$nama);
		return $this->db->get()->result();
	}
}