<?php

class Client extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
//        $this->load->helper(array('cookie', 'log'));
        $this->load->model(array('meta_model', 'banner_model', 'thietke_category_model', 'product_category_model'));
        $this->load->library('simple_cache');
//        $this->load->library(array('message', 'simple_cache'));
        $this->lang->load('form_validation', 'vi');
//        define('CLIENT_VIEW_DIR', APPPATH . 'modules/client/views/');

        $this->data['c_module'] = $this->router->class;
        $this->data['c_func'] = $this->router->method;

//        $check_login = false;
//        if (isset($_SESSION["user"])) {
//            $check_login = true;
//        }
//        $this->data['check_login'] = $check_login;

        $client_data = array();
//        $this->simple_cache->delete_item('client_data');
        if (!$this->simple_cache->is_cached('client_data')) {
            $client_data['uri_root'] = site_url();
            $client_data['_meta'] = $this->meta_model->show_title();
            $client_data['banner'] = $this->banner_model->order_by("order", "ASC")->get_many_by(array('active' => 'yes'));
            $client_data['thietke_tree'] = $this->thietke_category_model->get_cat_trees_name(0, '');
            $client_data['product_tree'] = $this->product_category_model->get_cat_trees_name(0, '');

//            $client_data['news_category'] = $this->db->select()->from("c_news_categories")
//                    ->where('active', 'yes')
//                    ->order_by("order", "ASC")
//                    ->order_by("id", "DESC")
//                    ->get()
//                    ->result();

            $client_data['lastnews'] = $this->db->select("id,title,title_link,image")->from("c_news")
                    ->where('active', 1)
                    ->order_by("order", "DESC")
                    ->order_by("id", "DESC")
                    ->limit(2, 0)
                    ->get()
                    ->result();

            $client_data['mostviews'] = $this->db->select("id,title,title_link,image")->from("thietke")
                    ->where('active', 1)
                    ->order_by("view", "DESC")
                    ->order_by("order", "DESC")
                    ->order_by("id", "DESC")
                    ->limit(6, 0)
                    ->get()
                    ->result();

            $client_data['tieubieu'] = $this->db->select("id,title,title_link,image")->from("thietke")
                    ->where('active', 1)
                    ->where('tieubieu', 1)
                    ->order_by("view", "DESC")
                    ->order_by("order", "DESC")
                    ->order_by("id", "DESC")
                    ->limit(8, 0)
                    ->get()
                    ->result();

            $arr_module = array('module_top',
                'module_footer',
                'module_hotro',
                'module_hotront',
                'module_doitac',
                'module_r_noithat',
                'module_r_else',
                'module_r_menu',
                'module_lienhe'
            );
            $block_modules = $this->db->select("name,title,content")
                    ->from("email_template")
                    ->where_in('name', $arr_module)
                    ->get()
                    ->result();
            $client_data['block_modules'] = array();
            if ($block_modules) {
                foreach ($block_modules as $value) {
                    $client_data['block_modules'][$value->name][0] = $value->title;
                    $client_data['block_modules'][$value->name][1] = $value->content;
                }
            }

            // store in cache
            $this->simple_cache->cache_item('client_data', $client_data);
        } else {
            $client_data = $this->simple_cache->get_item('client_data');
        }

        $this->data = array_merge($this->data, $client_data);
    }

}