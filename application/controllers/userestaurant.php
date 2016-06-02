<?php
class userestaurant extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation','template'));
        $this->load->model('m_userestaurant');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_userestaurant->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Delivery Services";
		$data['buku']=$this->m_userestaurant->semua2()->result();
		$data['chef']=$this->m_userestaurant->getAnggota()->result();
		$data['kategorifb']=$this->m_userestaurant->getKategori()->result();
        $data['tglsajian']=date('d-m-Y');
		
		$data["idCheckin"] =$this->m_userestaurant->GetAllDataFrom("booked_room") ;
        $data['noauto']=$this->m_userestaurant->nootomatis();
        $data['anggota']=$this->m_userestaurant->getAnggota()->result();
      
        $this->template->display('userestaurant/index',$data);
    }
    
    function tampil(){
        $data['tmp']=$this->m_useuseuserestaurant->tampilTmp()->result();
       $data['jumlahTmp']=$this->m_useuseuserestaurant->jumlahTmp();
       $this->load->view('useuseuserestaurant/tampil',$data);
    }
    
     function sukses(){
        
        $tmp=$this->m_useuserestaurant->tampilTmp()->result();
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
            $this->m_useuserestaurant->simpan($info);
            }
            //hapus data di temp
            $this->m_useuserestaurant->hapusTmp($row->id_menu);
        }
    }    
    function cariAnggota(){
        $nis=$this->input->post('nis');
        $anggota=$this->m_useuserestaurant->cariAnggota($nis);
        if($anggota->num_rows()>0){
            $anggota=$anggota->row_array();
            echo $anggota['nama'];
        }
    }   
    function tambah(){
        $kode=$this->input->post('nomer');
        $cek=$this->m_useuserestaurant->cekTmp($kode);
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
            $this->m_useuserestaurant->simpanTmp($info);
        }
    }
   function cariMenu(){
        $kode=$this->input->post('carimenu');
        $buku=$this->m_userestaurant->cariMenu($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_menu']."|".$buku['harga_menu'];
        }
    }
    function hapus(){
        $kode=$this->input->post('id_menu');
        $this->m_useuserestaurant->hapusTmp($kode);
    }
    
    function pencarianbuku(){
        $cari=$this->input->post('caribuku');
        $data['buku']=$this->m_useuserestaurant->pencarianbuku($cari)->result();
        $this->load->view('useuserestaurant/pencarianbuku',$data);
    }
	function simpan()
	{
		$idCheckin = $this->input->post("idCheckin");
		$idMenu = $this->input->post("idMenu");
		$jumlah = $this->input->post("jumlah");
		$subtotal = $this->input->post("subtotal");
		
		$data1 = array("id_menu"=>$idMenu,"subtotal"=>$subtotal,"jumlah"=>$jumlah,"id_checkin"=>$idCheckin);
		
		$this->m_userestaurant->insertTo("userestaurant",$data1);
		redirect("userestaurant/index");
	}
}