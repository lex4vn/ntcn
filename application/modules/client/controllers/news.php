<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class news extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('news_model'));
        $this->load->library('pagination');
    }

    public function index($category_alias = '', $page = 1) {
//        $page = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $url = $this->data['uri_root'] . 'tin-tuc.html';
        $url_alias = $this->data['uri_root'] . 'tin-tuc';

        $this->db->start_cache();
//        if ($category_alias != '') {
//            $this->db->where("c.name_link", $category_alias);
//            $url = $this->data['uri_root'] . 'tin-tuc/danh-muc-' . $category_alias . '.html';
//            $url_alias = $this->data['uri_root'] . 'tin-tuc/danh-muc-' . $category_alias;
//        }
        $this->db->where("n.active", "yes");
        $this->db->where("n.catid <>", 0);
        $this->db->stop_cache();

        $rows = $this->db->select("n.*,c.name AS cname")->from("c_news AS n")
                ->join('c_news_categories AS c', 'n.catid = c.id', 'left')
                ->order_by("n.order", "DESC")
                ->order_by("n.id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();

        if (!$rows)
            redirect($this->data['uri_root'] . '404_override');

        $total_rows = $this->db->select("count(n.id) as cnt")->from("c_news AS n")->join('c_news_categories AS c', 'n.catid = c.id', 'left')->get()->row()->cnt;
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

        $this->data['_meta'] = $this->meta_model->show_title('news');
        $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'tin-tuc.html">Tin tức</a></li>';
//        $this->data['category_alias'] = $category_alias;
//        if ($category_alias != '')
//            $this->data['pathway'] .= ' / ' . $rows[0]->cname;
        $this->data['tmpl'] = 'news/index';
        $this->load->view('layout/index', $this->data);
    }

    function detail($category_alias = '', $title_link = '') {
        $row_news = $this->news_model->get_by(array('title_link' => $title_link, 'active' => 'yes'));

        if ($row_news) {
            $data = array('view' => $row_news->view + 1);
            $this->news_model->update($row_news->id, $data);

            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);

            $row_news->content = preg_replace('/<img(.*?)src="(\/uploads\/.*?)"(.*?)>/ism', '<a rel="nofollow" class="lightbox-group" href="$2"><img style="max-width:735px !important" $1src="$2"$3></a>', $row_news->content);
            $row_news->content = preg_replace('/<img(.*?)src="(http:\/\/.*?)"(.*?)>/ism', '<a rel="nofollow" class="lightbox-group" href="$2"><img style="max-width:735px !important" $1src="$2"$3></a>', $row_news->content);

            $this->data['row_news'] = $row_news;

//            $category = null;
//            if ($category_alias != '') {
//                $this->load->model('news_category_model');
//                $category = $this->news_category_model->get($row_news->catid);
//                $this->data['related_news'] = $this->news_model->order_by('order', 'DESC')->order_by('id', 'DESC')->limit(4)->get_many_by(array('catid' => $category->id, 'active' => 'yes', 'id <>' => $row_news->id));
//            } else {
//                $this->data['related_news'] = $this->news_model->order_by('order', 'DESC')->order_by('id', 'DESC')->limit(4)->get_many_by(array('active' => 'yes', 'id <>' => $row_news->id));
//            }

            $this->db->where("n.active", "yes");
            $this->db->where("n.catid <>", 0);
            $this->db->where("n.created_date >", $row_news->created_date);
            $this->db->where("n.id <>", $row_news->id);
            $related_news = $this->db->select("n.*")->from("c_news AS n")
                    ->order_by("n.order", "DESC")
                    ->order_by("n.id", "DESC")
                    ->limit(8)
                    ->get()
                    ->result();

            $this->db->where("n.active", "yes");
            $this->db->where("n.catid <>", 0);
            $this->db->where("n.created_date <", $row_news->created_date);
            $this->db->where("n.id <>", $row_news->id);
            $related_news2 = $this->db->select("n.*")->from("c_news AS n")
                    ->order_by("n.order", "DESC")
                    ->order_by("n.id", "DESC")
                    ->limit(8)
                    ->get()
                    ->result();

            $this->data['related_news'] = array_merge($related_news, $related_news2);

            $search = array('[TITLE]', '[CONTENT]', '[KEYWORD]');

            $description = '';
            $keywords = '';

            if ($row_news->meta_description != '')
                $description = $row_news->meta_description;
            else
                $description = trim(short_text(view_title(strip_tags($row_news->content)), 170));

            if ($row_news->meta_keywords != '')
                $keywords = $row_news->meta_keywords;

            $replace = array($row_news->title, $description, $keywords);
            $this->data['_meta'] = $this->meta_model->show_title('news_detail', $search, $replace);
            $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'tin-tuc.html">Tin tức</a>';
//            if ($category_alias != '')
//                $this->data['pathway'] .= ' / <a href="' . $this->data['uri_root'] . 'tin-tuc/danh-muc-' . $category->name_link . '.html">' . $category->name . '</a>';
            $this->data['pathway'] .= '<span>/ </span></li><li><strong>' . $row_news->title . '</strong>';
            $this->data['pathway'] .= '</li>';
        } else {
            redirect($this->data['uri_root'] . '404_override');
        }
//        $this->data['category'] = $category;
        $this->data['tmpl'] = 'news/detail';
        $this->load->view('layout/index', $this->data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */