<?php
class M_expenses extends CI_Model{
    private $table="pengeluaran";
    private $primary="id_pengeluaran";
    
	   function nootomatis(){
        $today=date('Ymd');
		//echo $today;
        $query="select max(substr(id_pengeluaran,9,3)) as last from pengeluaran where substr(id_pengeluaran,1,8) =".$today;
		
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
	function getKategori(){
        return $this->db->get("kategori_pengeluaran");
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
        $this->db->or_like("nama_kategorifb",$cari);
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