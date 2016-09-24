<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class thietke extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('thietke_model'));
        $this->load->library('pagination');
    }

    public function seoLink($category_alias = '') {
        foreach ($this->data['thietke_tree'] as $k => $v) {
            if ($v->name_link == $category_alias) {
                $this->index($category_alias, 1);
                return;
            }
        }

        $this->detail('', $category_alias);
        return;
    }

    public function index($category_alias = '', $page = 1) {
//        $page = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $url = $this->data['uri_root'] . 'thiet-ke.html';
        $url_alias = $this->data['uri_root'] . 'thiet-ke';

        $this->db->start_cache();
        if ($category_alias != '') {
            $catids = array();
            $category_name = '';
            $category_meta_keywords = '';
            $category_meta_description = '';
            $category_image = '';
            foreach ($this->data['thietke_tree'] as $k => $v) {
                if ($v->name_link == $category_alias) {
                    $catids[] = $v->id;
                    $category_name = $v->name;
                    $category_meta_keywords = $v->meta_keywords;
                    $category_meta_description = $v->meta_description;
                    $category_image = $v->image;
                    foreach ($this->data['thietke_tree'] as $k1 => $v1) {
                        if ($v1->pid == $v->id) {
                            $catids[] = $v1->id;
                            foreach ($this->data['thietke_tree'] as $k2 => $v2) {
                                if ($v2->pid == $v1->id) {
                                    $catids[] = $v2->id;
                                }
                            }
                        }
                    }
                    break;
                }
            }

            if ($catids) {
                $this->db->where_in("c.id", $catids);
            }

            $url = $this->data['uri_root'] . 'thiet-ke/' . $category_alias . '.html';
            $url_alias = $this->data['uri_root'] . 'thiet-ke/' . $category_alias;
        }
        $this->db->where("n.active", "yes");
        $this->db->stop_cache();

        $rows = $this->db->select("n.*")->from("thietke AS n")
                ->join('thietke_categories AS c', 'n.catid = c.id', 'left')
                ->order_by("n.order", "DESC")
                ->order_by("n.id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();
//        echo $this->db->last_query();
//        if (!$rows)
//            redirect($this->data['uri_root'] . '404_override');

        $total_rows = $this->db->select("count(n.id) as cnt")->from("thietke AS n")->join('thietke_categories AS c', 'n.catid = c.id', 'left')->get()->row()->cnt;
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
            'first_link' => 'Trang đầu',
            'last_link' => 'Trang cuối',
            'next_link' => '...',
            'prev_link' => '...',
            'show_total' => 'no',
            'show_first_last' => 'yes'
        );

        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->display_query_string_seo($url_alias);

        $search = array('[TITLE]', '[KEYWORDS]', '[DESCRITPTION]');
        if ($category_alias != '')
            $replace = array($category_name, $category_meta_keywords, $category_meta_description);
        else
            $replace = array('Thiết kế', '', '');

        $this->data['_meta'] = $this->meta_model->show_title('thietke', $search, $replace);
        $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'thiet-ke.html">Thiết kế</a>';
        $this->data['category_alias'] = $category_alias;
        $this->data['category_name'] = $category_name;
        if ($category_alias != '')
            $this->data['pathway'] .= '<span>/ </span></li><li><strong>' . $category_name . '</strong>';
        $this->data['pathway'] .= '</li>';
        if ($category_image != '')
            $this->data['category_image'] = $category_image;
        $this->data['tmpl'] = 'thietke/index';
        $this->load->view('layout/index', $this->data);
    }

    function detail($category_alias = '', $title_link = '') {
        $row_news = $this->thietke_model->get_by(array('title_link' => $title_link, 'active' => 'yes'));

        if ($row_news) {
            $data = array('view' => $row_news->view + 1);
            $this->thietke_model->update($row_news->id, $data);

            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);

            $row_news->content = preg_replace('/<img(.*?)src="(\/uploads\/.*?)"(.*?)>/ism', '<a rel="nofollow" class="lightbox-group" href="$2"><img style="max-width:735px !important" $1src="$2"$3></a>', $row_news->content);

            $this->data['row_news'] = $row_news;

            $catids = array();
            if ($category_alias != '') {
                $category = $this->thietke_category_model->get_by(array('name_link' => $category_alias));
                foreach ($this->data['thietke_tree'] as $k => $v) {
                    if ($v->name_link == $category_alias) {
                        $catids[] = $v->id;
                        foreach ($this->data['thietke_tree'] as $k1 => $v1) {
                            if ($v1->pid == $v->id) {
                                $catids[] = $v1->id;
                                foreach ($this->data['thietke_tree'] as $k2 => $v2) {
                                    if ($v2->pid == $v1->id) {
                                        $catids[] = $v2->id;
                                    }
                                }
                            }
                        }
                        break;
                    }
                }
            } else {
                $category = $this->thietke_category_model->get($row_news->catid);
                foreach ($this->data['thietke_tree'] as $k => $v) {
                    if ($v->id == $row_news->catid) {
                        $category_alias = $v->name_link;
                        $catids[] = $v->id;
                        foreach ($this->data['thietke_tree'] as $k1 => $v1) {
                            if ($v1->pid == $v->id) {
                                $category_alias = $v1->name_link;
                                $catids[] = $v1->id;
                                foreach ($this->data['thietke_tree'] as $k2 => $v2) {
                                    if ($v2->pid == $v1->id) {
                                        $category_alias = $v2->name_link;
                                        $catids[] = $v2->id;
                                    }
                                }
                            }
                        }
                        break;
                    }
                }
            }

            if ($catids) {
                $this->db->where_in("c.id", $catids);
            }
            $this->db->where("n.active", "yes");
            $this->db->where("n.created_date >", $row_news->created_date);
            $this->db->where("n.id <>", $row_news->id);
            $related_news = $this->db->select("n.*")->from("thietke AS n")
                    ->join('thietke_categories AS c', 'n.catid = c.id', 'left')
                    ->order_by("n.order", "DESC")
                    ->order_by("n.id", "DESC")
                    ->limit(8)
                    ->get()
                    ->result();

            if ($catids) {
                $this->db->where_in("c.id", $catids);
            }
            $this->db->where("n.active", "yes");
            $this->db->where("n.created_date <", $row_news->created_date);
            $this->db->where("n.id <>", $row_news->id);
            $related_news2 = $this->db->select("n.*")->from("thietke AS n")
                    ->join('thietke_categories AS c', 'n.catid = c.id', 'left')
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
            $this->data['_meta'] = $this->meta_model->show_title('thietke_detail', $search, $replace);
            $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'thiet-ke.html">Thiết kế</a>';
            if ($category_alias != '')
                $this->data['pathway'] .= '<span>/ </span></li><li><a href="' . $this->data['uri_root'] . 'thiet-ke/' . $category->name_link . '.html">' . $category->name . '</a>';
            $this->data['pathway'] .= '<span>/ </span></li><li><strong>' . $row_news->title . '</strong>';
            $this->data['pathway'] .= '</li>';
        } else {
            redirect($this->data['uri_root'] . '404_override');
        }
        $this->data['category'] = $category;
        $this->data['category_alias'] = $category_alias;
        $this->data['tmpl'] = 'thietke/detail';
        $this->load->view('layout/index', $this->data);
    }

}