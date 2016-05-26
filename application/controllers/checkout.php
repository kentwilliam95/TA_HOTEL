<?php
class checkout extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_checkout');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_checkin',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_checkout->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_checkin';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['checkout']=$this->m_checkout->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Search Customer";
        
        $config['base_url']=site_url('checkout/index/');
        $config['total_rows']=$this->m_checkout->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $data["reserved"] = $this->m_checkout->semua2();
		//print_r($data["reserved"]);
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('checkout/index',$data);
    }
    
    function submitData()
	{
		$checkinID = $this->input->post("checkinID");
		$roomID = $this->input->post("roomID");
		$data = Array("Status"=>"VACANT DIRTY");
		$this->m_checkout->updateData("id_kamar",$roomID,"kamar",$data);
		redirect("checkout/index");
		echo $checkinID.",".$roomID;
	}
    function tambah(){
        $data['title']="Tambah checkout";
		$data['anggota']=$this->m_checkout->getAnggota()->result();
		$data['tipekamar']=$this->m_checkout->getTipeKamar()->result();
		$data['noauto']=$this->m_checkout->nootomatis();
		$data['tgl_checkout']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_checkout->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode checkout sudah ada</div>";
                $this->template->display('checkout/tambah',$data);
            }else{ // jika kode checkout belum ada, maka simpan
                
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
					'id_checkout'=>$this->input->post('no'),
                    'nama_checkout'=>$this->input->post('namacheckout'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'passengers'=>$this->input->post('jumlah'),
					'status_checkout'=>'Fixed',
					'id_tipekamar'=>$this->input->post('idtipe'),
					'id_bed'=>$this->input->post('idbed'),
                );
                $this->m_checkout->simpan($info);
                redirect('checkout/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('checkout/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data checkout";
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
					'harga_checkout'=>$this->input->post('hargacheckout'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_checkout->update($kode,$info);
            
            $data['checkout']=$this->m_checkout->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('checkout/edit',$data);
        }else{
            $data['message']="";
            $data['checkout']=$this->m_checkout->cek($id)->row_array();
            $this->template->display('checkout/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_checkout->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_checkout->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_checkout->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['checkout']=$cek->result();
            $this->template->display('checkout/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['checkout']=$cek->result();
            $this->template->display('checkout/cari',$data);
        }
    }
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_checkout->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_checkout->detail_pinjam($id)->result();
        $this->template->display('checkout/detail_pinjam',$data);
    } 
    function _set_rules(){
        $this->form_validation->set_rules('namacheckout','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Harga checkout','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}