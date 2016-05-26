<?php
class kategoriinventaris extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_kategoriinventaris');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_kategoriinventaris',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_kategoriinventaris->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kategoriinventaris';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['kategoriinventaris']=$this->m_kategoriinventaris->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Category";
        
        $config['base_url']=site_url('kategoriinventaris/index/');
        $config['total_rows']=$this->m_kategoriinventaris->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Successully Deleted!</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Successully Added!</div>";
        else
            $data['message']='';
            $this->template->display('kategoriinventaris/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_kategoriinventaris->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Kategori";
		$data['noauto']=$this->m_kategoriinventaris->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_kategoriinventaris->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode kategoriinventaris sudah ada</div>";
                $this->template->display('kategoriinventaris/tambah',$data);
            }else{ // jika kode kategoriinventaris belum ada, maka simpan
                
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
                
                // $this->upload->initialize($config);
                // if(!$this->upload->do_upload('gambar')){
                    // $gambar="";
                // }else{
                    // $gambar=$this->upload->file_name;
                // }
                
                $info=array(
					'id_kategoriinventaris'=>$this->input->post('no'),
                    'nama_kategori'=>$this->input->post('namakategori'),
                    // 'judul'=>$this->input->post('judul'),
                    // 'pengarang'=>$this->input->post('pengarang'),
                    // 'klasifikasi'=>$this->input->post('klasifikasi'),
                    // 'image'=>$gambar
                );
                $this->m_kategoriinventaris->simpan($info);
                redirect('kategoriinventaris/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('kategoriinventaris/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_kategoriinventaris->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit data Kategori";
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
                'nama_kategori'=>$this->input->post('namakategori'),
                // 'pengarang'=>$this->input->post('pengarang'),
                // 'klasifikasi'=>$this->input->post('klasifikasi'),
                // 'image'=>$gambar
            );
            $this->m_kategoriinventaris->update($kode,$info);
            
            $data['kategoriinventaris']=$this->m_kategoriinventaris->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('kategoriinventaris/edit',$data);
        }else{
            $data['message']="";
            $data['kategoriinventaris']=$this->m_kategoriinventaris->cek($id)->row_array();
            $this->template->display('kategoriinventaris/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_kategoriinventaris->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_kategoriinventaris->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_kategoriinventaris->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['kategoriinventaris']=$cek->result();
            $this->template->display('kategoriinventaris/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['kategoriinventaris']=$cek->result();
            $this->template->display('kategoriinventaris/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namakategori','Nama Kategori','required|max_length[50]');
        // $this->form_validation->set_rules('judul','Judul kategoriinventaris','required|max_length[100]');
        // $this->form_validation->set_rules('pengarang','Pengarang','required|max_length[50]');
        // $this->form_validation->set_rules('klasifikasi','Klasifikasi','required|max_length[25]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}