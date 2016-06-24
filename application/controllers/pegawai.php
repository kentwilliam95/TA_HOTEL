<?php
class pegawai extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_pegawai');
        $this->load->model("basic");
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_pegawai',$order_type='asc'){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_pegawai->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_pegawai';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['pegawai']=$this->m_pegawai->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Master Employee";
        
        $config['base_url']=site_url('pegawai/index/');
        $config['total_rows']=$this->m_pegawai->jumlah();
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
            $this->template->display('pegawai/index',$data);
			
		
    }
    
    
    function edit($id){
		$hasil = $this->m_pegawai->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Edit Data Pegawai";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('kode');
			$tipe=$this->input->post('jabatanpegawai');
            //setting konfiguras upload image
            $config['upload_path'] = './assets/img/pegawai/';
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
            if($tipe=="Admin"){  
            $info=array(
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('password')
				
            );
			 }
			 else if($tipe=="Manager"){   
              $info=array(
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('password'),
				'tipe_pegawai'=>'2',
            );			
			}
			else if($tipe=="Housekeeping"){   
              $info=array(
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('password'),
				'tipe_pegawai'=>'3',
            );			
			}
			else if($tipe=="Front Office"){   
              $info=array(
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('password'),
				'tipe_pegawai'=>'4',
            );			
			}	
			else if($tipe=="Food&Beverage"){   
              $info=array(
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('password'),
				'tipe_pegawai'=>'5',
            );			
			}	
            //update data angggota
            $this->m_pegawai->update($nis,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data pegawai 
            $data['pegawai']=$this->m_pegawai->cek($id)->row_array();
            $this->template->display('pegawai/edit',$data);
        }else{
            $data['pegawai']=$this->m_pegawai->cek($id)->row_array();
            $data['message']="";
            $this->template->display('pegawai/edit',$data);
        }
    }
    function detail_pinjam($id){
		$hasil = $this->m_pegawai->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']=$id;
        $data['pinjam']=$this->m_pegawai->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_pegawai->detail_pinjam($id)->result();
        $this->template->display('pegawai/detail_pinjam',$data);
    }  
    
    function tambah(){
		$hasil = $this->m_pegawai->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Tambah Data Pegawai";
		$data['noauto']=$this->m_pegawai->nootomatis();
	
		$temp = $this->basic->query("select max(substr(id_pegawai,3)) as maks from pegawai");
		$temp = $temp[0]->maks;
		$temp = $temp +1;
		$idbaru = "PG".sprintf("%'.03d\n", $temp);
		$data["idBaru"] = $idbaru;
		$data['noauto'] = $idbaru;
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $nis=$this->input->post('nis');
			$tipe=$this->input->post('jabatanpegawai');
            $cek=$this->m_pegawai->cek($nis);
            if($cek->num_rows()>1000){
                $data['message']="<div class='alert alert-warning'>Nis sudah digunakan</div>";
                $this->template->display('pegawai/tambah',$data);
            }else{
                //setting konfiguras upload image
                $config['upload_path'] = './assets/img/pegawai/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
                
            if($tipe=="Admin"){   
              $info=array(
				
				'id_pegawai'=>$this->input->post('no'),
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('passwordpegawai'),
				'tipe_pegawai'=>'1',
            );			
			}
			else if($tipe=="Manager"){   
              $info=array(
				
				'id_pegawai'=>$this->input->post('no'),
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('passwordpegawai'),
				'tipe_pegawai'=>'2',
            );			
			}
			else if($tipe=="Housekeeping"){   
              $info=array(
				
				'id_pegawai'=>$this->input->post('no'),
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('passwordpegawai'),
				'tipe_pegawai'=>'3',
            );			
			}
			else if($tipe=="Front Office"){   
              $info=array(
				
				'id_pegawai'=>$this->input->post('no'),
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('passwordpegawai'),
				'tipe_pegawai'=>'4',
            );			
			}	
			else if($tipe=="Food&Beverage"){   
              $info=array(
				
				'id_pegawai'=>$this->input->post('no'),
                'nama_pegawai'=>$this->input->post('namapegawai'),
                'alamat_pegawai'=>$this->input->post('alamatpegawai'),
				'ttl_pegawai'=>$this->input->post('ttl'),
                'jk_pegawai'=>$this->input->post('jkpegawai'),
                'telepon_pegawai'=>$this->input->post('teleponpegawai'),
				'jabatan_pegawai'=>$this->input->post('jabatanpegawai'),
				'username'=>$this->input->post('username'),
				'password_pegawai'=>$this->input->post('passwordpegawai'),
				'tipe_pegawai'=>'5',
            );			
			}	
                $this->m_pegawai->simpan($info);
                redirect('pegawai/index/add_success');
            }
			
        }else{
            $data['message']="";
            $this->template->display('pegawai/tambah',$data);
        }
    }
    
    
    function hapus(){
		$hasil = $this->m_pegawai->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $kode=$this->input->post('kode');
        $detail=$this->m_pegawai->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/pegawai/".$det->image);
	endforeach;
        $this->m_pegawai->hapus($kode);
    }
    
    function cari(){
		$hasil = $this->m_pegawai->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_pegawai->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['pegawai']=$cek->result();
            $this->template->display('pegawai/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['pegawai']=$cek->result();
            $this->template->display('pegawai/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('namapegawai','Nama pegawai','required|max_length[50]');
        $this->form_validation->set_rules('alamatpegawai','Alamat pegawai','required|max_length[50]');
        $this->form_validation->set_rules('jkpegawai','Jenis Kelamin','required|max_length[10]');
        $this->form_validation->set_rules('teleponpegawai','Telepon','required');
		$this->form_validation->set_rules('jabatanpegawai','Jabatan Pegawai','required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}