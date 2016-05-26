<?php
class payroll extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_payroll');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_payroll->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        // if(empty($offset)) $offset=0;
        // if(empty($order_column)) $order_column='id_payroll';
        // if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['payroll']=$this->m_payroll->semua()->result();
        $data['title']="Payroll";
        
        $config['base_url']=site_url('anggota/index/');
        $config['total_rows']=$this->m_payroll->jumlah();
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
            $this->template->display('payroll/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_payroll->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Add payroll";
		$data['noauto']=$this->m_payroll->nootomatis();
		$data['kategori']=$this->m_payroll->getPegawai()->result();
		$data['tgl_penggajian']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_payroll->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode categorypayroll sudah ada</div>";
                $this->template->display('payroll/tambah',$data);
            }else{ // jika kode categorypayroll belum ada, maka simpan
                
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
					'id_penggajian'=>$this->input->post('no'),
                    'tgl_penggajian'=>$this->input->post('tglpenggajian'),
                    'id_pegawai'=>$this->input->post('idpegawai'),
                    'gajipokok'=>$this->input->post('gajipokok'),
                    'bonus'=>$this->input->post('bonus'),
					 'substraction'=>$this->input->post('substraction'),
					  'description'=>$this->input->post('description'),
					   'overtime'=>$this->input->post('overtime'),
					   'total_gaji'=>$this->input->post('totalgaji')
                );
                $this->m_payroll->simpan($info);
                redirect('payroll/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('payroll/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_payroll->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit data categorypayroll";
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
                'nama_categorypayroll'=>$this->input->post('namacategorypayroll'),
                // 'pengarang'=>$this->input->post('pengarang'),
                // 'klasifikasi'=>$this->input->post('klasifikasi'),
                // 'image'=>$gambar
            );
            $this->m_categorypayroll->update($kode,$info);
            
            $data['categorypayroll']=$this->m_categorypayroll->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('categorypayroll/edit',$data);
        }else{
            $data['message']="";
            $data['categorypayroll']=$this->m_categorypayroll->cek($id)->row_array();
            $this->template->display('categorypayroll/edit',$data);
        }
    }
    
    function hapus(){
		$hasil = $this->m_payroll->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $kode=$this->input->post('kode');
        $detail=$this->m_categorypayroll->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_categorypayroll->hapus($kode);
    }
    
    function cari(){
		$hasil = $this->m_payroll->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_categorypayroll->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['categorypayroll']=$cek->result();
            $this->template->display('categorypayroll/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['categorypayroll']=$cek->result();
            $this->template->display('categorypayroll/cari',$data);
        }
    }
    
    function _set_rules(){
      $this->form_validation->set_rules('tglpenggajian','Nama Kategori','required|max_length[50]');
        // $this->form_validation->set_rules('judul','Judul categorypayroll','required|max_length[100]');
        // $this->form_validation->set_rules('pengarang','Pengarang','required|max_length[50]');
        // $this->form_validation->set_rules('klasifikasi','Klasifikasi','required|max_length[25]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}