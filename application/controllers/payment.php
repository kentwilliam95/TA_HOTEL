<?php
class payment extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_payment');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_checkin',$order_type='asc'){
       if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_payment->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Customer Payment";
		$data["reserved"] = $this->m_payment->AllData();
		$data['message']='';
		$aaa = $this->m_payment->dataLaundry("20160406001");
		print_r($aaa);
        $this->template->display('payment/index',$data);
    }
    
    function hitungLaundry()
	{
		$checkinID = $this->input->post("checkinId");
		$hasil = $this->m_payment->dataLaundry($checkinID);
		$thasil=0;
		if(empty($hasil))
		{
			
		}
		else
		{
			foreach($hasil as $value)
			{
				$thasil += $value->subtotal;
			}
		}
		echo $thasil;
	}
	function hitungRestaurant()
	{
		$checkinID = $this->input->post("checkinId");
		$hasil = $this->m_payment->dataRestaurant($checkinID);
		$thasil=0;
		if(empty($hasil))
		{
			
		}
		else
		{
			foreach($hasil as $value)
			{
				$thasil += $value->subtotal;
			}
		}
		echo $thasil;
	}
    function tambah(){
        $data['title']="Tambah payment";
		$data['anggota']=$this->m_payment->getAnggota()->result();
		$data['tipekamar']=$this->m_payment->getTipeKamar()->result();
		$data['noauto']=$this->m_payment->nootomatis();
		$data['tgl_payment']=date('Y-m-d');
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_payment->cek($kode); // cek kode di database
            if($cek->num_rows()>100){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode payment sudah ada</div>";
                $this->template->display('payment/tambah',$data);
            }else{ // jika kode payment belum ada, maka simpan
                
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
					'id_payment'=>$this->input->post('no'),
                    'nama_payment'=>$this->input->post('namapayment'),
					'tgl_payment'=>$this->input->post('tglpayment'),
					'tgl_payment'=>$this->input->post('tglpayment'),
					'tgl_checkout'=>$this->input->post('tglcheckout'),
					'passengers'=>$this->input->post('jumlah'),
					'status_payment'=>'Fixed',
					'id_tipekamar'=>$this->input->post('idtipe'),
					'id_bed'=>$this->input->post('idbed'),
                );
                $this->m_payment->simpan($info);
                redirect('payment/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('payment/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data payment";
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
					'harga_payment'=>$this->input->post('hargapayment'),
					'satuan'=>$this->input->post('satuan'),
					'nama_satuan'=>$this->input->post('namasatuan'),
					'keterangan'=>$this->input->post('keterangan')
            );
            $this->m_payment->update($kode,$info);
            
            $data['payment']=$this->m_payment->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('payment/edit',$data);
        }else{
            $data['message']="";
            $data['payment']=$this->m_payment->cek($id)->row_array();
            $this->template->display('payment/edit',$data);
        }
    }
    function SubmitData()
	{
		$roomid= $this->input->post("id_kamar");
		$checkinID = $this->input->post("checkinID");
		$exchange = $this->input->post("exchange");
		echo $checkinID.",".$exchange;
		if($this->input->post("buttonSubmit"))
		{
			if($exchange < 0)
			{
				redirect("payment/index");
			}
			else
			{
				$data = Array("sisa"=>0,"status_pembayaran"=>"PAID");
				$this->m_payment->updateData("pembayaran",$data,"id_checkin",$checkinID);
				$this->m_payment->updateData("kamar",Array("Status"=>"VACANT DIRTY"),"id_kamar",$roomid);
			}
			redirect("payment/index");
		}
		
	}
	
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_payment->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_payment->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencairan";
        $cari=$this->input->post('cari');
        $cek=$this->m_payment->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['payment']=$cek->result();
            $this->template->display('payment/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['payment']=$cek->result();
            $this->template->display('payment/cari',$data);
        }
    }
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_payment->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_payment->detail_pinjam($id)->result();
        $this->template->display('payment/detail_pinjam',$data);
    } 
    function _set_rules(){
        $this->form_validation->set_rules('namapayment','Nama Item','required|max_length[50]');
		$this->form_validation->set_rules('tglpayment','Harga payment','required|max_length[50]');
		$this->form_validation->set_rules('tglcheckout','Satuan','required|max_length[50]');
		$this->form_validation->set_rules('jumlah','Nama Satuan','required|max_length[50]');
		$this->form_validation->set_rules('tglpayment','Keterangan','required|max_length[50]');
			$this->form_validation->set_rules('idtipe','Keterangan','max_length[50]');
				$this->form_validation->set_rules('idbed','Keterangan','max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}