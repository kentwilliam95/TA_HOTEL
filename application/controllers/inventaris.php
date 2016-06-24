<?php
class inventaris extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_inventaris');
        $this->load->model("basic");
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_item',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_inventaris->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_item';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['inventaris']=$this->m_inventaris->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Inventory";
        
        $config['base_url']=site_url('inventaris/index/');
        $config['total_rows']=$this->m_inventaris->jumlah();
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
            $this->template->display('inventaris/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_inventaris->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Tambah Daftar inventaris";
		$data['kategori']=$this->m_inventaris->getAnggota()->result();
		$temp = $this->basic->query("select max(substr(id_item,3)) as maks from inventaris");
		$temp = $temp[0]->maks;
		$temp = $temp +1;
		$idbaru = "IN".sprintf("%'.03d\n", $temp);
		$data["idBaru"] = $idbaru;
		$data['noauto'] = $idbaru;
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_inventaris->cek($kode); // cek kode di database
            if($cek->num_rows()>10000){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode inventaris sudah ada</div>";
                $this->template->display('inventaris/tambah',$data);
            }else{ // jika kode inventaris belum ada, maka simpan
                
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
					'id_item'=>$this->input->post('no'),
					'id_kategoriinventaris'=>$this->input->post('idkategori'),
                    'nama_item'=>$this->input->post('namaitem'),
					'start_guarantee'=>$this->input->post('startguarantee'),
					'end_guarantee'=>$this->input->post('endguarantee')
                );
                $this->m_inventaris->simpan($info);
                redirect('inventaris/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('inventaris/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_inventaris->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit data inventaris";
		$data['kategori']=$this->m_inventaris->getAnggota()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
            
            //setting konfiguras upload image
            $config['upload_path'] = './assets/img/';
	    $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '1000';
	    $config['max_width']  = '2000';
	    $config['max_height']  = '1024';
                
            // $this->upload->initialize($config);
            // if(!$this->upload->do_upload('gambarinventaris')){
                // $gambar="";
            // }else{
                // $gambar=$this->upload->file_name;
            // }
            
            $info=array(
					'id_kategoriinventaris'=>$this->input->post('idkategori'),
					'nama_item'=>$this->input->post('namaitem'),
					'start_guarantee'=>$this->input->post('startguarantee'),
					'end_guarantee'=>$this->input->post('endguarantee'),
            );
            $this->m_inventaris->update($kode,$info);
            
            $data['inventaris']=$this->m_inventaris->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('inventaris/edit',$data);
        }else{
            $data['message']="";
            $data['inventaris']=$this->m_inventaris->cek($id)->row_array();
            $this->template->display('inventaris/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_inventaris->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_inventaris->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_inventaris->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['inventaris']=$cek->result();
            $this->template->display('inventaris/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['inventaris']=$cek->result();
            $this->template->display('inventaris/cari',$data);
        }
    }
    
    function _set_rules(){
		 $this->form_validation->set_rules('idkategori','Kategori','required|max_length[50]');
        $this->form_validation->set_rules('namaitem','Nama inventaris','required|max_length[50]');
		$this->form_validation->set_rules('startguarantee','Start Guarantee','required|max_length[50]');
			$this->form_validation->set_rules('endguarantee','End Guarantee','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}