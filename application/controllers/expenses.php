<?php
class expenses extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_expenses');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_expenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        // if(empty($offset)) $offset=0;
        // if(empty($order_column)) $order_column='id_expenses';
        // if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['expenses']=$this->m_expenses->semua()->result();
        $data['title']="Expenses";
        
        $config['base_url']=site_url('anggota/index/');
        $config['total_rows']=$this->m_expenses->jumlah();
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
            $this->template->display('expenses/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_expenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Add Expenses";
		$data['noauto']=$this->m_expenses->nootomatis();
		$data['kategori']=$this->m_expenses->getKategori()->result();
		$data['tgl_pengeluaran']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_expenses->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode categoryexpenses sudah ada</div>";
                $this->template->display('expenses/tambah',$data);
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
					'id_kategoripengeluaran'=>$this->input->post('no2'),
                    'id_pengeluaran'=>$this->input->post('no'),
                    'tanggal'=>$this->input->post('tanggal'),
                    'nominal'=>$this->input->post('nominal'),
                    'keterangan'=>$this->input->post('keterangan')
                );
                $this->m_expenses->simpan($info);
                redirect('expenses/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('expenses/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_expenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit data categoryexpenses";
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
                'nama_categoryexpenses'=>$this->input->post('namacategoryexpenses'),
                // 'pengarang'=>$this->input->post('pengarang'),
                // 'klasifikasi'=>$this->input->post('klasifikasi'),
                // 'image'=>$gambar
            );
            $this->m_categoryexpenses->update($kode,$info);
            
            $data['categoryexpenses']=$this->m_categoryexpenses->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('categoryexpenses/edit',$data);
        }else{
            $data['message']="";
            $data['categoryexpenses']=$this->m_categoryexpenses->cek($id)->row_array();
            $this->template->display('categoryexpenses/edit',$data);
        }
    }
    
    function hapus(){
		$hasil = $this->m_expenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $kode=$this->input->post('kode');
        $detail=$this->m_categoryexpenses->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_categoryexpenses->hapus($kode);
    }
    
    function cari(){
		$hasil = $this->m_expenses->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_categoryexpenses->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['categoryexpenses']=$cek->result();
            $this->template->display('categoryexpenses/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['categoryexpenses']=$cek->result();
            $this->template->display('categoryexpenses/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('no2','Nama Kategori','required|max_length[50]');
        // $this->form_validation->set_rules('judul','Judul categoryexpenses','required|max_length[100]');
        // $this->form_validation->set_rules('pengarang','Pengarang','required|max_length[50]');
        // $this->form_validation->set_rules('klasifikasi','Klasifikasi','required|max_length[25]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}