<?php
class checkin extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload','table'));
        $this->load->model('m_checkin');
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_checkin',$order_type='asc'){
		
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_checkin->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_checkin';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['checkin']=$this->m_checkin->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Checkin";
		$data['noauto']=$this->m_checkin->nootomatis();
        $data['reserved']=$this->m_checkin->semua2()->result();
		
		$data['tglsajian']=date('d-m-Y');
        $config['base_url']=site_url('checkin/index/');
        $config['total_rows']=$this->m_checkin->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('checkin/index',$data);
			$info=$this->input->post('no');
			$idcheckin=$this->input->post('nomer');
			$tglcheckin=$this->input->post('tglsajian');
			$this->m_checkin->batal($idcheckin,$tglcheckin,$info);
    }
	
        function notreserved($offset=0,$order_column='id_checkin',$order_type='asc'){
			$hasil = $this->m_checkin->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_checkin';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['checkin']=$this->m_checkin->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Checkin";
		$data['noauto']=$this->m_checkin->nootomatis();
        $data['reserved']=$this->m_checkin->semua2()->result();
		$data['tglsajian']=date('d-m-Y');
        $data["tipekamar"]=$this->m_checkin->gettipekamar();
		$data["tipebed"]=$this->m_checkin->gettipebed();
        $data['message']='';
        $this->template->display('checkin/notreserved',$data);
    }
    function cariMenu(){
        $kode=$this->input->post('cari22');
        $buku=$this->m_checkin->cariMenu($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_reservasi']."|".$buku['tgl_checkin']."|".$buku['tgl_checkout'];
        }
    }
   
    
    function pencarianbuku(){
        $cari=$this->input->post('cari22');
        $data['buku']=$this->m_checkin->pencarianbuku($cari)->result();
        $this->load->view('checkin/pencarianbuku',$data);
    }
    
    function CariKamar()
	{
		$tipekamar = $this->input->post("tipekamar");
		$tipebed = $this->input->post("tipebed");
		$temp =$this->m_checkin->carikamar($tipekamar,$tipebed); 
		
		$this->table->set_heading("ID Kamar","Tipe Kamar","Tipe Bed");
		foreach($temp as $a)
		{
			$this->table->add_row($a->id_kamar,$a->id_tipekamar,$a->id_bed,'<a href="#" class="tambah" carikamar='.$a->id_kamar.'><i class="glyphicon glyphicon-plus"></i></a>');
		}
		echo $this->table->generate();
	}
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_checkin->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['checkin']=$cek->result();
            $this->template->display('checkin/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['checkin']=$cek->result();
            $this->template->display('checkin/cari',$data);
        }
    }
	function Simpan()
	{
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_checkin->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
	//	$hasil = $this->m_checkin->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		$id_checkin=$this->input->post("nomer");
		$id_reservasi=$this->input->post("no");
		$tgl_checkin=$this->input->post("tglcheckin");
		$tgl_checkout=$this->input->post("tglcheckout");
		$tipekamar = $this->input->post("tipekamar");
		$tipebed=$this->input->post("tipebed");
		$id_bookedRoom = $this->input->post("id_bookedRoom");
		$id_kamar = $this->m_checkin->getDataWhere("booked_room",array("id_reservasi"=>$id_reservasi));
		
			if(!empty($id_kamar))
			{
				$nomorKamar = $id_kamar[0]->id_kamar;
				
				$data = array("id_reservasi"=>$id_reservasi,"id_checkin"=>$id_checkin,"tgl_checkin"=>$tgl_checkin,"tgl_checkout"=>$tgl_checkout);
				$this->m_checkin->insertData("checkin",$data);
				$temp = $this->m_checkin->getDataWhere("kamar",Array("id_kamar"=>$id_kamar[0]->id_kamar));
				$temp = ($temp[0]->Times)+1;
				
				$this->m_checkin->updateValue("kamar",array("id_kamar"=>$nomorKamar),array("Status"=>"OCCUPIED","Times"=>$temp));
				
				$this->m_checkin->updateValue("booked_room",array("id_bookedRoom"=>$id_bookedRoom),array("id_kamar"=>$nomorKamar,"id_checkin"=>$id_checkin));
				$data['message']='<div class="alert alert-success"> Berhasil Input Data</div>';
			}
			else
			{
				$data['message']='<div class="alert alert-danger"> Kamar Habis </div>';
			}
		
		redirect("checkin/index");
		
	}
	
	function Simpan2()
	{
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_checkin->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		$id_checkin=$this->input->post("nomer");
		$id_reservasi=$this->input->post("no");
		$tgl_checkin=$this->input->post("tglcheckin");
		$tgl_checkout=$this->input->post("tglcheckout");
		$tipekamar = $this->input->post("tipekamar");
		$tipebed=$this->input->post("tipebed");
		$id_bookedRoom = $this->input->post("id_bookedRoom");
		$nama = $this->input->post("namareservasi");
		$jumlah = $this->input->post("jumlah");
		$nomorKamar = $this->input->post("carikamar");
		
		if($this->input->post("Simpan"))
		{
				if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_checkin->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
			
				$data = array("id_reservasi"=>$id_reservasi,"id_checkin"=>$id_checkin,"tgl_checkin"=>$tgl_checkin,"tgl_checkout"=>$tgl_checkout);
				$this->m_checkin->insertData("checkin",$data);
			
				$data = array("id_tipekamar"=>$tipekamar,"id_bed"=>$tipebed,"passengers"=>$jumlah,"Status"=>"Blocked","id_kamar"=>$nomorKamar,"nama_reservasi"=>$nama,"id_reservasi"=>$id_reservasi,"id_checkin"=>$id_checkin,"tgl_checkin"=>$tgl_checkin,"tgl_checkout"=>$tgl_checkout);
				$this->m_checkin->insertData("booked_room",$data);
				
				$this->m_checkin->updateValue("kamar",array("id_kamar"=>$nomorKamar),array("Status"=>"OCCUPIED"));
				$data['message']='<div class="alert alert-success"> Berhasil Input Data</div>';
			
		}
		$data['message']='';
		$data['title']="Checkin";
		$data['noauto']=$this->m_checkin->nootomatis();
		$data['reserved']=$this->m_checkin->semua2()->result();
		$data['tglsajian']=date('d-m-Y');
		$this->template->display('checkin/notreserved',$data);
		
	}
	
	function ShowKamar()
	{
		$reservasiId=$this->input->post("kode1");
		
		$id_kamar = $this->m_checkin->getDataWhere("booked_room",array("id_reservasi"=> $reservasiId));
		if(empty($id_kamar))
		{
			echo "Kamar Sudah tidak ada";
		}
		else
		{
			echo "Kamar nomor: ".$id_kamar[0]->id_kamar;
		}
		
	}
    function _set_rules(){
        $this->form_validation->set_rules('namacheckin','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckin','Harga checkin','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckin','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
	
}