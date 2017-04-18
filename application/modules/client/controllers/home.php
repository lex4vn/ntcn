<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class Home extends Client {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $client_data = array();
//        $this->simple_cache->delete_item('home_data');
        if (!$this->simple_cache->is_cached('home_data')) {
            foreach ($this->data['product_tree'] as $value) {
                if ($value->pid == 0 && $value->tab == 1) {
                    $catids = array();
                    $tmp = $this->product_category_model->get_many_by(array('pid' => $value->id));
                    $catids[] = $value->id;
                    foreach ($tmp as $k => $v) {
                        $catids[] = $v->id;
                    }

                    $client_data['product'][$value->id] = $this->db->select("id,title,title_link,image,source,code,catid")->from("product")
                            ->where('active', 'yes')
                            ->where_in("catid", $catids)
                            ->order_by("order", "DESC")
                            ->order_by("id", "DESC")
                            ->limit(40, 0)
                            ->get()
                            ->result();
                }
            }

            foreach ($this->data['thietke_tree'] as $value) {
                if ($value->pid == 0) {
                    $catids = array();
                    $tmp = $this->thietke_category_model->get_many_by(array('pid' => $value->id));
                    $catids[] = $value->id;
                    foreach ($tmp as $k => $v) {
                        $catids[] = $v->id;
                    }

                    $client_data['thietke'][$value->id] = $this->db->select("id,title,title_link,image")->from("thietke")
                            ->where('active', 'yes')
                            ->where_in("catid", $catids)
                            ->order_by("order", "DESC")
                            ->order_by("id", "DESC")
                            ->limit(40, 0)
                            ->get()
                            ->result();
                }
            }

            $client_data['_meta'] = $this->meta_model->show_title('home');

            // store in cache
            $this->simple_cache->cache_item('home_data', $client_data);
        } else {
            $client_data = $this->simple_cache->get_item('home_data');
        }

        $this->data = array_merge($this->data, $client_data);

        $this->data['tmpl'] = 'home/index';
        $this->load->view('layout/index', $this->data);
    }

    public function index_old() {
        $home_data = array();
//        $this->simple_cache->delete_item('home_data');
        if (!$this->simple_cache->is_cached('home_data')) {
            $search = array();
            $replace = array();
            $home_data['_meta'] = $this->meta_model->show_title('home', $search, $replace);

            // store in cache
            $this->simple_cache->cache_item('home_data', $home_data);
        } else {
            $home_data = $this->simple_cache->get_item('home_data');
        }

        $this->data = array_merge($this->data, $home_data);

        $this->data['pagnav'] = true;
        $this->data['tmpl'] = 'home/index';
        $this->load->view('layout/index', $this->data);
    }

}