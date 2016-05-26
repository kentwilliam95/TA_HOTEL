<?php
class roomprice extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_roomprice');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_price',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_roomprice->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_price';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['roomprice']=$this->m_roomprice->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Room Price";
 
        $config['base_url']=site_url('roomprice/index/');
        $config['total_rows']=$this->m_roomprice->jumlah();
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
            $this->template->display('roomprice/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_roomprice->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Price";
		$data['noauto']=$this->m_roomprice->nootomatis();
		       $data['tipekamar']=$this->m_roomprice->getAnggota()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_roomprice->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode roomprice sudah ada</div>";
                $this->template->display('roomprice/tambah',$data);
            }else{ // jika kode roomprice belum ada, maka simpan
                
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
					'id_price'=>$this->input->post('no'),
                    'id_tipekamar'=>$this->input->post('tipekamar'),
					'jenis_harga'=>$this->input->post('jenisharga'),
					'tgl_awalharga'=>$this->input->post('tglawalharga'),
					'tgl_akhirharga'=>$this->input->post('tglakhirharga'),
					'harga'=>$this->input->post('harga')
                );
                $this->m_roomprice->simpan($info);
                redirect('roomprice/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('roomprice/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_roomprice->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Edit data roomprice";
		$data['tipekamar']=$this->m_roomprice->getAnggota()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
            $info=array(
                    'id_tipekamar'=>$this->input->post('tipekamar'),
					'jenis_harga'=>$this->input->post('jenisharga'),
					'tgl_awalharga'=>$this->input->post('tglawalharga'),
					'tgl_akhirharga'=>$this->input->post('tglakhirharga'),
					'transit'=>$this->input->post('transit'),
					'weekday'=>$this->input->post('weekday'),
					'weekend'=>$this->input->post('weekend')
            );
            $this->m_roomprice->update($kode,$info);
            
            $data['roomprice']=$this->m_roomprice->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('roomprice/edit',$data);
        }else{
            $data['message']="";
            $data['roomprice']=$this->m_roomprice->cek($id)->row_array();
            $this->template->display('roomprice/edit',$data);
        }
    }
	function newEdit()
	{
		$data['title']="Edit data roomprice";
		$data['tipekamar']=$this->m_roomprice->getAnggota()->result();
		$data["kode"] = $this->input->post("kode");
		$this->_set_rules();
		if($this->form_validation->run())
		{
			$info=array(
                    'id_tipekamar'=>$this->input->post('tipekamar'),
					'jenis_harga'=>$this->input->post('jenisharga'),
					'tgl_awalharga'=>$this->input->post('tglawalharga'),
					'tgl_akhirharga'=>$this->input->post('tglakhirharga'),
					'transit'=>$this->input->post('transit'),
					'weekday'=>$this->input->post('weekday'),
					'weekend'=>$this->input->post('weekend')
            );
			$this->m_roomprice->update($data["kode"],$info);
			$data['roomprice']=$this->m_roomprice->cek($data["kode"])->row_array();
			$data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('roomprice/edit',$data);
		}
		else{
            $data['message']="";
            $data['roomprice']=$this->m_roomprice->cek($data["kode"])->row_array();
            $this->template->display('roomprice/edit',$data);
        }
		
	}
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_roomprice->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_roomprice->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_roomprice->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['roomprice']=$cek->result();
            $this->template->display('roomprice/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['roomprice']=$cek->result();
            $this->template->display('roomprice/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('tipekamar','Tipe Kamar','required|max_length[50]');
		$this->form_validation->set_rules('jenisharga','Jenis Harga','required|max_length[50]');
		$this->form_validation->set_rules('tglawalharga','Tanggal Awal','required|max_length[50]');
		$this->form_validation->set_rules('tglakhirharga','Tanggal Akhir','required|max_length[50]');
		$this->form_validation->set_rules('transit','transit','required|max_length[50]');
		$this->form_validation->set_rules('weekday','weekday','required|max_length[50]');
		$this->form_validation->set_rules('weekend','weekend','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}