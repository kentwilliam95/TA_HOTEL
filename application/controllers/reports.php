<?php
class reports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("basic");
		$this->load->library("template");
	}
	
	function index()
	{
		$hasil = Array();
		$temp = $this->basic->getData("pengeluaran",null);
		foreach($temp as $row)
		{

			Array_push($hasil,Array($row->id_kategoripengeluaran,$row->id_pengeluaran,$row->tanggal,$row->nominal,$row->keterangan));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaran"] = $hasil;
		
		$temp = $this->basic->getData("payroll",null);
		$data['title']="The Hotel Reports";
		$data['message']="";
		//$this->template->display("Reports/rep_pembayaran",$data);
		$this->load->view("Reports/rep_pembayaran",$data);
	}
}
?>