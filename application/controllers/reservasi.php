<?php
class reservasi extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_reservasi');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_reservasi',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_reservasi->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_reservasi';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['reservasi']=$this->m_reservasi->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Room Reservation";
        
        $config['base_url']=site_url('reservasi/index/');
        $config['total_rows']=$this->m_reservasi->jumlah();
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
            $this->template->display('reservasi/index',$data);
    }
    
    
    function tambah(){
		$hasil = $this->m_reservasi->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Reservasi";
		$data['anggota']=$this->m_reservasi->getAnggota()->result();
		$data['anggota1'] = $this->m_reservasi->getAnggota()->result();
		$data['tipekamar']=$this->m_reservasi->getTipeKamar()->result();
		$data['tipekamar1']=$this->m_reservasi->getTipeKamar()->result();
		$data['noauto']=$this->m_reservasi->nootomatis();
		$data['tgl_reservasi']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true)
		{//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_reservasi->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode reservasi sudah ada</div>";
                $this->template->display('reservasi/tambah',$data);
            }
			else
			{ // jika kode reservasi belum ada, maka simpan
                
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '2000';
				$config['max_height']  = '1024';
                
                $info=array(
					'id_reservasi'=>$this->input->post('no'),
                    'nama_reservasi'=>$this->input->post('namareservasi'),
					'tgl_reservasi'=>$this->input->post('tglreservasi'),
					'tgl_checkin'=>$this->input->post('tglcheckin'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'passengers'=>$this->input->post('jumlah'),
					'status_reservasi'=>'Fixed',
					'id_tipekamar'=>$this->input->post('idtipe'),
					'id_bed'=>$this->input->post('idbed'),
                );
                $this->m_reservasi->simpan($info);
                redirect('reservasi/index/add_success');

            }
        }
		else
		{
            $data['message']="";
            $this->template->display('reservasi/tambah',$data);
        }
    }
    
    function edit($id){
		$hasil = $this->m_reservasi->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Edit data reservasi";
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
					'harga_reservasi'=>$this->input->post('hargareservasi'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_reservasi->update($kode,$info);
            
            $data['reservasi']=$this->m_reservasi->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('reservasi/edit',$data);
        }else{
            $data['message']="";
            $data['reservasi']=$this->m_reservasi->cek($id)->row_array();
            $this->template->display('reservasi/edit',$data);
        }
    }
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_reservasi->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_reservasi->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_reservasi->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['reservasi']=$cek->result();
            $this->template->display('reservasi/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['reservasi']=$cek->result();
            $this->template->display('reservasi/cari',$data);
        }
    }
    function detail_pinjam($id){
		$hasil = $this->m_reservasi->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']=$id;
        $data['pinjam']=$this->m_reservasi->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_reservasi->detail_pinjam($id)->result();
        $this->template->display('reservasi/detail_pinjam',$data);
    } 
    function _set_rules(){
        $this->form_validation->set_rules('namareservasi','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckin','Harga reservasi','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglreservasi','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
	function tambahData()
	{
		$checkin = $this->input->post("checkinTemp");
		$checkout = $this->input->post("checkoutTemp");
		$tipekamar = $this->input->post("tipekamarTemp");
		$tipebed=$this->input->post("tipebedTemp");
		$idreservasi = $this->input->post("reservasiTemp");
		$nama = $this->input->post("namaTemp");
		$jumlah = $this->input->post("jumlahTemp");
		$tglReservasi= $this->input->post("tgl_reservasiTemp");
		
		$count = count(explode(",",$tipebed));
		$checkin = explode(",",$checkin);
		$checkout = explode(",",$checkout);
		$tipekamar = explode(",",$tipekamar);
		$tipebed = explode(",",$tipebed);
		$tempDate1=null;
		$tempDate2=null;
		
		$temp=null;
		$temp2=null;
		
		for($i=0; $i< $count; $i++)
		{
			$tempDate1 = str_replace("/","-",$checkin[$i]);
			$temp = substr($tempDate1,6)."-".substr($tempDate1,0,2)."-".substr($tempDate1,3,2);
			$tempDate2 = str_replace("/","-",$checkout[$i]);
			$temp2 = substr($tempDate2,6)."-".substr($tempDate2,0,2)."-".substr($tempDate2,3,2);
			$this->m_reservasi->insertInto("useroom",array("id_reservasi"=>$idreservasi,"id_bed"=>$tipebed[$i],"id_tipekamar"=>$tipekamar[$i],"tgl_checkout"=>$temp2,"tgl_checkin"=>$temp));
		}
		echo $temp.",".$temp2;
		$this->m_reservasi->insertInto("reservasi",array("id_reservasi"=>$idreservasi,"tgl_reservasi"=>$tglReservasi,"passengers"=>$jumlah,"nama_reservasi"=>$nama,"status_reservasi"=>"Fixed"));
		redirect("reservasi/index");
		//print_r($count);
		//echo $checkin.",,".$checkout.",,".$tipekamar.",,".$tipebed.",,".$nama.",,".$jumlah;
	}
}