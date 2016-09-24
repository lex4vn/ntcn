<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('admin' . EXT);

class thietke extends Admin {

    function __construct() {
        parent::__construct();
        $this->load->model(array('thietke_model', 'thietke_category_model'));
        $this->data['cats_tree'] = $this->thietke_category_model->get_cat_trees_name();
        $this->load->helper(array('upload'));
    }

    function index() {
        $page = (isset($_GET["p"]) && (int) $_GET["p"] > 1 ? $_GET["p"] : 1);
        $limit = (isset($_GET["limit"]) && (int) $_GET["limit"] > 1 ? $_GET["limit"] : 10);
        $offset = ($page - 1) * $limit;

        $catids = array();
        if (isset($_GET["catid"]) && $_GET["catid"] != "") {
            $tmp = $this->thietke_category_model->get_many_by(array('pid' => $_GET["catid"]));
            $catids[] = $_GET["catid"];
            foreach ($tmp as $k => $v) {
                $catids[] = $v->id;
            }
        }

        $this->db->start_cache();
        if (isset($_GET["title"]) && trim($_GET["title"]) != "") {
            $this->db->like('title_link', cleanName(trim($_GET["title"])));
        }
        if ($catids) {
            $this->db->where_in("catid", $catids);
        }
        $this->db->stop_cache();

        $rows = $this->db->select("id,title,title_link,catid,order,created_date,active,tieubieu")->from("thietke")
                ->order_by("order", "DESC")
                ->order_by("id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();
//        echo $this->db->last_query();
        $total_rows = $this->db->select("count(id) as cnt")->from("thietke")->get()->row()->cnt;
        $this->db->flush_cache();

        foreach ($rows as $k => $row) {
            $cat = $this->thietke_category_model->get($row->catid);
            if ($cat) {
                $rows[$k]->cat_name = $cat->name;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ids = $this->input->post('ids');
            $orders = $this->input->post('orders');
            //var_dump($ids);
            //var_dump($orders);
            foreach ($ids as $k => $id) {
                $this->thietke_model->update($id, array("order" => $orders[$k]));
            }

            $redirect = str_replace(array('-', '_'), array('+', '/'), $this->input->post('redirect'));
            $redirect = base64_decode($redirect);
            admin_redirect($this->data['module'] . $redirect);
        }

        $base_url = '/index?limit=' . $limit
                . (isset($_GET["catid"]) ? "&catid=" . $_GET["catid"] : "")
                . (isset($_GET["title"]) ? "&title=" . $_GET["title"] : "");
        $conf = array(
            'base_url' => admin_url($this->router->class) . $base_url,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'cur_page' => $page,
        );

        $this->data['base_url'] = admin_url($this->router->class) . $base_url;

        $redirect = base64_encode($base_url . '&p=' . $page);
        $redirect = str_replace(array('+', '/'), array('-', '_'), $redirect);
        $this->data['redirect'] = $redirect;

        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->display_query_string();

        $this->data['rows'] = $rows;
        $this->data["total_rows"] = $total_rows;
        $this->data['offset'] = $offset;
        $this->data['tpl_file'] = 'thietke/index';
        $this->load->view('layout/default', $this->data);
    }

    function update($id = NULL, $redirect = NULL) {
        $re = false;
        $row = $this->thietke_model->get($id);
        $submit = array();
        if ($row) {
            $submit['title'] = $row->title;
            $submit['title_alt'] = $row->title_alt;
            $submit['title_link'] = $row->title_link;
            $row->short_desc = str_replace('<br/>', "", $row->short_desc);
            $submit['short_desc'] = $row->short_desc;
            $submit['content'] = $row->content;
            $submit['active'] = $row->active;
            $submit['image'] = $row->image;
            $submit['source'] = $row->source;
            $submit['catid'] = $row->catid;
            $submit['meta_keywords'] = $row->meta_keywords;
            $submit['meta_description'] = $row->meta_description;
            $submit['tags'] = $row->tags;
            $submit['chudautu'] = $row->chudautu;
            $row->chudautu_content = str_replace('<br/>', "", $row->chudautu_content);
            $submit['chudautu_content'] = $row->chudautu_content;
            $submit['phitk'] = $row->phitk;
            $row->phitk_content = str_replace('<br/>', "", $row->phitk_content);
            $submit['phitk_content'] = $row->phitk_content;
            $submit['tieubieu'] = $row->tieubieu;
        }else{
            $submit['active'] = 'yes';
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $this->input->post('title');
            $title_alt = $this->input->post('title_alt');
            $title_link = cleanName($title);
            $catid = $this->input->post('catid');
            $short_desc = $this->input->post('short_desc');
            $content = $this->input->post('content');
            $source = $this->input->post('source');
            $active = ($this->input->post('active') == 'yes' ? 'yes' : 'no');
            $meta_keywords = trim($this->input->post('meta_keywords'));
            $meta_description = trim($this->input->post('meta_description'));
            $tags = trim($this->input->post('tags'));
            $chudautu = trim($this->input->post('chudautu'));
            $chudautu_content = trim($this->input->post('chudautu_content'));
            $phitk = trim($this->input->post('phitk'));
            $phitk_content = trim($this->input->post('phitk_content'));
            $tieubieu = ($this->input->post('tieubieu') == 1 ? 1 : 0);

            $submit['title'] = $title;
            $submit['title_alt'] = $title_alt;
            $submit['title_link'] = $title_link;
            $submit['short_desc'] = $short_desc;
            $submit['content'] = $content;
            $submit['active'] = $active;
            $submit['catid'] = $catid;
            $submit['source'] = $source;
            $submit['meta_keywords'] = $meta_keywords;
            $submit['meta_description'] = $meta_description;
            $submit['tags'] = $tags;
            $submit['chudautu'] = $chudautu;
            $submit['chudautu_content'] = $chudautu_content;
            $submit['phitk'] = $phitk;
            $submit['phitk_content'] = $phitk_content;
            $submit['tieubieu'] = $tieubieu;

            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('short_desc', 'Mô tả ngắn', 'required');
            $this->form_validation->set_rules('content', 'Nội dung', 'required');

            if ($this->form_validation->run() == TRUE) {
                $short_desc = str_replace("\r\n", '<br/>', $short_desc);
                $chudautu_content = str_replace("\r\n", '<br/>', $chudautu_content);
                $phitk_content = str_replace("\r\n", '<br/>', $phitk_content);
                $data = array(
                    'title' => $title,
                    'title_alt' => $title_alt,
                    'title_link' => $title_link,
                    'short_desc' => $short_desc,
                    'content' => $content,
                    'active' => $active,
                    'source' => $source,
                    'catid' => $catid,
                    'meta_keywords' => $meta_keywords,
                    'meta_description' => $meta_description,
                    'tags' => $tags,
                    'chudautu' => $chudautu,
                    'chudautu_content' => $chudautu_content,
                    'phitk' => $phitk,
                    'phitk_content' => $phitk_content,
                    'tieubieu' => $tieubieu,
                );

                if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '') {
                    // Upload images
                    $album_dir = "uploads/thietke/";
                    if (!is_dir($album_dir)) {
                        create_dir($album_dir);
                    }

                    $ext = get_ext($_FILES["image"]["name"]);
                    if (!in_array($ext, array('png', 'gif', 'jpg', 'jpeg'))) {
                        continue;
                    }

                    if ($_FILES['image']['error'] === 0) {
                        $new_path = $album_dir . $_FILES["image"]["name"];
                        move_uploaded_file($_FILES["image"]['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $new_path);

//                        $pathinfo = pathinfo($new_path);
//                        $new_name = $pathinfo['basename'];
//                        $temp = explode('.', $pathinfo['basename']);
//                        $new_name = cleanName($temp[0]) . date('-his-dmy') . '.' . $pathinfo['extension'];
//                        rename($new_path, $pathinfo['dirname'] . '/' . $new_name);
//
//                        $data['image'] = $new_name;

                        $sizes = config_item('thumb_thietke_img');
                        $data['image'] = createThumb($new_path, $sizes);
                    }
                }//End select image

                if ($row) {
                    if ($this->thietke_model->get_by(array('id <>' => $id, 'title_link' => $title_link)))
                        $data['title_link'] = $title_link . '-' . time();
                    if ($this->thietke_model->update($id, $data))
                        $re = TRUE;
                } else {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    if ($this->thietke_model->get_by(array('title_link' => $title_link)))
                        $data['title_link'] = $title_link . '-' . time();
                    if ($this->thietke_model->insert($data))
                        $re = TRUE;
                }
            } else {
                $this->message->add('error', validation_errors());
            }
        }

        $redirect = str_replace(array('-', '_'), array('+', '/'), $redirect);
        $redirect = base64_decode($redirect);

        if ($re == true) {
            //delete cache
//            $this->simple_cache->delete_item('client_data');
            redirect(admin_url($this->data['module'] . $redirect));
        }

        $this->data['row'] = $row;
        $this->data['submitted'] = $submit;
        $this->data['url_back'] = admin_url($this->data['module'] . $redirect);

        $this->data['tpl_file'] = 'thietke/update';
        $this->load->view('layout/default', $this->data);
    }

    function active($id = NULL, $type = 1, $redirect = NULL) {
        if ($row = $this->thietke_model->get($id)) {
            if ($this->thietke_model->update($id, array("active" => $type))) {
                //delete cache
//                $this->simple_cache->delete_item('client_data');
                $redirect = str_replace(array('-', '_'), array('+', '/'), $redirect);
                $redirect = base64_decode($redirect);
                admin_redirect($this->data['module'] . $redirect);
            }
        }
    }

    function tieubieu($id = NULL, $type = 1, $redirect = NULL) {
        if ($row = $this->thietke_model->get($id)) {
            if ($this->thietke_model->update($id, array("tieubieu" => $type))) {
                //delete cache
//                $this->simple_cache->delete_item('client_data');
                $redirect = str_replace(array('-', '_'), array('+', '/'), $redirect);
                $redirect = base64_decode($redirect);
                admin_redirect($this->data['module'] . $redirect);
            }
        }
    }

    function delete($id = NULL, $redirect = NULL) {
        if ($row = $this->thietke_model->get($id)) {
            if ($this->thietke_model->delete($id)) {
                //delete cache
//                $this->simple_cache->delete_item('client_data');
                $redirect = str_replace(array('-', '_'), array('+', '/'), $redirect);
                $redirect = base64_decode($redirect);
                admin_redirect($this->data['module'] . $redirect);
            }
        }
    }

    function category_index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ids = $this->input->post('ids');
            $orders = $this->input->post('orders');
            //var_dump($ids);
            //var_dump($orders);
            foreach ($ids as $k => $id) {
                $this->thietke_category_model->update($id, array("order" => $orders[$k]));
            }

            admin_redirect($this->data['module'] . '/category_index');
        }

        $rows = $this->thietke_category_model->get_cat_trees();
        $this->data['rows'] = $rows;
        $this->data['tpl_file'] = 'thietke/category_index';
        $this->load->view('layout/default', $this->data);
    }

    function category_add() {
        $re = FALSE;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->input->post('name');
            $name_link = cleanName($name);
            $pid = $this->input->post('pid');
            $data = array(
                'name' => $name,
                'name_link' => $name_link,
                'meta_keywords' => trim($this->input->post('meta_keywords')),
                'meta_description' => trim($this->input->post('meta_description')),
                'order' => $this->input->post('order'),
                'active' => ($this->input->post('active') == 'yes' ? 'yes' : 'no'),
                'pid' => $pid
            );

            if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '') {
                $dir = get_dir_name('thietke-cat');
                // Upload images
                if (!is_dir($dir)) {
                    create_dir($dir);
                }

                $ext = get_ext($_FILES["image"]["name"]);
                if (!in_array($ext, array('png', 'gif', 'jpg', 'jpeg'))) {
                    continue;
                }

                //print_r($_FILES);die('====');

                if ($_FILES['image']['error'] === 0) {
                    $new_path = $dir . $_FILES["image"]["name"];
                    move_uploaded_file($_FILES["image"]['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $new_path);

//                    $pathinfo = pathinfo($new_path);
//                    $new_name = $pathinfo['basename'];
//                    $temp = explode('.', $pathinfo['basename']);
//                    $new_name = cleanName($temp[0]) . date('-his-dmy') . '.' . $pathinfo['extension'];
//                    rename($new_path, $pathinfo['dirname'] . '/' . $new_name);
//
//                    $data['image'] = $pathinfo['dirname'] . '/' . $new_name;

                    $sizes = config_item('thumb_category_img');
                    $data['image'] = createThumb($new_path, $sizes);
                }
            }//End select image

            if ($this->thietke_category_model->insert($data)) {
                $re = true;
            }
        }

        if ($re == true) {
            //delete cache
//            $this->simple_cache->delete_item('client_data');
            redirect(admin_url($this->data['module'] . '/category_index'));
        }

        $this->data['tpl_file'] = 'thietke/category_add';
        $this->load->view('layout/default', $this->data);
    }

    function category_edit($id = NULL, $action = '') {
        $re = false;
        $row = $this->thietke_category_model->get($id);
        if ($row) {
            if ($action == 'yes' || $action == 'no') {
                $this->thietke_category_model->update($id, array('active' => $action));
                $re = true;
            } else {

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $this->input->post('name');
                    $name_link = cleanName($name);
                    $pid = $this->input->post('pid');
                    $data = array(
                        'name' => $name,
                        'name_link' => $name_link,
                        'meta_keywords' => trim($this->input->post('meta_keywords')),
                        'meta_description' => trim($this->input->post('meta_description')),
                        'order' => $this->input->post('order'),
                        'active' => ($this->input->post('active') == 'yes' ? 'yes' : 'no'),
                        'pid' => $pid
                    );

                    if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '') {
                        $dir = get_dir_name('thietke-cat');
                        // Upload images
                        if (!is_dir($dir)) {
                            create_dir($dir);
                        }

                        $ext = get_ext($_FILES["image"]["name"]);
                        if (!in_array($ext, array('png', 'gif', 'jpg', 'jpeg'))) {
                            continue;
                        }

                        //print_r($_FILES);die('====');

                        if ($_FILES['image']['error'] === 0) {
//                            $new_path = $dir . $_FILES["image"]["name"];
//                            move_uploaded_file($_FILES["image"]['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $new_path);
//
//                            $pathinfo = pathinfo($new_path);
//                            $new_name = $pathinfo['basename'];
//                            $temp = explode('.', $pathinfo['basename']);
//                            $new_name = cleanName($temp[0]) . date('-his-dmy') . '.' . $pathinfo['extension'];
//                            rename($new_path, $pathinfo['dirname'] . '/' . $new_name);
//
//                            $data['image'] = $pathinfo['dirname'] . '/' . $new_name;

                            $sizes = config_item('thumb_category_img');
                            $data['image'] = createThumb($new_path, $sizes);
                        }
                    }//End select image

                    if ($this->thietke_category_model->update($id, $data)) {
                        $re = true;
                    }
                }
            }
        }

        if ($re == true) {
            //delete cache
//            $this->simple_cache->delete_item('client_data');
            redirect(admin_url($this->data['module'] . '/category_index'));
        }

        $this->data['row'] = $row;

        $this->data['tpl_file'] = 'thietke/category_edit';
        $this->load->view('layout/default', $this->data);
    }

    function category_delete($id = NULL) {
        $row = $this->thietke_category_model->get($id);
        if ($row) {
            if ($this->thietke_category_model->delete($id)) {
                //delete cache
//                $this->simple_cache->delete_item('client_data');
                redirect(admin_url($this->data['module'] . '/category_index'));
            }
        }
    }

}
