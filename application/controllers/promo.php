<?php
class Promo extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_promo');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_promo',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_promo->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_promo';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['promo']=$this->m_promo->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Data Promo";
        
        $config['base_url']=site_url('promo/index/');
        $config['total_rows']=$this->m_promo->jumlah();
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
            $this->template->display('promo/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_promo->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Data Promo";
		$data['noauto']=$this->m_promo->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_promo->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode promo sudah ada</div>";
                $this->template->display('promo/tambah',$data);
            }else{ // jika kode promo belum ada, maka simpan
                
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
					'id_promo'=>$this->input->post('no'),
                    'nama_promo'=>$this->input->post('namapromo'),
					'tglawal_promo'=>$this->input->post('tglawalpromo'),
					'tglakhir_promo'=>$this->input->post('tglakhirpromo'),
					'gambar_promo'=>$gambar,
					'keterangan'=>$this->input->post('keterangan'),
					'status_promo'=>$this->input->post('statuspromo'),
					'disc_value'=>$this->input->post('discvalue')
                );
                $this->m_promo->simpan($info);
                redirect('promo/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('promo/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_promo->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Edit data promo";
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
            if(!$this->upload->do_upload('gambarpromo')){
                $gambar=$this->upload->file_name;
            }else{
                $gambar=$this->upload->file_name;
            }
            
            $info=array(
                    'nama_promo'=>$this->input->post('namapromo'),
					'tglawal_promo'=>$this->input->post('tglawalpromo'),
					'tglakhir_promo'=>$this->input->post('tglakhirpromo'),
					'gambar_promo'=>$gambar,
					'keterangan'=>$this->input->post('keterangan'),
					'status_promo'=>$this->input->post('statuspromo'),
					'disc_value'=>$this->input->post('discvalue')
            );
            $this->m_promo->update($kode,$info);
            
            $data['promo']=$this->m_promo->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('promo/edit',$data);
        }else{
            $data['message']="";
            $data['promo']=$this->m_promo->cek($id)->row_array();
            $this->template->display('promo/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_promo->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_promo->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_promo->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['promo']=$cek->result();
            $this->template->display('promo/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['promo']=$cek->result();
            $this->template->display('promo/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namapromo','Nama Promo','required|max_length[50]');
		$this->form_validation->set_rules('tglawalpromo','Tanggal Awal','required|max_length[50]');
		$this->form_validation->set_rules('tglakhirpromo','Tanggal Akhir','required|max_length[50]');
		$this->form_validation->set_rules('keterangan','Keterangan','required|max_length[100]');
		$this->form_validation->set_rules('statuspromo','Status Promo','required|max_length[20]');
		//$this->form_validation->set_rules('discavalue','Disc Value','required|max_length[20]');
      
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}