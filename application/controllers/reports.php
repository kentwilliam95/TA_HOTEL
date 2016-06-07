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
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->basic->getData("pegawai",Array("username"=>$this->session->userdata("username")));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
		$hasil = Array();
		$temp = $this->basic->getData("pengeluaran",null);
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_kategoripengeluaran,$row->id_pengeluaran,$row->tanggal,$row->nominal,$row->keterangan));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaran"] = $hasil;
		
		$temp = $this->basic->getData("payroll",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_penggajian,$row->tgl_pengajian,$row->id_pegawai,$row->gajipokok,$row->bonus,$row->description,$row->overtime,$row->total_gaji));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranPayroll"] = $hasil;
		
		$temp = $this->basic->getData("pembayaran",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_checkin,$row->no_debit,$row->akun_bayar,$row->jumlah,$row->terbayar,$row->sisa,$row->id_promo,$row->status_pembayaran,$row->jenis_pembayaran));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranIncome"] = $hasil;
		
		
		$temp = $this->basic->getData("inventaris",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_kategoriinventaris,$row->id_item,$row->nama_item,$row->start_guarantee,$row->end_guarantee));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranInventaris"] = $hasil;
		
		
		$data['title']="The Hotel Reports";
		$data['message']="";
		$this->template->display("Reports/rep_pembayaran",$data);
		
		//$this->load->view("Reports/rep_pembayaran",$data);
	}
}
?>