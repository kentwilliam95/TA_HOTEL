<?php
class Template2{
    protected $_CI;
    function __construct(){
        $this->_CI=&get_instance();
    }
    
    function display($template2,$data=null){
        $data['_content']=$this->_CI->load->view($template2,$data,true);
        $data['_header']=$this->_CI->load->view('template2/header',$data,true);
        $data['_sidebar']=$this->_CI->load->view('template2/sidebar',$data,true);
        $this->_CI->load->view('/template2.php',$data);
    }
}