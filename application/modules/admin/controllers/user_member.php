<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('admin' . EXT);

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhoang.com
 * @date    09.02.2011
 */
class User_member extends Admin {

    function __construct() {
        parent::__construct();
        $this->load->model(array('user_model', 'group_model', 'city_model'));
        $this->data["cities"] = $this->city_model->get_all();
        $this->data['group_rows'] = $this->group_model->get_all();
        //print_r($this->data['group_rows']);
    }

    function index() {
        $page = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 20; //$this->config->item('user', 'limit');
        $offset = ($page - 1) * $limit;

        $this->data['page'] = $page;
        $this->data['limit'] = $limit;
        $this->db->start_cache();
        if ($name = $this->input->get('name')) {
            $this->db->where("(username LIKE '%" . $name . "%' OR email LIKE '%" . $name . "%')");
        }

        if (isset($_GET["status"]) && $_GET["status"] <> "") {
            $this->db->where("active", $_GET["status"]);
        }

        if (isset($_GET["start_date"]) && isset($_GET["end_date"]) && isset($_GET["date"]) && $_GET["date"] == 1) {
            $start_date = $_GET["start_date"];
            $end_date = $_GET["end_date"];
            $start_date = convert_from_vn_date_to_mysql_date($start_date);
            $end_date = convert_from_vn_date_to_mysql_date($end_date);
            $this->db->where("DATE(created_date) >=", $start_date);
            $this->db->where("DATE(created_date) <=", $end_date);
        }

        if (isset($_GET["group"]) && $_GET["group"] <> 0) {
            $this->db->where("group_id", $_GET["group"]);
        }

        //$this->db->where("g.admin <>",1);

        $this->db->stop_cache();

        $count = $this->db->select('count(u.id) as cnt')->from('users u')->join("c_groups g", "g.id=u.group_id")->get()->row()->cnt;

        $user_list = $this->db->select("u.*")->from('users u')->join("c_groups g", "g.id=u.group_id")->order_by('u.id', 'DESC')->limit($limit, $offset)->get()->result();

        foreach ($user_list as $k => $v) {
            if ($v->group_id == NULL) {
                $this->user_model->update($v->id, array("group_id" => 4));
            }
        }

        $this->data['user_list'] = $user_list;
        $this->db->flush_cache();
        /*
          if($status = $this->input->get('status')) {
          $this->data['user_list'] = $this->user_model->limit($limit, $offset)->get_all();
          }
          else {
          //$this->data['user_list'] = $this->user_model->limit($limit, $offset)->get_many_by(array('is_admin' => 1));
          $this->data['user_list'] = $this->user_model->limit($limit, $offset)->get_all();
          }
         */

        $conf = array(
            'base_url' => admin_url($this->router->class) . '/index' . "?name=" . (isset($_GET['name']) ? '' . $_GET['name'] : '') . "&status=" . (isset($_GET["status"]) ? $_GET["status"] : "") . (isset($_GET["date"]) && $_GET["date"] == 1 ? '&date=' . $_GET["date"] . "&start_date=" . $_GET["start_date"] . "&end_dat=" . $_GET["end_date"] : ''),
            'total_rows' => $count,
            'per_page' => $limit,
            'cur_page' => $page,
        );
        $this->pagination->initialize($conf);
        $this->data["total"] = $count;
        $this->data["linit"] = $limit;
        //$this->data['pagnav'] = $this->pagination->display_query_string();
        $this->data['pagnav'] = $this->pagination->display_query_string();

        if ($this->input->is_ajax_request()) {
            $this->load->view('user_member/list', $this->data);
        } else {
            $this->data['tpl_file'] = 'user_member/index';
            $this->load->view('layout/default', $this->data);
        }
    }

