<?php
class dinein extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation','template'));
        $this->load->model('m_dinein');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index(){
		if($this->session->userdata("username") == null)
		{
			redirect("web/index");
		}
		$hasil = $this->m_dinein->cariTipe($this->session->userdata('username'));
		
		$data['tipe'] = $hasil[0]->tipe_pegawai;
		
        $data['title']="Restaurant Transaction";
		$data['buku']=$this->m_dinein->semua2()->result();
		$data['chef']=$this->m_dinein->getAnggota()->result();
		$data['kategorifb']=$this->m_dinein->getKategori()->result();
        $data['tglsajian']=date('d-m-Y');
		//$data['tanggalkembali'] = strtotime('+7 day',strtotime($data['tanggalpinjam']));
        $data['noauto']=$this->m_dinein->nootomatis();
        $data['anggota']=$this->m_dinein->getAnggota()->result();
       // $data['tanggalkembali'] = date('Y-m-d', $data['tanggalkembali']);
        $this->template->display('dinein/index',$data);
    }
    
    function tampil(){
        $data['tmp']=$this->m_dinein->tampilTmp()->result();
       $data['jumlahTmp']=$this->m_dinein->jumlahTmp();
       $this->load->view('useusedinein/tampil',$data);
    }
    
     function sukses(){
        
        $tmp=$this->m_usedinein->tampilTmp()->result();
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
            $this->m_usedinein->simpan($info);
            }
            //hapus data di temp
            $this->m_usedinein->hapusTmp($row->id_menu);
        }
    }    
    function cariAnggota(){
        $nis=$this->input->post('nis');
        $anggota=$this->m_dinein->cariAnggota($nis);
        if($anggota->num_rows()>0){
            $anggota=$anggota->row_array();
            echo $anggota['nama'];
        }
    }   
    function tambah(){
        $kode=$this->input->post('nomer');
        $cek=$this->m_dinein->cekTmp($kode);
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
            $this->m_dinein->simpanTmp($info);
        }
    }
   function cariMenu(){
        $kode=$this->input->post('cari22');
        $buku=$this->m_dinein->cariMenu($kode);
        if($buku->num_rows()>0){
            $buku=$buku->row_array();
            echo $buku['nama_menu']."|".$buku['harga_menu'];
        }
    }
   
    
    function pencarianbuku(){
        $cari=$this->input->post('cari22');
        $data['buku']=$this->m_dinein->pencarianbuku($cari)->result();
        $this->load->view('dinein/pencarianbuku',$data);
    }
    function hapus(){
        $kode=$this->input->post('id_menu');
        $this->m_dinein->hapusTmp($kode);
    }
    
   
}