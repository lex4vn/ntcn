<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class search extends Client {

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index($page = 1) {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $keyword = (isset($_GET['s']) ? trim($_GET['s']) : '');
        $cat = (isset($_GET['c']) ? $_GET['c'] : '');

        if ($keyword == '') {
            $this->data['message'] = 'Hãy nhập từ khoá tìm kiếm';
        } else {
            $table = 'thietke';
            if ($cat == 1) {
                $table = 'thicong';
            } elseif ($cat == 2) {
                $table = 'product';
                $limit = 18;
            } elseif ($cat == 3) {
                $table = 'c_news';
            }

            $url = $this->data['uri_root'] . 'tim-kiem.html?s=' . $keyword . '&c=' . $cat;
            $url_alias = $this->data['uri_root'] . 'tim-kiem';

//        $this->db->start_cache();
            $this->db->where("n.active", "yes");
            $where = implode(" ", $this->db->ar_where);
            $this->db->_reset_select();

            $this->db->like("n.title_link", cleanName($keyword));
            if ($cat == 2)
                $this->db->or_like("n.code", $keyword);

//        $this->db->or_like("n.short_desc", $keyword);
//        $this->db->or_like("n.content", $keyword);
            $like = implode(" ", $this->db->ar_like);
            $this->db->_reset_select();
//        $this->db->stop_cache();

            $rows = $this->db->select("n.*")->from($table . " AS n")
                    ->join($table . '_categories AS c', 'n.catid = c.id', 'left')
                    ->where($where . ' AND (' . $like . ')')
                    ->order_by("n.order", "DESC")
                    ->order_by("n.id", "DESC")
                    ->limit($limit, $offset)
                    ->get()
                    ->result();
//            echo $this->db->last_query();
//            var_dump(count($rows));
            $total_rows = $this->db->select("count(n.id) as cnt")->from($table . " AS n")->join($table . '_categories AS c', 'n.catid = c.id', 'left')
                            ->where($where . ' AND (' . $like . ')')
                            ->get()->row()->cnt;
            $this->db->flush_cache();
//            echo $this->db->last_query();

            $this->data['news'] = $rows;

            $conf = array(
                'cur_page' => $page,
                'base_url' => $url,
                'total_rows' => $total_rows,
                'per_page' => $limit,
                'cur_class' => 'currentpage',
                'prev_class' => 'prevnext',
                'next_class' => 'prevnext',
                'first_link' => '<img alt="Trang đầu" src="' . img_link('icon.gif') . '" />',
                'last_link' => '<img alt="Trang cuối" src="' . img_link('icon.gif') . '" />',
                'next_link' => '...',
                'prev_link' => '...',
                'show_total' => 'no',
                'show_first_last' => 'yes'
            );

            $this->pagination->initialize($conf);
            $this->data['pagnav'] = $this->pagination->display_query_string_seo($url_alias);
        }

        $search = array('[TITLE]');
        $replace = array();
        if ($keyword != '')
            $replace = array(': ' . $keyword);

        $this->data['_meta'] = $this->meta_model->show_title('tim-kiem', $search, $replace);
        $this->data['pathway'] = '<a href="' . $this->data['uri_root'] . 'tim-kiem.html">Tìm kiếm</a>';

        $view = 'index';
        if ($cat == 1)
            $view = 'thicong';
        elseif ($cat == 2)
            $view = 'product';
        elseif ($cat == 3)
            $view = 'news';

        $this->data['tmpl'] = 'search/' . $view;
        $this->load->view('layout/index', $this->data);
    }

}

?>
