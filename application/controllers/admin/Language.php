<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
        $this->load->model(['admin_model', 'language_model']);
        if (empty($this->session->userdata('email'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $user_type = $this->session->userdata('user_type');
        $email = $this->session->userdata('email');
        return $this->admin_model->getUserdata($user_type, $email);
    }

    public function index($id = NULL) {
        if (!empty($id)) {
            $data['lang'] = $this->language_model->getLanguageById($id);
        }
        $data['table'] = '1';
        $data['title'] = 'Language';
        $data['user'] = $this->getUserData();
        $data['user_type'] = $this->session->userdata('user_type');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/language/view-language');
        $this->load->view('admin/commons/footer');
    }

    public function get_language_wrapper() {
        $this->output->set_content_type('application/json');
        $data['language'] = $this->language_model->getAllLanguage();
        $content_wrapper = $this->load->view('admin/language/language-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddLanguage() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('language_name', 'Language Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->language_model->doAddLanguage();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Language added sucessfully', 'url' => base_url('admin/language')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Language Not Added']));
            return FALSE;
        }
    }

    public function doEditLanguage($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('language_name', 'Language Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->language_model->doEditLanguage($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Language updated sucessfully', 'url' => base_url('admin/language')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Done', 'url' => base_url('language/language')]));
            return FALSE;
        }
    }

    public function changeLanguageStatus($language_id, $status) {
        $this->output->set_content_type('application/json');
        $this->language_model->changeLanguageStatus($language_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function text($id = NULL) {
        if (!empty($id)) {
            $data['text'] = $this->language_model->getTextById($id);
        }
        $data['table'] = '1';
        $data['title'] = 'Text';
        $data['user'] = $this->getUserData();
        $data['user_type'] = $this->session->userdata('user_type');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/language/view-text.php');
        $this->load->view('admin/commons/footer');
    }

    public function get_language_text_wrapper() {
        $this->output->set_content_type('application/json');
        $data['texts'] = $this->language_model->getAllText();
        $content_wrapper = $this->load->view('admin/language/language-text-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function changeLanguageTextStatus($text_id, $status) {
        $this->output->set_content_type('application/json');
        $this->language_model->changeLanguageTextStatus($text_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function doAddText() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('text', 'Text', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->language_model->doAddText();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details added Sucessfully', 'url' => base_url('admin/text')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Done', 'url' => base_url('admin/text')]));
            return FALSE;
        }
    }

    public function doEditText($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('text', 'Text', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->language_model->doEditText($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details updated sucessfully', 'url' => base_url('admin/text')]));
            return FALSE;
        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Done', 'url' => base_url('admin/text')]));
            return FALSE;
        }
    }

    public function textlang($id = NULL) {
        $data['title'] = 'Text By Language';
        if (!empty($id)) {
            $data['text'] = $this->language_model->getTextById($id);
        }
        $data['user'] = $this->getUserData();
        $data['user_type'] = $this->session->userdata('user_type');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/language/text-lang',$data);
        $this->load->view('admin/commons/footer');
    }

    public function update_text_lang($id) {
        $this->output->set_content_type('application/json');
        $language = [];
        $allLanguage['lang'] = $this->language_model->getAllLanguage();
        for ($i = 0; $i < count($allLanguage['lang']); $i++) {
            $field = $allLanguage['lang'][$i]['language'];
            array_push($language, $field);
            $this->form_validation->set_rules($field, $field, 'required');
        }
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->language_model->add_text_lang($id, $language);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details added sucessfully', 'url' => base_url('admin/text')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Done', 'url' => base_url('admin/text')]));
            return FALSE;
        }
    }

}
