<?php
class extendroom extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_extendroom');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_extendroom->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Extend Room";
        $data['message']='';
		$data["reserved"]= $this->m_extendroom->semua2();
		
        $this->template->display('extendroom/index',$data);
    }
    
    function submitData()
	{
		$checkoutDate= $this->input->post("checkoutDate");
		$idReservasi= $this->input->post("reservasiID");
		$idcheckin = $this->input->post("checkinID");
		
		$tempDate = explode('/',$checkoutDate);
		print_r($tempDate);
		$data1 = Array("tgl_checkout"=>$tempDate[2]."-".$tempDate[0]."-".$tempDate[1]);
		
		$this->m_extendroom->updateData("booked_room",$data1,"id_checkin",$idcheckin);
		
		redirect("extendroom/index");
	}
    function tambah(){
        $data['title']="Tambah extendroom";
		$data['anggota']=$this->m_extendroom->getAnggota()->result();
		$data['tipekamar']=$this->m_extendroom->getTipeKamar()->result();
		$data['noauto']=$this->m_extendroom->nootomatis();
		$data['tgl_extendroom']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_extendroom->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode extendroom sudah ada</div>";
                $this->template->display('extendroom/tambah',$data);
            }else{ // jika kode extendroom belum ada, maka simpan
                
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
					'id_extendroom'=>$this->input->post('no'),
                    'nama_extendroom'=>$this->input->post('namaextendroom'),
					'tgl_extendroom'=>$this->input->post('tglextendroom'),
					'tgl_extendroom'=>$this->input->post('tglextendroom'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'passengers'=>$this->input->post('jumlah'),
					'status_extendroom'=>'Fixed',
					'id_tipekamar'=>$this->input->post('idtipe'),
					'id_bed'=>$this->input->post('idbed'),
                );
                $this->m_extendroom->simpan($info);
                redirect('extendroom/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('extendroom/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data extendroom";
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
					'harga_extendroom'=>$this->input->post('hargaextendroom'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_extendroom->update($kode,$info);
            
            $data['extendroom']=$this->m_extendroom->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('extendroom/edit',$data);
        }else{
            $data['message']="";
            $data['extendroom']=$this->m_extendroom->cek($id)->row_array();
            $this->template->display('extendroom/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_extendroom->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_extendroom->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_extendroom->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['extendroom']=$cek->result();
            $this->template->display('extendroom/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['extendroom']=$cek->result();
            $this->template->display('extendroom/cari',$data);
        }
    }
	function cariMenu(){
        $kode=$this->input->post('cari22');
        $buku=$this->m_extendroom->cariMenu($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_reservasi']."|".$buku['tgl_checkin']."|".$buku['tgl_checkout']."|".$buku['id_kamar'];
        }
    }
   
    
    function pencarianbuku(){
        $cari=$this->input->post('cari22');
        $data['buku']=$this->m_extendroom->pencarianbuku($cari)->result();
        $this->load->view('extendroom/pencarianbuku',$data);
    }
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_extendroom->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_extendroom->detail_pinjam($id)->result();
        $this->template->display('extendroom/detail_pinjam',$data);
    } 
    function _set_rules(){
        $this->form_validation->set_rules('namaextendroom','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglextendroom','Harga extendroom','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglextendroom','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}