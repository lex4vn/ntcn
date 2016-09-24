<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class product_img_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('product_img');
        $this->_table = $_table;
    }

}