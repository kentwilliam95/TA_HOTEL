<?php
class changeroom extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload',"table"));
        $this->load->model('m_changeroom');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    function CariKamar()
	{
		$tipekamar = $this->input->post("tipekamar");
		$tipebed = $this->input->post("tipebed");
		$temp =$this->m_changeroom->carikamar($tipekamar,$tipebed); 
		
		$this->table->set_heading("ID Kamar","Tipe Kamar","Tipe Bed");
		foreach($temp as $a)
		{
			$this->table->add_row($a->id_kamar,$a->id_tipekamar,$a->id_bed,'<a href="#" class="tambah1" carikamar='.$a->id_kamar.'><i class="glyphicon glyphicon-plus"></i></a>');
		}
		echo $this->table->generate();
	}
	function submit()
	{
		$tipebed = $this->input->post("tipebed");
		$tipekamar = $this->input->post("tipekamar");
		$idkamar = $this->input->post("idkamar");
		$checkinId=$this->input->post("checkinId");
		$id_useroom=$this->input->post("id_useroom");
		
		$data = Array("id_tipekamar"=>$tipekamar,"id_bed"=>$tipebed,"id_kamar"=>$idkamar);
		$this->m_changeroom->updateData("id_checkin",$checkinId,"booked_room",$data);
		
		$data = Array("id_tipekamar"=>$tipekamar,"id_bed"=>$tipebed);
		$this->m_changeroom->updateData("id_useroom",$id_useroom,"useroom",$data);
		
		redirect("changeroom/index");
		//echo $tipekamar.",".$tipebed.",".$idkamar.",".$checkinId;
		
	}
    function index($offset=0,$order_column='id_checkin',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_changeroom->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_checkin';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['changeroom']=$this->m_changeroom->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Search Customer";
        $data['anggota']=$this->m_changeroom->getAnggota()->result();
		$data['tipekamar']=$this->m_changeroom->getTipeKamar()->result();
        $config['base_url']=site_url('changeroom/index/');
        $config['total_rows']=$this->m_changeroom->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $data["reserved"] = $this->m_changeroom->semua2();
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('changeroom/index',$data);
    }
    
    
    function tambah(){
        $data['title']="Tambah changeroom";
		$data['anggota']=$this->m_changeroom->getAnggota()->result();
		$data['tipekamar']=$this->m_changeroom->getTipeKamar()->result();
		$data['noauto']=$this->m_changeroom->nootomatis();
		$data['tgl_changeroom']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_changeroom->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode changeroom sudah ada</div>";
                $this->template->display('changeroom/tambah',$data);
            }else{ // jika kode changeroom belum ada, maka simpan
                
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
					'id_changeroom'=>$this->input->post('no'),
                    'nama_changeroom'=>$this->input->post('namachangeroom'),
					'tgl_changeroom'=>$this->input->post('tglchangeroom'),
					'tgl_changeroom'=>$this->input->post('tglchangeroom'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'passengers'=>$this->input->post('jumlah'),
					'status_changeroom'=>'Fixed',
					'id_tipekamar'=>$this->input->post('idtipe'),
					'id_bed'=>$this->input->post('idbed'),
                );
                $this->m_changeroom->simpan($info);
                redirect('changeroom/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('changeroom/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data changeroom";
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
					'harga_changeroom'=>$this->input->post('hargachangeroom'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_changeroom->update($kode,$info);
            
            $data['changeroom']=$this->m_changeroom->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('changeroom/edit',$data);
        }else{
            $data['message']="";
            $data['changeroom']=$this->m_changeroom->cek($id)->row_array();
            $this->template->display('changeroom/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_changeroom->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_changeroom->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_changeroom->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['changeroom']=$cek->result();
            $this->template->display('changeroom/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['changeroom']=$cek->result();
            $this->template->display('changeroom/cari',$data);
        }
    }
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_changeroom->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_changeroom->detail_pinjam($id)->result();
        $this->template->display('changeroom/detail_pinjam',$data);
    } 
    function _set_rules(){
        $this->form_validation->set_rules('namachangeroom','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglchangeroom','Harga changeroom','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglextendroom','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}