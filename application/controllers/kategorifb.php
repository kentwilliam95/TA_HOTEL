<?php
class kategorifb extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_kategorifb');
    }
    
    function index($offset=0,$order_column='id_kategorifb',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_kategorifb->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kategorifb';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['kategorifb']=$this->m_kategorifb->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Category";
        
        $config['base_url']=site_url('anggota/index/');
        $config['total_rows']=$this->m_kategorifb->jumlah();
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
            $this->template->display('kategorifb/index',$data);
    }
    
    
    function tambah(){
        $data['title']="Tambah Kategori";
		$data['noauto']=$this->m_kategorifb->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_kategorifb->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode kategorifb sudah ada</div>";
                $this->template->display('kategorifb/tambah',$data);
            }else{ // jika kode kategorifb belum ada, maka simpan
                
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
					'id_kategorifb'=>$this->input->post('no'),
                    'nama_kategorifb'=>$this->input->post('namakategorifb'),
                    // 'judul'=>$this->input->post('judul'),
                    // 'pengarang'=>$this->input->post('pengarang'),
                    // 'klasifikasi'=>$this->input->post('klasifikasi'),
                    // 'image'=>$gambar
                );
                $this->m_kategorifb->simpan($info);
                redirect('kategorifb/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('kategorifb/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data kategorifb";
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
                'nama_kategorifb'=>$this->input->post('namakategorifb'),
                // 'pengarang'=>$this->input->post('pengarang'),
                // 'klasifikasi'=>$this->input->post('klasifikasi'),
                // 'image'=>$gambar
            );
            $this->m_kategorifb->update($kode,$info);
            
            $data['kategorifb']=$this->m_kategorifb->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('kategorifb/edit',$data);
        }else{
            $data['message']="";
            $data['kategorifb']=$this->m_kategorifb->cek($id)->row_array();
            $this->template->display('kategorifb/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_kategorifb->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_kategorifb->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_kategorifb->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['kategorifb']=$cek->result();
            $this->template->display('kategorifb/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['kategorifb']=$cek->result();
            $this->template->display('kategorifb/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namakategorifb','Nama Kategori','required|max_length[50]');
        // $this->form_validation->set_rules('judul','Judul kategorifb','required|max_length[100]');
        // $this->form_validation->set_rules('pengarang','Pengarang','required|max_length[50]');
        // $this->form_validation->set_rules('klasifikasi','Klasifikasi','required|max_length[25]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}