<?php
class M_payroll extends CI_Model{
    private $table="kategori_fb";
    private $primary="id_kategorifb";
    
	  function nootomatis(){
        $today=date('Ymd');
        $query=mysql_query("select max(id_kategorifb) as last from kategori_fb");
        $data=mysql_fetch_array($query);
        $lastNoFaktur=$data['last'];
        
        $lastNoUrut=substr($lastNoFaktur,3,3);
        
        $nextNoUrut=$lastNoUrut+1;
			return "KFB"."00".$nextNoUrut;
       
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
    function getPegawai(){
        return $this->db->get("pegawai");
    }
	function getAnggota(){
		$query=$this->db->query("select * from pegawai, payroll where pegawai.id_pegawai=payroll.id_pegawai");
        return $query;
    }
	function pencarianbuku($cari){
        $this->db->like("nama_pegawai",$cari);
        return $this->db->get("pegawai");
    }
    function cariItem($kode){
        $this->db->where("nama_pegawai",$kode);
        return $this->db->get("pegawai");
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