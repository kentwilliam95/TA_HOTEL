<?php
class Kamar extends CI_Controller{
    private $limit=5;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        $this->load->model('m_kamar');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_kamar',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_kamar->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_kamar';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['kamar']=$this->m_kamar->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Room";
        $data['anggota']=$this->m_kamar->getAnggota()->result();
        $config['base_url']=site_url('kamar/index/');
        $config['total_rows']=$this->m_kamar->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
		
		$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
	 
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
	 
		$config['first_link'] = '&lt;&lt;';
		$config['last_link'] = '&gt;&gt;';
		
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('kamar/index',$data);
    }
     function detail_pinjam($id){$hasil = $this->m_kamar->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']=$id;
        $data['pinjam']=$this->m_kamar->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_kamar->detail_pinjam($id)->result();
        $this->template->display('kamar/detail_pinjam',$data);
    }  
	 function addinventory(){
		 $hasil = $this->m_kamar->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Inventory";
        $data['tglsajian']=date('d-m-Y');
        $data['inventory']=$this->m_kamar->getInventory()->result();
        $this->template->display('kamar/addinventory',$data);
    }
     function listinventory(){
		 $hasil = $this->m_kamar->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
		$nomor = $this->uri->segment(3);
        $data['title']="List Inventory";
        $data['tglsajian']=date('d-m-Y');
        $data['inventaris']=$this->m_kamar->semua4($nomor);
        $this->template->display('kamar/listinventory',$data);
    }
    function tambah(){
        $data['title']="Tambah Kamar";
		$data['anggota']=$this->m_kamar->getAnggota()->result();
		$data['tipekamar']=$this->m_kamar->getTipeKamar()->result();
		$data['pegawai']=$this->m_kamar->getPegawai()->result();
		$data['pegawai2']=$this->m_kamar->getPegawai2()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
            $kode=$this->input->post('kode'); // mendapatkan input dari kode
            $cek=$this->m_kamar->cek($kode); // cek kode di database
            if($cek->num_rows()>0){ // jika kode sudah ada, maka tampilkan pesan
                $data['message']="<div class='alert alert-danger'>Kode kamar sudah ada</div>";
                $this->template->display('kamar/tambah',$data);
            }else{ // jika kode kamar belum ada, maka simpan
                
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '2000';
				$config['max_height']  = '1024';
				$data['anggota']=$this->m_kamar->getAnggota()->result();     
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('gambar')){
                    $gambar="";
                }else{
                    $gambar=$this->upload->file_name;
                }
                
                $info=array(
                    'id_tipekamar'=>$this->input->post('idtipe'),
                    'id_bed'=>$this->input->post('idbed'),
					'id_kamar'=>$this->input->post('idkamar'),
                    'view_kamar'=>$this->input->post('viewkamar'),
					'id_pegawai'=>$this->input->post('no'),
					'pegawai2'=>$this->input->post('pegawai2'),	
                    'gambar_kamar'=>$gambar,
					"Status"=>"VACANT READY"
                );
                $this->m_kamar->simpan($info);
                redirect('kamar/index/add_success');

            }
        }else{
            $data['message']="";
            $this->template->display('kamar/tambah',$data);
        }
    }
    
    function edit($id){
        $data['title']="Edit data kamar";
		$data['anggota']=$this->m_kamar->getAnggota()->result();
		$data['tipekamar']=$this->m_kamar->getTipeKamar()->result();
			$data['pegawai']=$this->m_kamar->getPegawai()->result();
				$data['pegawai2']=$this->m_kamar->getPegawai2()->result();
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('idkamar');
            
            //setting konfiguras upload image
              $config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('gambarkamar')){
                    $gambar="";
                }else{
                    $gambar=$this->upload->file_name;
                }
            
            $info=array(
                    'id_tipekamar'=>$this->input->post('idtipe'),
                    'id_bed'=>$this->input->post('idbed'),
                    'view_kamar'=>$this->input->post('viewkamar'),
					'id_pegawai'=>$this->input->post('no'),
				
                    'gambar_kamar'=>$gambar
            );
            $this->m_kamar->update($kode,$info);
            
            $data['kamar']=$this->m_kamar->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
            $this->template->display('kamar/edit',$data);
        }else{
            $data['message']="";
            $data['kamar']=$this->m_kamar->cek($id)->row_array();
            $this->template->display('kamar/edit',$data);
        }
    }
   
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_kamar->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/".$det->image);
	endforeach;
        $this->m_kamar->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_kamar->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['kamar']=$cek->result();
            $this->template->display('kamar/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['kamar']=$cek->result();
            $this->template->display('kamar/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('idtipe','Tipe Kamar','required|max_length[50]');
        $this->form_validation->set_rules('idbed','Tipe Bed','required|max_length[100]');
		$this->form_validation->set_rules('viewkamar','View Kamar','required|max_length[50]');
	    //$this->form_validation->set_rules('no','ID Pegawai','required|max_length[50]');
      
		
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
	function tambahDatabase()
	{
		$temp1=explode(",",$this->input->post("arrki"));
		$temp2=explode(",",$this->input->post("arrni"));
		$temp3=explode(",",$this->input->post("arrji"));
		$idkamar=$this->input->post("idkamar");
		//echo($idkamar);
		//print_r($temp1);print_r($temp2);print_r($temp3);
		$cek = $this->m_kamar->getDatum("useinventaris",array("id_kamar"=>$idkamar));
		if(empty($cek))
		{
			for($i=0;$i< count($temp1);$i++)
			{
				if(empty($temp3[$i]))
				{
					$data1=array($idkamar,$temp1[$i],$temp2[$i],0);
				}
				else
				{
					$data1=array("id_kamar"=>$idkamar,"id_item"=>$temp1[$i],"nama_item"=>$temp2[$i],"jumlah_item"=>$temp3[$i]);
				}
				$this->m_kamar->insertTo("useinventaris",$data1);
			}
		}
		else
		{
			for($i=0;$i< count($temp1);$i++)
			{
				$testing = $this->m_kamar->getDatum("useinventaris",array("id_kamar"=>$idkamar,"id_item"=>$temp1[$i]));
				if(!empty($testing))
				{
					if(empty($temp3[$i]))
					{
						$this->m_kamar->updateDatum("useinventaris",array("id_kamar"=>$idkamar,"id_item"=>$temp1[$i]),array("jumlah_item"=>0));
					}
					else
					{
						$this->m_kamar->updateDatum("useinventaris",array("id_kamar"=>$idkamar,"id_item"=>$temp1[$i]),array("jumlah_item"=>$temp3[$i]));
					}
					
				}
				else
				{
					if(empty($temp3[$i]))
					{
						$data1=array("id_kamar"=>$idkamar,"id_item"=>$temp1[$i],"nama_item"=>$temp2[$i],"jumlah_item"=>0);
					}
					else
					{
						$data1=array("id_kamar"=>$idkamar,"id_item"=>$temp1[$i],"nama_item"=>$temp2[$i],"jumlah_item"=>$temp3[$i]);
					}
					$this->m_kamar->insertTo("useinventaris",$data1);
				}
			}
		}
		redirect("kamar/index");
		
	}
}