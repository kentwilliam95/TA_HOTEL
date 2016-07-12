<?php
class depositoawal extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_depositoawal');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
       if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_depositoawal->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        //load data
		$data["message"]="";
        $data['title']="Search Customer";
        
		$data["reserved"]=$this->m_depositoawal->semuaDataPembayaran();
		$data["promo"]=$this->m_depositoawal->semuaPromo();
		//print_r($this->m_depositoawal->getPriceKamar("Antorium"));
		
        $this->template->display('depositoawal/index',$data);
    }
    function getPrice()
	{
		$tipekamar = $this->input->post("id_tipekamar");
		$price = $this->m_depositoawal->getPriceKamar($tipekamar);
		echo $price[0]->transit.",".$price[0]->weekday.",".$price[0]->weekend;
		//echo $tipekamar;
	}
    function submitData()
	{
		$checkinID= $this->input->post("checkinID");
		$jumlahUang= $this->input->post("jumlahUang");
		$terbayar= $this->input->post("terbayar");
		$sisa = $this->input->post("sisaUang1");
		$no_debit=$this->input->post("nomorKredit1");
		$akun_bayar=$this->input->post("tipeAkun1");
		$id_promo=$this->input->post("idPromo");
		$jenis_pembayaran=$this->input->post("tipeBayar1");
		
		//echo $checkinID.",".$jumlahUang.",".$terbayar.",".$sisa.",".$no_debit.",".$akun_bayar.",".$id_promo.",".$jenis_pembayaran;
		$status_pembayaran="";
		
		if($sisa == 0)
		{
			$status_pembayaran = "PAID";
		}
		else
		{
			$status_pembayaran = "WAITING";
		}
		
		$insertData = Array("id_checkin"=>$checkinID,"no_debit"=>$no_debit,"akun_bayar"=>$akun_bayar,"jumlah"=>$jumlahUang,"terbayar"=>$terbayar,"sisa"=>$sisa,"id_promo"=>$id_promo,"jenis_pembayaran"=>$jenis_pembayaran,"status_pembayaran"=>$status_pembayaran);
		
		$this->m_depositoawal->insertData("pembayaran",$insertData);
		redirect("depositoawal/index");
	}
    function tambah(){
        $data['title']="Tambah depositoawal";
		$data['anggota']=$this->m_depositoawal->getAnggota()->result();
		$data['tipekamar']=$this->m_depositoawal->getTipeKamar()->result();
		$data['noauto']=$this->m_depositoawal->nootomatis();
		$data['tgl_depositoawal']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_depositoawal->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode depositoawal sudah ada</div>";
                $this->template->display('depositoawal/tambah',$data);
            }else{ // jika kode depositoawal belum ada, maka simpan
                
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
					'id_depositoawal'=>$this->input->post('no'),
                    'nama_depositoawal'=>$this->input->post('namadepositoawal'),
					'tgl_depositoawal'=>$this->input->post('tgldepositoawal'),
					'tgl_depositoawal'=>$this->input->post('tgldepositoawal'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'passengers'=>$this->input->post('jumlah'),
					'status_depositoawal'=>'Fixed',
					'id_tipekamar'=>$this->input->post('idtipe'),
					'id_bed'=>$this->input->post('idbed'),
                );
                $this->m_depositoawal->simpan($info);
                redirect('depositoawal/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('depositoawal/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data depositoawal";
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
					'harga_depositoawal'=>$this->input->post('hargadepositoawal'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_depositoawal->update($kode,$info);
            
            $data['depositoawal']=$this->m_depositoawal->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('depositoawal/edit',$data);
        }else{
            $data['message']="";
            $data['depositoawal']=$this->m_depositoawal->cek($id)->row_array();
            $this->template->display('depositoawal/edit',$data);
        }
    }
    function cariMenu(){
        $kode=$this->input->post('cari22');
        $buku=$this->m_depositoawal->cariMenu($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_reservasi']."|".$buku['tgl_checkin']."|".$buku['tgl_checkout'];
        }
    }
   
    
    function pencarianbuku(){
        $cari=$this->input->post('cari22');
        $data['buku']=$this->m_depositoawal->pencarianbuku($cari)->result();
        $this->load->view('depositoawal/pencarianbuku',$data);
    }
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_depositoawal->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_depositoawal->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_depositoawal->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['depositoawal']=$cek->result();
            $this->template->display('depositoawal/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['depositoawal']=$cek->result();
            $this->template->display('depositoawal/cari',$data);
        }
    }
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_depositoawal->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_depositoawal->detail_pinjam($id)->result();
        $this->template->display('depositoawal/detail_pinjam',$data);
    } 
    function _set_rules(){
        $this->form_validation->set_rules('namadepositoawal','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tgldepositoawal','Harga depositoawal','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tgldepositoawal','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}