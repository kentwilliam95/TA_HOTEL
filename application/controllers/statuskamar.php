<?php
class statusKamar extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_statuskamar');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_kamar',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_statuskamar->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kamar';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['statuskamar']=$this->m_statuskamar->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Status Kamar";
        //$data['anggota']=$this->m_kamar->getAnggota()->result();
        $config['base_url']=site_url('statuskamar/index/');
        $config['total_rows']=$this->m_statuskamar->jumlah();
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
            $this->template->display('statuskamar/index',$data);
    }
    
    function cariTransaksi(){
        $nis=$this->input->post('id_kamar');
        $data['pencarian']=$this->m_pengembalian->cariTransaksi($nis)->result();
        $this->load->view('statuskamar/pencarian',$data);
    }
    function tambah(){
        $data['title']="Status Kamar";
		$data['pencarian']=$this->m_statuskamar->semua2()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_statuskamar->cek($kode); // cek kode di database
            if($cek->num_rows()>0){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode kamar sudah ada</div>";
                $this->template->display('statuskamar/tambah',$data);
            }else{ // jika kode kamar belum ada, maka simpan
                
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
        //$data['anggota']=$this->m_statkamar->getAnggota()->result();     
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('gambar')){
                    $gambar="";
                }else{
                    $gambar=$this->upload->file_name;
                }
                
                $info=array(
                    'id_kamar'=>$this->input->post('no'),
                    'tgl_statusawal'=>$this->input->post('tglawal'),
					'tgl_statusakhir'=>$this->input->post('tglakhir'),
                    'status'=>$this->input->post('statuskamar'),
                );
                $this->m_statuskamar->simpan($info);
                redirect('statuskamar/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('statuskamar/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Status Kamar";
		$data['pencarian']=$this->m_statuskamar->semua2()->result();
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
                    'tgl_statusawal'=>$this->input->post('tglawal'),
					'tgl_statusakhir'=>$this->input->post('tglakhir'),
                    'status'=>$this->input->post('statuskamar'),
            );
            $this->m_statuskamar->update($kode,$info);
            
            $data['statuskamar']=$this->m_statuskamar->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('statuskamar/edit',$data);
        }else{
            $data['message']="";
            $data['statuskamar']=$this->m_statuskamar->cek($id)->row_array();
            $this->template->display('statuskamar/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_statuskamar->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_kamar->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_statuskamar->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['statuskamar']=$cek->result();
            $this->template->display('statuskamar/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['statuskamar']=$cek->result();
            $this->template->display('statuskamar/cari',$data);
        }
    }
     function cari_by_nis(){
        $nis=$this->input->post('id_kamar');
        $data['pencarian']=$this->m_statuskamar->cari_by_nis($nis)->result();
        $this->load->view('statuskamar/pencarian',$data);
    }
	 function tampil(){
        $no=$_GET['id_kamar'];
        $data['kamar']=$this->m_statuskamar->tampilBuku($no)->result();
        $transaksi=$this->m_statuskamar->cari_by_nis($no)->row_array();
        
        $this->load->view('statuskamar/tampilbuku',$data);
    }
    function _set_rules(){

        $this->form_validation->set_rules('tglawal','Tanggal Awal','required|max_length[100]');
		$this->form_validation->set_rules('tglakhir','Tanggal Akhir','required|max_length[50]');
	    $this->form_validation->set_rules('statuskamar','Status Kamar','required|max_length[50]');
      
		
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}