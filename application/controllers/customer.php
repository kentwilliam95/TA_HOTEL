<?php
class customer extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_customer');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_customer',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_customer->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_customer';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['customer']=$this->m_customer->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Data customer";
        
        $config['base_url']=site_url('customer/index/');
        $config['total_rows']=$this->m_customer->jumlah();
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
            $this->template->display('customer/index',$data);
    }
    
    
    function edit($id){
		$hasil = $this->m_customer->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit Data Customer";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('kode');
            //setting konfiguras upload image
            $config['upload_path'] = './assets/img/customer/';
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
                'nama_customer'=>$this->input->post('namacustomer'),
                'alamat_customer'=>$this->input->post('alamatcustomer'),
				'ttl_customer'=>$this->input->post('ttl'),
                'jk_customer'=>$this->input->post('jkcustomer'),
                'telepon_customer'=>$this->input->post('teleponcustomer'),
				'status_member'=>$this->input->post('statmember'),
				'nomor_ktp'=>$this->input->post('ktpcustomer'),
				'pekerjaan'=>$this->input->post('pekerjaancustomer'),
				'status_nikah'=>$this->input->post('statnikahcustomer'),
				'company_customer'=>$this->input->post('companycustomer')
				
            );
            //update data angggota
            $this->m_customer->update($nis,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data customer 
            $data['customer']=$this->m_customer->cek($id)->row_array();
            $this->template->display('customer/edit',$data);
        }else{
            $data['customer']=$this->m_customer->cek($id)->row_array();
            $data['message']="";
            $this->template->display('customer/edit',$data);
        }
    }
     function detail_pinjam($id){
		 $hasil = $this->m_customer->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']=$id;
        $data['pinjam']=$this->m_customer->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_customer->detail_pinjam($id)->result();
        $this->template->display('customer/detail_pinjam',$data);
    }    
    
    function tambah(){
		$hasil = $this->m_customer->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Tambah Data customer";
		$data['noauto']=$this->m_customer->nootomatis();
		$data['reserved']=$this->m_customer->semua2()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('nis');
            $cek=$this->m_customer->cek($nis);
            if($cek->num_rows()>100000){
                $data['message']="<div class='alert alert-warning'>Nis sudah digunakan</div>";
                $this->template->display('customer/tambah',$data);
            }else{
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/customer/';
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
				'id_customer'=>$this->input->post('no'),
                'nama_customer'=>$this->input->post('namacustomer'),
                'alamat_customer'=>$this->input->post('alamatcustomer'),
				'ttl_customer'=>$this->input->post('ttl'),
                'jk_customer'=>$this->input->post('jkcustomer'),
                'telepon_customer'=>$this->input->post('teleponcustomer'),
				'status_member'=>$this->input->post('statmember'),
				'nomor_ktp'=>$this->input->post('ktpcustomer'),
				'pekerjaan'=>$this->input->post('pekerjaancustomer'),
				'status_nikah'=>$this->input->post('statnikahcustomer'),
				'company_customer'=>$this->input->post('companycustomer')
                );
                $this->m_customer->simpan($info);
                redirect('customer/index/add_success');
            }
        }else{
            $data['message']="";
            $this->template->display('customer/tambah',$data);
        }
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_customer->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/customer/".$det->image);
	endforeach;
        $this->m_customer->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_customer->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['customer']=$cek->result();
            $this->template->display('customer/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['customer']=$cek->result();
            $this->template->display('customer/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namacustomer','Nama Customer','required|max_length[50]');
        $this->form_validation->set_rules('alamatcustomer','Alamat Customer','required|max_length[50]');
        $this->form_validation->set_rules('jkcustomer','Jenis Kelamin','required|max_length[10]');
        $this->form_validation->set_rules('teleponcustomer','Telepon','required');
		$this->form_validation->set_rules('statmember','Status Member','required');
        $this->form_validation->set_rules('ktpcustomer','Nomor KTP','required|max_length[50]');
		$this->form_validation->set_rules('pekerjaancustomer','Pekerjaan','required|max_length[50]');
	    $this->form_validation->set_rules('statnikahcustomer','Status Nikah','required|max_length[50]');
	    $this->form_validation->set_rules('companycustomer','Company Customer','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}