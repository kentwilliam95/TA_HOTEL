<?php
class blockingroom extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_blockingroom');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_reservasi',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_blockingroom->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        //load data
        $data['title']="Blocking Room";
        $data['reserved']=$this->m_blockingroom->semua2()->result();
		
		$tipekamar=$this->input->post('tipekamar');
		$tipebed=$this->input->post('tipebed');
		//$data['carikamar']=$this->m_blockingroom->carikamar($tipekamar,$tipebed)->result();
		$data['tglsajian']=date('d-m-Y');
		
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('blockingroom/index',$data);
    }
    function simpan()
	{
		$hasil = $this->m_blockingroom->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		$data['message']="";
		if($this->input->post("Simpan1"))
		{
			$tipekamar=$this->input->post('tipekamar');
			$tipebed=$this->input->post('tipebed');
			$dataArray=array("Status"=>"VACANT READY","id_tipekamar"=>$tipekamar,"id_bed"=>$tipebed);
			$idKamar = $this->m_blockingroom->carikamar($dataArray);
			
			if(empty($idKamar))
			{
				$data['message']="<div class='alert alert-danger'>Kamar tidak tersedia</div>";
			}
			else
			{
				
				$id_kamar = $idKamar[0]->id_kamar;
				$data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
				$info=array(
						'id_reservasi'=>$this->input->post('no'),
						'nama_reservasi'=>$this->input->post('namareservasi'),
						'tgl_reservasi'=>$this->input->post('tglreservasi'),
						'tgl_checkin'=>$this->input->post('tglcheckin'),
						'tgl_checkout'=>$this->input->post('tglcheckout'),
						'passengers'=>$this->input->post('jumlah'),
						'status'=>'Blocked',
						'id_tipekamar'=>$this->input->post('tipekamar'),
						'id_bed'=>$this->input->post('tipebed'),
						'id_kamar'=>$id_kamar,
						"id_useroom"=>$this->input->post("id_useroom")
					);
				
				$this->m_blockingroom->simpan($info);
			}
		}
		$data['title']="Blocking Room";
		$data['tglsajian']=date('d-m-Y');
		$data['reserved']=$this->m_blockingroom->semua2()->result();
		$this->template->display('blockingroom/index',$data);
	}
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_blockingroom->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_blockingroom->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_blockingroom->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['blockingroom']=$cek->result();
            $this->template->display('blockingroom/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['blockingroom']=$cek->result();
            $this->template->display('blockingroom/cari',$data);
        }
    }

    function _set_rules(){
        $this->form_validation->set_rules('namablockingroom','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglblockingroom','Harga blockingroom','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglblockingroom','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}