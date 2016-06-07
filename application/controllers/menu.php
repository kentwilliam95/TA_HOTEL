<?php
class menu extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_menu');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_menu',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_menu->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_menu';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['menu']=$this->m_menu->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Menu";
        
        $config['base_url']=site_url('menu/index/');
        $config['total_rows']=$this->m_menu->jumlah();
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
            $this->template->display('menu/index',$data);
    }
    
    
    function tambah(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_menu->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Tambah Daftar Menu";
		$data['noauto']=$this->m_menu->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_menu->cek($kode); // cek kode di database
            if($cek->num_rows()>10000){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode menu sudah ada</div>";
                $this->template->display('menu/tambah',$data);
            }else{ // jika kode menu belum ada, maka simpan
                
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
					'id_menu'=>$this->input->post('no'),
                    'nama_menu'=>$this->input->post('namamenu'),
					'gambar_menu'=>$gambar,
					'harga_menu'=>$this->input->post('hargamenu')
                );
                $this->m_menu->simpan($info);
                redirect('menu/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('menu/tambah',$data);
        }
    }
    
    function edit($id){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_menu->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit data menu";
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
            if(!$this->upload->do_upload('gambarmenu')){
                $gambar="";
            }else{
                $gambar=$this->upload->file_name;
            }
            
            $info=array(
					'nama_menu'=>$this->input->post('namamenu'),
					'gambar_menu'=>$gambar,
					'harga_menu'=>$this->input->post('hargamenu')
            );
            $this->m_menu->update($kode,$info);
            
            $data['menu']=$this->m_menu->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('menu/edit',$data);
        }else{
            $data['message']="";
            $data['menu']=$this->m_menu->cek($id)->row_array();
            $this->template->display('menu/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_menu->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_menu->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_menu->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['menu']=$cek->result();
            $this->template->display('menu/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['menu']=$cek->result();
            $this->template->display('menu/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namamenu','Nama Menu','required|max_length[50]');
		$this->form_validation->set_rules('hargamenu','Harga Menu','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}