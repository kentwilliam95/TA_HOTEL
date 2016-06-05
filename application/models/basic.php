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
}

?>