    function purchase_app($user_id = null) {
        $p = (isset($_GET["p"]) ? $_GET['p'] : 1);

        $this->data["user"] = $this->user_model->get($user_id);

        $limit = 10;
        $offset = ($p - 1) * $limit;
        $rows = $this->db->select("o.date_buy,sv.name as app_name,od.price,(SELECT name FROM payment_method WHERE id=od.payment_method_id) as pm_name")
                ->from("orders o")
                ->join("order_detail od", "od.order_id=o.id")
                ->join("service_package s", "s.item_id=od.item_id")
                ->join("services sv", "sv.id=s.service_id")
                ->where("o.user_id", $user_id)
                ->where("o.is_delete", 0)
                ->order_by("o.time", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();

        $count = $this->db->select("count(o.id) as cnt")
                        ->from("orders o")
                        ->join("order_detail od", "od.order_id=o.id")
                        ->join("service_package s", "s.item_id=od.item_id")
                        ->join("services sv", "sv.id=s.service_id")
                        ->where("o.user_id", $user_id)
                        ->where("o.is_delete", 0)
                        ->get()
                        ->row()->cnt;

        $sum = $this->db->select("sum(od.price) as cnt")
                        ->from("orders o")
                        ->join("order_detail od", "od.order_id=o.id")
                        ->join("service_package s", "s.item_id=od.item_id")
                        ->join("services sv", "sv.id=s.service_id")
                        ->where("o.user_id", $user_id)
                        ->where("o.is_delete", 0)
                        ->get()
                        ->row()->cnt;

        //print_r($rows);die;
        //display_frame_query_string
        $conf = array(
            'base_url' => admin_url($this->router->class) . '/purchase_app/' . $user_id,
            'total_rows' => $count,
            'per_page' => $limit,
            'cur_page' => $p,
        );
        $this->pagination->initialize($conf);
        //$this->data['pagnav'] = $this->pagination->display_query_string();
        $this->data['pagnav'] = $this->pagination->display_frame_query_string();
        $this->data["rows"] = $rows;
        $this->data["sum"] = $sum;
        $this->load->view($this->data["module"] . "/purchase_app", $this->data);
    }

    function balance() {
        $p = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 20;
        $offset = ($p - 1) * $limit;
        $users = $this->user_model->limit($limit, $offset)->get_all();
        //print_r($users);
        $this->data['rows'] = $users;
        foreach ($users as $k => $v) {
            $users[$k]->statistic = $this->loto_model->statistic_by_user_id($v->user_id);
        }
        $this->data['tpl_file'] = "user_member/balance";
        $this->load->view('layout/default', $this->data);
    }

    function history($user_id = NULL, $p = 1) {
        $limit = 1;
        $offset = ($p - 1) * $limit;
        $result = $this->loto_model->history($user_id, $limit, $offset); //ajax_url
        $url = admin_url("user_member/ajax_history/" . $user_id);
        $conf = array(
            'base_url' => $url,
            'total_rows' => $result['total'],
            'per_page' => $limit,
            'cur_page' => $p
        );
        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->ajax_url();
        $rows = $result['rows'];
        foreach ($rows as $k => $v) {
            switch ($v->result_status) {
                case 'winner':
                    $rows[$k]->result_status = "Thắng";
                    break;
                case 'lost':
                    $rows[$k]->result_status = "Thua";
                    break;
                default:
                    $rows[$k]->result_status = "Đang chơi";
            }
        }
        $this->data['rows'] = $rows;
        $this->load->view('user_member/history', $this->data);
    }

    function ajax_history($user_id = NULL, $p = 1) {
        $limit = 1;
        $offset = ($p - 1) * $limit;
        $result = $this->loto_model->history($user_id, $limit, $offset); //ajax_url
        $url = admin_url("user_member/ajax_history/" . $user_id);
        $conf = array(
            'base_url' => $url,
            'total_rows' => $result['total'],
            'per_page' => $limit,
            'cur_page' => $p
        );
        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->ajax_url();
        $rows = $result['rows'];
        foreach ($rows as $k => $v) {
            switch ($v->result_status) {
                case 'winner':
                    $rows[$k]->result_status = "Thắng";
                    break;
                case 'lost':
                    $rows[$k]->result_status = "Thua";
                    break;
                default:
                    $rows[$k]->result_status = "Đang chơi";
            }
        }
        $this->data['rows'] = $rows;
        $this->load->view('user_member/ajax_history', $this->data);
    }

    function change_pass() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('old_password', 'Mật khẩu cũ', 'required|trim|xss_clean|callback__check_login');
            $this->form_validation->set_rules('new_password', 'Mật khẩu mới', 'required|trim|xss_clean|min_length[6]|max_length[50]|matches[c_password]');
            $this->form_validation->set_rules('c_password', 'Mật khẩu xác nhận', 'required|trim|xss_clean');

            if ($this->form_validation->run() === TRUE) {
                $this->user_model->update($_SESSION['user']['id'], array('password' => md5($this->input->post('new_password'))));
                redirect(base_url() . 'acp_admin/login/');
                #echo "adasd";
            } else {
                $this->message->error = $this->form_validation->get_error_array();
                #echo "false";
            }
        }

        $this->data['tpl_file'] = 'admin/user_member/change_pass';
        $this->load->view('layout/default', $this->data);
    }

    function _check_login($pass) {
        if (!$this->user_model->get_by(array('username' => $_SESSION['user']['username'], 'password' => md5($pass), 'active' => 'yes'))) {
            $this->form_validation->set_message('_check_login', '%s là không đúng.');
            return FALSE;
        }
        return TRUE;
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean')
                    ->set_rules('password', 'Password', 'required|matches[re_password]|trim|xss_clean')
                    ->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
            ;

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'created_date' => date('Y-m-d H:i:s'),
                    'fullname' => $this->input->post('fullname'),
                    'address' => $this->input->post('address'),
                    'gender' => $this->input->post('gender'),
                    'mobile' => $this->input->post('mobile'),
                    'date_of_birth' => $this->input->post('date_of_birth'),
                    'email' => $this->input->post('email'),
                    'group_id' => $this->input->post('permission'),
                    'active' => $this->input->post('active'),
                    'is_admin' => 0,
                    'status' => 'active',
                    'city_id' => $this->input->post("city"),
                    'admin_create' => $_SESSION["user"]["username"],
                    'city_id' => $this->input->post("city")
                );

                if ($this->user_model->check_exist($data['username'])) {// Tồn tại username
                    die('This username not available !');
                } else {
                    $this->db->trans_begin();
                    $this->user_model->insert($data);
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        die("Có lỗi trong quá trình cập nhật.");
                    } else {
                        $this->db->trans_commit();
                        die('yes');
                    }
                }
            } else {
                die(validation_errors());
            }
        }

        //$data = array();
        //$this->data['group_list'] = $this->user_model->get_group_list();
        $this->load->view('user_member/add', $this->data);
    }

    function edit($user_id = '') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');

            $pass = $this->input->post('password');
            if ($pass != '') {
                $this->form_validation->set_rules('password', 'Password', 'matches[re_password]|trim|xss_clean');
            }

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'fullname' => $this->input->post('fullname'),
                    //'address'	=>	$this->input->post('address'),
                    'gender' => $this->input->post('gender'),
                    'mobile' => $this->input->post('mobile'),
                    'date_of_birth' => $this->input->post('date_of_birth'),
                    'email' => $this->input->post('email'),
                    'group_id' => $this->input->post('permission'),
                    'active' => $this->input->post('active'),
                    'city_id' => $this->input->post("city")
                );

                if ($pass = $this->input->post('password')) {
                    $data['password'] = md5($pass);
                }

                $this->db->trans_begin();
                if ($this->user_model->update($user_id, $data)) {
                    die('yes');
                }
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    //die($this->db->_error_message());
                } else {
                    $this->db->trans_commit();
                    die('yes');
                }
            } else {
                die(validation_errors());
            }
        }

        $data = array();
        $this->data['user'] = $this->user_model->get_by(array('id' => $user_id));

        $this->load->view('user_member/edit', $this->data);
    }

    /**
     * @date	11.03.2011
     */
    function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->input->post('id');
            if (is_numeric($id)) {
                $row = $this->user_model->get($id);
                $title = "Xóa thành viên $row->username bởi " . $_SESSION["user"]["username"];
                $this->user_model->delete($id);
                add_log($title, json_encode($row) . "|" . $this->db->last_query());
            } else { // multi : user_id is array
                //$this->user_model->delete_many($id);
            }
            die('yes');
        }
    }

    /**
     * @date	11.03.2011
     */
    function load_row($id = null) {
        $this->data['user'] = $this->user_model->get($id);
        $this->load->view('user_member/row', $this->data);
    }

    /**
     * @date	11.03.2011
     */
    function do_action() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_list = $this->input->post('id');
            $action = $this->input->post('action');

            if ($action == 'delete') {
                $this->delete();
            } elseif ($action == 'yes') {
                $this->user_model->update_many($id_list, array('active' => 'yes'));
            } elseif ($action == 'no') {
                $this->user_model->update_many($id_list, array('active' => 'no'));
            }

            die('yes');
        }
    }

    /**
     * @date	11.03.2011
     */
    function change_status() {
        $id = $this->input->post('user_id');
        $status = $this->input->post('status');

        $this->user_model->update_many($id, array('active' => $status));
        die('yes');
    }

}
