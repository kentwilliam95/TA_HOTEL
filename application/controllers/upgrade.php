<?php
class upgrade extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_upgrade');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_reservasi',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_upgrade->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_reservasi';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['reservasi']=$this->m_upgrade->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Upgrade Kamar";
        $data['reserved']=$this->m_upgrade->semua2();
		//print_r($data["reserved"]);
		$data['anggota']=$this->m_upgrade->getAnggota()->result();
		$data['tipekamar']=$this->m_upgrade->getTipeKamar()->result();
        $config['base_url']=site_url('upgrade/index/');
        $config['total_rows']=$this->m_upgrade->jumlah();
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
            $this->template->display('upgrade/index',$data);
		  	$info=$this->input->post('no');
			$idtipe=$this->input->post('idtipe');
			$idbed=$this->input->post('idbed');
            $this->m_upgrade->ubah($info,$idtipe,$idbed);
		 
    }
    
    function cariMenu(){
        $kode=$this->input->post('cari22');
        $buku=$this->m_upgrade->cariMenu($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_reservasi']."|".$buku['tgl_checkin']."|".$buku['tgl_checkout'];
        }
    }
   
    
    function pencarianbuku(){
        $cari=$this->input->post('cari22');
        $data['buku']=$this->m_upgrade->pencarianbuku($cari)->result();
        $this->load->view('upgrade/pencarianbuku',$data);
    }
  
    
	function change()
	{
		$kode = $this->input->post("kodeUseroom");
		$tipekamar = $this->input->post("KodeTipeKamar");
		$tipebed = $this->input->post("kodeTipeBed");
		$data = array("id_tipekamar"=>$tipekamar,"id_bed"=>$tipebed);
		$this->m_upgrade->updateRoom("useroom",$data,$kode);
		echo $kode.",".$tipekamar.",".$tipebed;
		redirect("upgrade/index");
	}
  
    function _set_rules(){
        $this->form_validation->set_rules('namareservasi','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckin','Harga reservasi','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglreservasi','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}
