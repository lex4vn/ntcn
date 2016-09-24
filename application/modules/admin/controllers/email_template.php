<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('admin' . EXT);

class Email_template extends Admin {

    function __construct() {
        parent::__construct();
        $this->load->model(array('email_template_model'));

        $this->data['template_list'] = array();
        $this->data['template_list']['module_top'] = 'Module Top';
        $this->data['template_list']['module_footer'] = 'Module chân trang';
        $this->data['template_list']['module_hotront'] = 'Hỗ trợ trực tuyến - Trang nội thất';
        $this->data['template_list']['module_hotro'] = 'Hỗ trợ trực tuyến - Các trang khác';
        $this->data['template_list']['module_doitac'] = 'Đối tác của chúng tôi';
        $this->data['template_list']['module_r_noithat'] = 'Module cột phải - Nội thất';
        $this->data['template_list']['module_r_else'] = 'Module cột phải - Các trang khác';
        $this->data['template_list']['module_r_menu'] = 'Module cột phải - Cạnh menu thiết kế';
        $this->data['template_list']['module_lienhe'] = 'Trang Liên hệ';
    }

    function index($page = 1) {
        $rows = $this->db->select("*")
                ->from("email_template")
                ->order_by('id', 'DESC')
                ->get()
                ->result();

        $this->data['rows'] = $rows;
        $this->data['tpl_file'] = 'email_template/index';
        $this->load->view('layout/default', $this->data);
    }

    function update($id = null) {
        $re = FALSE;
        $submit = array();
        $MODULE = $this->data['MODULE'];

        $row = $this->email_template_model->get($id);

        if ($row) {
            $submit['title'] = $row->title;
            $submit['name'] = $row->name;
            $submit['content'] = $row->content;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $this->input->post('title');
            $name = $this->input->post('name');
            $content = $this->input->post('content');

            $submit['title'] = $title;
            $submit['name'] = $name;
            $submit['content'] = $content;

            $this->form_validation->set_message('name_exist', 'Trùng %s');

            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('name', 'Tên định danh', 'required');
            $this->form_validation->set_rules('content', 'Nội dung', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'title' => $title,
                    'name' => $name,
                    'content' => $content,
                );
                if ($row) {
                    if ($this->email_template_model->get_by(array('id <>' => $id, 'name' => $name))) {
                        $this->message->error[] = '<p>Trùng Tên định danh.</p>';
                    } else {
                        if ($this->email_template_model->update($id, $data)) {
                            $re = TRUE;
                        }
                    }
                }//Update
                else {
                    $data['time'] = time();
                    if ($this->email_template_model->get_by(array('name' => $name))) {
                        $this->message->error[] = '<p>Trùng Tên định danh.</p>';
                    } else {
                        if ($this->email_template_model->insert($data)) {
                            $re = TRUE;
                        }
                    }
                }//Insert
            } else {
                $this->message->add('error', validation_errors());
            }
        }

        if ($re) {
            admin_redirect($this->data['module']);
        }

        $this->data['submitted'] = $submit;
        $this->data['row'] = $row;

        $this->data['tpl_file'] = 'email_template/update';
        $this->load->view('layout/default', $this->data);
    }

    function delete($id = NULL) {
        if ($row = $this->email_template_model->get($id)) {
            if ($this->email_template_model->delete($id)) {
                admin_redirect($this->data['module']);
            }
        }
    }

}
