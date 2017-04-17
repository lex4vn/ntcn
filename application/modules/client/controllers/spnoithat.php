<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class spnoithat extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('product_model', 'product_category_model', 'product_img_model'));
        $this->load->library('pagination');
    }

    public function seoLink($category_alias = '') {
        foreach ($this->data['product_tree'] as $k => $v) {
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
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $url = $this->data['uri_root'] . 'noi-that.html';
        $url_alias = $this->data['uri_root'] . 'noi-that';

        $catid_slider = array();
        $catids = array();
        if ($category_alias != '') {
            $category_name = '';
            $category_meta_keywords = '';
            $category_meta_description = '';
            $category_image = '';
            foreach ($this->data['product_tree'] as $k => $v) {
                if ($v->name_link == $category_alias) {
                    $catids[] = $v->id;
                    $category_name = $v->name;
                    $category_meta_keywords = $v->meta_keywords;
                    $category_meta_description = $v->meta_description;
                    $category_image = $v->image;
                    foreach ($this->data['product_tree'] as $k1 => $v1) {
                        if ($v1->pid == $v->id) {
                            $catids[] = $v1->id;
                            if ($v->slider == 1)
                                $catid_slider[] = $v1;
                            foreach ($this->data['product_tree'] as $k2 => $v2) {
                                if ($v2->pid == $v1->id) {
                                    $catids[] = $v2->id;
                                }
                            }
                        }
                    }
                    break;
                }
            }

            $url = $this->data['uri_root'] . 'noi-that/' . $category_alias . '.html';
            $url_alias = $this->data['uri_root'] . 'noi-that/' . $category_alias;
        }

        if ($catid_slider) {
            $query_ = '';
            $rs = array();
            foreach ($catid_slider as $value) {
                $str = '';
                if ($query_ != '')
                    $str = ' UNION ALL ';
                $query_ .= $str . '(SELECT id,title,title_link,image,code,source,catid FROM product WHERE active=\'yes\' AND catid=' . $value->id . ' ORDER BY `order` DESC, id DESC LIMIT 12)';
                $rs[$value->id]->cate = $value;
            }

            if ($query_ != '') {
                $result_ = $this->db->query($query_)->result();
                foreach ($result_ as $rc_) {
                    $rs[$rc_->catid]->data[] = $rc_;
                }
            }

            $this->data['product'] = $rs;

            $search = array('[TITLE]', '[KEYWORDS]', '[DESCRITPTION]');
            if ($category_alias != '')
                $replace = array($category_name, $category_meta_keywords, $category_meta_description);
            else
                $replace = array('Sản phẩm nội thất', '', '');

            $this->data['_meta'] = $this->meta_model->show_title('san_pham_noi_that', $search, $replace);
            $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'noi-that.html">Sản phẩm nội thất</a>';
            $this->data['category_alias'] = $category_alias;
            $this->data['category_name'] = $category_name;
            if ($category_alias != '')
                $this->data['pathway'] .= '<span>/ </span></li><li><strong>' . $category_name . '</strong>';
            $this->data['pathway'] .= '</li>';
            if ($category_image != '')
                $this->data['category_image'] = $category_image;
            $this->data['tmpl'] = 'spnoithat/slider';
            $this->load->view('layout/index', $this->data);

            return;
        }

        $this->db->start_cache();
        if ($catids) {
            $this->db->where_in("c.id", $catids);
        }
        $this->db->where("n.active", "yes");
        $this->db->stop_cache();

        $rows = $this->db->select("n.id,n.title,n.title_link,n.image,n.code,n.source,n.catid")->from("product AS n")
                ->join('product_categories AS c', 'n.catid = c.id', 'left')
                ->order_by("n.order", "DESC")
                ->order_by("n.id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();

//        if (!$rows)
//            redirect($this->data['uri_root'] . '404_override');

        $total_rows = $this->db->select("count(n.id) as cnt")->from("product AS n")->join('product_categories AS c', 'n.catid = c.id', 'left')->get()->row()->cnt;
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
            $replace = array('Sản phẩm nội thất', '', '');

        $this->data['_meta'] = $this->meta_model->show_title('san_pham_noi_that', $search, $replace);
        $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'noi-that.html">Sản phẩm nội thất</a>';
        $this->data['category_alias'] = $category_alias;
        $this->data['category_name'] = $category_name;
        if ($category_alias != '')
            $this->data['pathway'] .= '<span>/ </span></li><li><strong>' . $category_name . '</strong>';
        $this->data['pathway'] .= '</li>';
        if ($category_image != '')
            $this->data['category_image'] = $category_image;
        $this->data['tmpl'] = 'spnoithat/index';
        $this->load->view('layout/index', $this->data);
    }

    function detail($category_alias = '', $title_link = '') {
        $row_news = $this->product_model->get_by(array('title_link' => $title_link, 'active' => 'yes'));

        if ($row_news) {
            $data = array('view' => $row_news->view + 1);
            $this->product_model->update($row_news->id, $data);

            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);
            $this->data['row_news'] = $row_news;

            $catids = array();
            if ($category_alias != '') {
                $category = $this->product_category_model->get_by(array('name_link' => $category_alias));
                foreach ($this->data['product_tree'] as $k => $v) {
                    if ($v->name_link == $category_alias) {
                        $catids[] = $v->id;
                        foreach ($this->data['product_tree'] as $k1 => $v1) {
                            if ($v1->pid == $v->id) {
                                $catids[] = $v1->id;
                                foreach ($this->data['product_tree'] as $k2 => $v2) {
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
                $category = $this->product_category_model->get($row_news->catid);
                foreach ($this->data['product_tree'] as $k => $v) {
                    if ($v->id == $row_news->catid) {
                        $category_alias = $v->name_link;
                        $catids[] = $v->id;
                        foreach ($this->data['product_tree'] as $k1 => $v1) {
                            if ($v1->pid == $v->id) {
                                $category_alias = $v1->name_link;
                                $catids[] = $v1->id;
                                foreach ($this->data['product_tree'] as $k2 => $v2) {
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
            $related_news = $this->db->select("n.*")->from("product AS n")
                    ->join('product_categories AS c', 'n.catid = c.id', 'left')
                    ->order_by("n.order", "DESC")
                    ->order_by("n.id", "DESC")
                    ->limit(4)
                    ->get()
                    ->result();

            if ($catids) {
                $this->db->where_in("c.id", $catids);
            }
            $this->db->where("n.active", "yes");
            $this->db->where("n.created_date <", $row_news->created_date);
            $this->db->where("n.id <>", $row_news->id);
            $related_news2 = $this->db->select("n.*")->from("product AS n")
                    ->join('product_categories AS c', 'n.catid = c.id', 'left')
                    ->order_by("n.order", "DESC")
                    ->order_by("n.id", "DESC")
                    ->limit(4)
                    ->get()
                    ->result();

            $this->data['related_news'] = array_merge($related_news, $related_news2);

            $album = $this->product_img_model->order_by('order', 'DESC')->order_by('id', 'DESC')->get_many_by(array('status' => 1, 'pid' => $row_news->id));
            $this->data['product_img'] = $album;

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
            $this->data['_meta'] = $this->meta_model->show_title('san_pham_noi_that_detail', $search, $replace);
            $this->data['pathway'] = '<li><a href="' . $this->data['uri_root'] . 'noi-that.html">Sản phẩm nội thất</a>';
            if ($category_alias != '')
                $this->data['pathway'] .= '<span>/ </span></li><li><a href="' . $this->data['uri_root'] . 'noi-that/' . $category->name_link . '.html">' . $category->name . '</a>';
            $this->data['pathway'] .= '<span>/ </span></li><li><strong>' . $row_news->title . '</strong>';
            $this->data['pathway'] .= '</li>';
        } else {
            redirect($this->data['uri_root'] . '404_override');
        }
        $this->data['category'] = $category;
        $this->data['category_alias'] = $category_alias;
        $this->data['tmpl'] = 'spnoithat/detail';
        $this->load->view('layout/index', $this->data);
    }

}