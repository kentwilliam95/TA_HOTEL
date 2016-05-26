<?php
class categoryexpenses extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_categoryexpenses');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
        if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_categoryexpenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        
        //load data
        $data['categoryexpenses']=$this->m_categoryexpenses->semua()->result();
        $data['title']="Master Category";
        
        $config['base_url']=site_url('categoryexpenses/index/');
        $config['total_rows']=$this->m_categoryexpenses->jumlah();
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
            $this->template->display('categoryexpenses/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_categoryexpenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Kategori";
		$data['noauto']=$this->m_categoryexpenses->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_categoryexpenses->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode categoryexpenses sudah ada</div>";
                $this->template->display('categoryexpenses/tambah',$data);
            }else{ // jika kode categoryexpenses belum ada, maka simpan
                
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
					'id_kategoripengeluaran'=>$this->input->post('no'),
                    'nama_kategoripengeluaran'=>$this->input->post('namakategori'),
                    // 'judul'=>$this->input->post('judul'),
                    // 'pengarang'=>$this->input->post('pengarang'),
                    // 'klasifikasi'=>$this->input->post('klasifikasi'),
                    // 'image'=>$gambar
                );
                $this->m_categoryexpenses->simpan($info);
                redirect('categoryexpenses/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('categoryexpenses/tambah',$data);
        }
    }
    

    
    function _set_rules(){
        $this->form_validation->set_rules('namakategori','Nama Kategori','required|max_length[50]');
        // $this->form_validation->set_rules('judul','Judul categoryexpenses','required|max_length[100]');
        // $this->form_validation->set_rules('pengarang','Pengarang','required|max_length[50]');
        // $this->form_validation->set_rules('klasifikasi','Klasifikasi','required|max_length[25]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}