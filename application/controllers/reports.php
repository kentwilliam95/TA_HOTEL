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
		
		
		$temp = $this->basic->getData("inventaris",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_kategoriinventaris,$row->id_item,$row->nama_item,$row->start_guarantee,$row->end_guarantee));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranInventaris"] = $hasil;
		
		$temp =$this->basic->getDataReportReservasi();
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_reservasi,$row->nama_reservasi,$row->tgl_checkin,$row->tgl_reservasi,$row->tgl_checkout,$row->status_reservasi));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranReservasi"] = $hasil;
		
	    $temp =$this->basic->getData("menu_restaurant",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_penyajian,$row->tgl_sajian,$row->id_menu,$row->nama_menu,$row->id_chef,$row->id_kategorifb,$row->status));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranMenurestaurant"] = $hasil;

		$temp =$this->basic->getData("userestaurant",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_menu,$row->id_checkin,$row->jumlah,$row->subtotal,$row->total,$row->id_userestaurant));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranUserestaurant"] = $hasil;
		
		$temp =$this->basic->getData("kamar",null);
		$hasil = Array();
		foreach($temp as $row)
		{
			Array_push($hasil,Array($row->id_tipekamar,$row->id_bed,$row->id_kamar,$row->Status,$row->Times));
		}
		$hasil = json_encode($hasil);
		$data["DataPengeluaranKamar"] = $hasil;
		
		$data['title']="The Hotel Reports";
		$data['message']="";
		$this->template->display("Reports/index",$data);
		
		//$this->load->view("Reports/rep_pembayaran",$data);
	}
	
	
}
?>