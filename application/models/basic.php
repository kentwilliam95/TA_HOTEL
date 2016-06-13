<?php 
class basic extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getData($tablename,$conditions)
	{
		if($conditions == null)
		{
			return $this->db->get($tablename)->result();
		}
		else
		{
			$this->db->where($conditions);
			return $this->db->get($tablename)->result();	
		}
		
	}
	function insertData($tablename,$data)
	{
		$this->db->insert($tablename,$data);
	}
	public function getDataReportReservasi()
	{
		$this->db->select ("*");
		$this->db->from("reservasi");
		$this->db->join("useroom","useroom.id_reservasi = reservasi.id_reservasi");
		return $this->db->get()->result();
	}
}

?>