<?php
class uselaundry extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation','template'));
        $this->load->model('m_uselaundry');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_uselaundry->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Laundry";
		$data['buku']=$this->m_uselaundry->semua2()->result();
		$data['chef']=$this->m_uselaundry->getAnggota()->result();
		$data['kategorifb']=$this->m_uselaundry->getKategori()->result();
		$data["idCheckin"] =$this->m_uselaundry->GetAllDataFrom("booked_room") ;
        $data['tglsajian']=date('d-m-Y');
		//$data['tanggalkembali'] = strtotime('+7 day',strtotime($data['tanggalpinjam']));
        $data['noauto']=$this->m_uselaundry->nootomatis();
        $data['anggota']=$this->m_uselaundry->getAnggota()->result();
       // $data['tanggalkembali'] = date('Y-m-d', $data['tanggalkembali']);
        $this->template->display('uselaundry/index',$data);
    }
    
    function tampil(){
        $data['tmp']=$this->m_useuseuselaundry->tampilTmp()->result();
       $data['jumlahTmp']=$this->m_useuseuselaundry->jumlahTmp();
       $this->load->view('useuseuselaundry/tampil',$data);
    }
    
     function sukses(){
        
        $tmp=$this->m_useuselaundry->tampilTmp()->result();
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
            $this->m_useuselaundry->simpan($info);
            }
            //hapus data di temp
            $this->m_useuselaundry->hapusTmp($row->id_menu);
        }
    }    
    function cariAnggota(){
        $nis=$this->input->post('nis');
        $anggota=$this->m_useuselaundry->cariAnggota($nis);
        if($anggota->num_rows()>0){
            $anggota=$anggota->row_array();
            echo $anggota['nama'];
        }
    }   
    function tambah(){
        $kode=$this->input->post('nomer');
        $cek=$this->m_useuselaundry->cekTmp($kode);
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
            $this->m_useuselaundry->simpanTmp($info);
        }
    }
	function cariItem(){
        $kode=$this->input->post('cari22');
        $buku=$this->m_uselaundry->cariItem($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_item']."|".$buku['harga_laundry'];
        }
    }
   
    
    function pencarianbuku(){
        $cari=$this->input->post('cari22');
        $data['buku']=$this->m_uselaundry->pencarianbuku($cari)->result();
        $this->load->view('uselaundry/pencarianbuku',$data);
    }
	function cariKamar(){
        $kode=$this->input->post('carikamar');
        $buku2=$this->m_uselaundry->cariKamar($kode);
        if($buku2->num_rows()>0){
            $buku2=$buku2->row_array();
            echo $buku2['id_checkin']."|".$buku2['id_kamar']."|".$buku2['nama_reservasi'];
        }
    }
   
    
    function pencarianbuku2(){
        $cari=$this->input->post('carikamar');
        $data['buku2']=$this->m_uselaundry->pencarianbuku2($cari)->result();
        $this->load->view('uselaundry/pencarianbuku2',$data);
    }
	function simpan()
	{
		$id_checkin = $this->input->post("idcheckin");
		$subtotal = $this->input->post("subtotal");
		$id_item = $this->input->post("idItem");
		$qty = $this->input->post("qty");
		$data = array("id_checkin"=>$id_checkin,"jumlah"=>$qty,"subtotal"=>$subtotal,"id_item"=>$id_item);
		print_r($data);
		$this->m_uselaundry->saveTo("uselaundy",$data);
		redirect("uselaundry/index");
	}
}