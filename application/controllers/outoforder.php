<?php
class outoforder extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_outoforder');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_kamar',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_outoforder->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kamar';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['outoforder']=$this->m_outoforder->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Out of Order Room";
        $data['statuskamar']=$this->m_outoforder->semua2()->result();
        $config['base_url']=site_url('outoforder/index/');
        $config['total_rows']=$this->m_outoforder->jumlah();
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
            $this->template->display('outoforder/index',$data);
    }
	 function standardoutoforder($offset=0,$order_column='id_kamar',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kamar';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['outoforder']=$this->m_outoforder->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="outoforder Room";
        $data['statuskamar']=$this->m_outoforder->semua3()->result();
        $config['base_url']=site_url('outoforder/index/');
        $config['total_rows']=$this->m_outoforder->jumlah();
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
            $this->template->display('outoforder/index',$data);
    }
 function superioroutoforder($offset=0,$order_column='id_kamar',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kamar';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['outoforder']=$this->m_outoforder->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="outoforder Room";
        $data['statuskamar']=$this->m_outoforder->semua4()->result();
        $config['base_url']=site_url('outoforder/index/');
        $config['total_rows']=$this->m_outoforder->jumlah();
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
            $this->template->display('outoforder/index',$data);
    }
	function deluxeoutoforder($offset=0,$order_column='id_kamar',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kamar';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['outoforder']=$this->m_outoforder->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="outoforder Room";
        $data['statuskamar']=$this->m_outoforder->semua5()->result();
        $config['base_url']=site_url('outoforder/index/');
        $config['total_rows']=$this->m_outoforder->jumlah();
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
            $this->template->display('outoforder/index',$data);
    }
   
    function cariTransaksi(){
        $nis=$this->input->post('id_kamar');
        $data['pencarian']=$this->m_pengembalian->cariTransaksi($nis)->result();
        $this->load->view('outoforder/pencarian',$data);
    }
    function tambah(){
        $data['title']="Status Kamar";
		$data['pencarian']=$this->m_outoforder->semua2()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_outoforder->cek($kode); // cek kode di database
            if($cek->num_rows()>0){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode kamar sudah ada</div>";
                $this->template->display('outoforder/tambah',$data);
            }else{ // jika kode kamar belum ada, maka simpan
                
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
        //$data['anggota']=$this->m_statkamar->getAnggota()->result();     
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('gambar')){
                    $gambar="";
                }else{
                    $gambar=$this->upload->file_name;
                }
                
                $info=array(
                    'id_kamar'=>$this->input->post('no'),
                    'tgl_statusawal'=>$this->input->post('tglawal'),
					'tgl_statusakhir'=>$this->input->post('tglakhir'),
                    'status'=>$this->input->post('outoforder'),
                );
                $this->m_outoforder->simpan($info);
                redirect('outoforder/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('outoforder/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Status Kamar";
		$data['pencarian']=$this->m_outoforder->semua2()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
            
            //setting konfiguras upload image
              $config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('gambar')){
                    $gambar="";
                }else{
                    $gambar=$this->upload->file_name;
                }
            
            $info=array(
                    'tgl_statusawal'=>$this->input->post('tglawal'),
					'tgl_statusakhir'=>$this->input->post('tglakhir'),
                    'status'=>$this->input->post('statuskamar'),
            );
            $this->m_outoforder->update($kode,$info);
            
            $data['outoforder']=$this->m_outoforder->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('outoforder/edit',$data);
        }else{
            $data['message']="";
            $data['outoforder']=$this->m_outoforder->cek($id)->row_array();
            $this->template->display('outoforder/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_outoforder->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_kamar->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
		$cari=$this->input->post('cari');
		$data['statuskamar']=$this->m_outoforder->cari($cari)->result();
   
        $cek=$this->m_outoforder->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['outoforder']=$cek->result();
            $this->template->display('outoforder/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['outoforder']=$cek->result();
            $this->template->display('outoforder/cari',$data);
        }
    }
     function cari_by_nis(){
        $nis=$this->input->post('id_kamar');
        $data['statuskamar']=$this->m_outoforder->cari_by_nis($nis)->result();
        $this->load->view('outoforder/pencarian',$data);
    }
	 function tampil(){
        $no=$_GET['id_kamar'];
        $data['kamar']=$this->m_outoforder->tampilBuku($no)->result();
        $transaksi=$this->m_outoforder->cari_by_nis($no)->row_array();
        
        $this->load->view('outoforder/tampilbuku',$data);
    }
    function _set_rules(){

        $this->form_validation->set_rules('tglawal','Tanggal Awal','required|max_length[100]');
		$this->form_validation->set_rules('tglakhir','Tanggal Akhir','required|max_length[50]');
	    $this->form_validation->set_rules('statuskamar','Status Kamar','required|max_length[50]');
      
		
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}