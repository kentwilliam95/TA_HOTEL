<?php
class chef extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_chef');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_chef',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_chef->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_chef';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['chef']=$this->m_chef->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Chef";
        
        $config['base_url']=site_url('chef/index/');
        $config['total_rows']=$this->m_chef->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Successfully Deleted</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Successfully Added!</div>";
        else
            $data['message']='';
            $this->template->display('chef/index',$data);
    }
    
    
    function edit($id){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_chef->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit Data chef";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('kode');
            //setting konfiguras upload image
            $config['upload_path'] = './assets/img/chef/';
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
                'nama_chef'=>$this->input->post('namachef'),
                'alamat_chef'=>$this->input->post('alamatchef'),
                'jk_chef'=>$this->input->post('jkchef'),
                'telepon_chef'=>$this->input->post('teleponchef'),
				'ttl_chef'=>$this->input->post('ttl'),
			    'skill_chef'=>$this->input->post('skillchef')
				
            );
            //update data angggota
            $this->m_chef->update($nis,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data chef 
            $data['chef']=$this->m_chef->cek($id)->row_array();
            $this->template->display('chef/edit',$data);
        }else{
            $data['chef']=$this->m_chef->cek($id)->row_array();
            $data['message']="";
            $this->template->display('chef/edit',$data);
        }
    }
    
    
    function tambah(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_chef->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Data chef";
		$data['noauto']=$this->m_chef->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('nis');
            $cek=$this->m_chef->cek($nis);
            if($cek->num_rows()>100000){
                $data['message']="<div class='alert alert-warning'>Nis sudah digunakan</div>";
                $this->template->display('chef/tambah',$data);
            }else{
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/chef/';
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
				'id_chef'=>$this->input->post('no'),
                'nama_chef'=>$this->input->post('namachef'),
                'alamat_chef'=>$this->input->post('alamatchef'),
                'jk_chef'=>$this->input->post('jkchef'),
                'telepon_chef'=>$this->input->post('teleponchef'),
				'ttl_chef'=>$this->input->post('ttl'),
			    'skill_chef'=>$this->input->post('skillchef')
                );
                $this->m_chef->simpan($info);
                redirect('chef/index/add_success');
            }
        }else{
            $data['message']="";
            $this->template->display('chef/tambah',$data);
        }
    }
     function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_chef->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_chef->detail_pinjam($id)->result();
        $this->template->display('chef/detail_pinjam',$data);
    } 
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_chef->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/chef/".$det->image);
	endforeach;
        $this->m_chef->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_chef->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['chef']=$cek->result();
            $this->template->display('chef/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['chef']=$cek->result();
            $this->template->display('chef/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namachef','Nama chef','required|max_length[50]');
        $this->form_validation->set_rules('alamatchef','Alamat chef','required|max_length[50]');
        $this->form_validation->set_rules('jkchef','Jenis Kelamin','required|max_length[10]');
        $this->form_validation->set_rules('teleponchef','Telepon','required');
        $this->form_validation->set_rules('skillchef','Skill Chef','required|max_length[200]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}