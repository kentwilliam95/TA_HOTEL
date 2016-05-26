<?php
class restaurant extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation','template'));
        $this->load->model('m_restaurant');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_restaurant->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Restaurant";
		$data['buku']=$this->m_restaurant->semua2()->result();
		$data['chef']=$this->m_restaurant->getAnggota()->result();
		$data['kategorifb']=$this->m_restaurant->getKategori()->result();
        $data['tglsajian']=date('d-m-Y');
		//$data['tanggalkembali'] = strtotime('+7 day',strtotime($data['tanggalpinjam']));
        $data['noauto']=$this->m_restaurant->nootomatis();
        $data['anggota']=$this->m_restaurant->getAnggota()->result();
       // $data['tanggalkembali'] = date('Y-m-d', $data['tanggalkembali']);
        $this->template->display('restaurant/index',$data);
    }
    
    function tampil(){
        $data['tmp']=$this->m_restaurant->tampilTmp()->result();
       $data['jumlahTmp']=$this->m_restaurant->jumlahTmp();
       $this->load->view('restaurant/tampil',$data);
    }
    
     function sukses(){
        
        $tmp=$this->m_restaurant->tampilTmp()->result();
        foreach($tmp as $row){
			if($cek->num_rows()<10000){
            $info=array(
                'id_penyajian'=>$this->input->post('nomer'),
                'tgl_sajian'=>$this->input->post('tglsajian'),
				'id_menu'=>$this->input->post('idmenu'),
                'id_chef'=>$this->input->post('idchef'),
				'id_kategorifb'=>$this->input->post('idkategorifb'),
				'nama_menu'=>$this->input->post('namamenu'),
				'status'=>$this->input->post('status'),
            );
            $this->m_restaurant->simpan($info);
            }
            //hapus data di temp
            $this->m_restaurant->hapusTmp($row->id_menu);
        }
    }    
    function cariAnggota(){
        $nis=$this->input->post('nis');
        $anggota=$this->m_restaurant->cariAnggota($nis);
        if($anggota->num_rows()>0){
            $anggota=$anggota->row_array();
            echo $anggota['nama'];
        }
    }   
    function tambah(){
        $kode=$this->input->post('nomer');
        $cek=$this->m_restaurant->cekTmp($kode);
        if($cek->num_rows()<10000){
            $info=array(
                'id_penyajian'=>$this->input->post('nomer'),
				 'tgl_sajian'=>$this->input->post('tglsajian'),
                'id_menu'=>$this->input->post('idmenu'),
                'id_chef'=>$this->input->post('idchef'),
				'id_kategorifb'=>$this->input->post('idkategorifb'),
				'nama_menu'=>$this->input->post('namamenu'),
				'status'=>$this->input->post('status'),
				
            );
            $this->m_restaurant->simpanTmp($info);
        }
    }
   function carimenu(){
        $cari=$this->input->post('carimenu');
        $data['menu']=$this->m_restaurant->cari($cari)->result();
        $this->load->view('restaurant/index',$data);
    }
    function hapus(){
        $kode=$this->input->post('id_menu');
        $this->m_restaurant->hapusTmp($kode);
    }
    
    function pencarianbuku(){
        $cari=$this->input->post('caribuku');
        $data['buku']=$this->m_restaurant->pencarianbuku($cari)->result();
        $this->load->view('restaurant/pencarianbuku',$data);
    }
	function insertTabel()
	{
		$id= $this->input->post("idh");
		$tgl= $this->input->post("tglh");
		$chef= $this->input->post("chefh");
		$kategori= $this->input->post("kategorih");
		$status= $this->input->post("statush");
		$kodemenu = $this->input->post("CodesInput");
		$namamenu = $this->input->post("MenuNamesInput");
		if(empty($kodemenu))
		{
			//echo 
			//echo $id.",".$tgl.",".$chef.",".$kategori.",".$status;
			//redirect("restaurant/index");
		}
		else
		{
			
			$kodemenu = explode(",",$kodemenu);
			$namamenu = explode(",",$namamenu);
			
			for($i=0;$i<count($kodemenu);$i++)
			{
				$conditions=array("id_penyajian"=>$id,"tgl_sajian"=>date('Y-m-d',strtotime($tgl)));
				
				$data=array("id_penyajian"=>$id,"tgl_sajian"=>date('Y-m-d',strtotime($tgl)),"status"=>$status,"id_chef"=>$chef,"id_kategorifb"=>$kategori,"id_menu"=>$kodemenu[$i],"nama_menu"=>$namamenu[$i]);
				$cek=$this->m_restaurant->getDatum("menu_restaurant",$conditions);
				if(empty($cek))
				{
					$this->m_restaurant->simpan($data);
					echo "Ga ada datum";
				}
				else
				{
					$data=array("id_menu"=>$kodemenu[$i],"nama_menu"=>$namamenu[$i]);
					$this->m_restaurant->updateDatum("menu_restaurant",$conditions,$data);
					echo "ada datum";
				}
				
			}
		}
		
	}
}