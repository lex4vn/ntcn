<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class Html extends Client {

    function __construct() {
        parent::__construct();
    }

    function index() {
        redirect($this->data['uri_root']);
    }
    
    function contact() {
        $this->data['_meta'] = $this->meta_model->show_title('contact');
        $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'lien-he.html">Liên hệ</a></a>';
        $this->data["tmpl"] = "html/lienhe";
        $this->load->view("layout/index", $this->data);
    }

    function _check_captcha($code) {
        $code = strtoupper($code);
        if ($_SESSION['captcha'] != $code) {
            $this->form_validation->set_message('_check_captcha', 'Mã xác nhận không đúng.');
            return false;
        }
        return true;
    }

}