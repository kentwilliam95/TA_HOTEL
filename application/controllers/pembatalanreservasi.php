<?php
class pembatalanreservasi extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_pembatalanreservasi');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_reservasi',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_pembatalanreservasi->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_reservasi';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['reservasi']=$this->m_pembatalanreservasi->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Pembatalan Reservasi";
        $data['reserved']=$this->m_pembatalanreservasi->semua2();
        $config['base_url']=site_url('pembatalanreservasi/index/');
        $config['total_rows']=$this->m_pembatalanreservasi->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
		//print_r( $data['reserved']);
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('pembatalanreservasi/index',$data);
		   $info=$this->input->post('no');
           $this->m_pembatalanreservasi->batal($info);
		 
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_reservasi->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_reservasi->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_reservasi->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['reservasi']=$cek->result();
            $this->template->display('reservasi/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['reservasi']=$cek->result();
            $this->template->display('reservasi/cari',$data);
        }
    }
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_reservasi->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_reservasi->detail_pinjam($id)->result();
        $this->template->display('reservasi/detail_pinjam',$data);
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
	function batal()
	{
		if($this->input->post("answer")=="true")
		{
			$idReservasi = $this->input->post("nomorReservasi");
			//$this->m_pembatalanreservasi->update(array("status_reservasi"=>"Cancelled"),array("id_reservasi"=>$idReservasi));
		$this->m_pembatalanreservasi->deleteData("useroom",Array("id_useroom"=>$idReservasi));
			redirect("pembatalanreservasi/index");
		}
		else
		{
			redirect("pembatalanreservasi/index");
		}
	}
}
