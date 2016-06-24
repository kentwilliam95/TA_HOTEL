<?php
class laundry extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_laundry');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_laundry',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_laundry->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_laundry';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['laundry']=$this->m_laundry->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Laundry";
        
        
        $config['base_url']=site_url('laundry/index/');
        $config['total_rows']=$this->m_laundry->jumlah();
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
            $this->template->display('laundry/index',$data);
    }
    
    
    function tambah(){
        $data['title']="Tambah Paket";
		$data['noauto']=$this->m_laundry->nootomatis();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_laundry->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode laundry sudah ada</div>";
                $this->template->display('laundry/tambah',$data);
            }else{ // jika kode laundry belum ada, maka simpan
                
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
					'id_laundry'=>$this->input->post('no'),
                    'nama_item'=>$this->input->post('namaitem'),
					'harga_laundry'=>$this->input->post('hargalaundry'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
                );
                $this->m_laundry->simpan($info);
                redirect('laundry/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('laundry/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data laundry";
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
                    'nama_item'=>$this->input->post('namaitem'),
					'harga_laundry'=>$this->input->post('hargalaundry'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_laundry->update($kode,$info);
            
            $data['laundry']=$this->m_laundry->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('laundry/edit',$data);
        }else{
            $data['message']="";
            $data['laundry']=$this->m_laundry->cek($id)->row_array();
            $this->template->display('laundry/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_laundry->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_laundry->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_laundry->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['laundry']=$cek->result();
            $this->template->display('laundry/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['laundry']=$cek->result();
            $this->template->display('laundry/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namaitem','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('hargalaundry','Harga Laundry','required|max_length[50]');
		$this->form_validation->set_rules('satuan','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('namasatuan','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('keterangan','Keterangan','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}