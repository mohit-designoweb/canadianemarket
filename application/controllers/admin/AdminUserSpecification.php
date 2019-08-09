<?php
/**
 * Description of Admin User Specification
 *
 * @author Mukesh Yadav
 */
class AdminUserSpecification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'category_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }
    
    public function index($id = NULL) {
        
        if (!empty($id)) {
            $data['specifi'] = $this->category_model->get_specification_by_id($id);
        }
        $data['table'] = '1';
        $data['title'] = 'User Specification';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/user-specification/specification');
        $this->load->view('admin/commons/footer');
    }
    
    public function do_add_specification() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('group_name', 'Specification Name', 'trim|required|is_unique[specification_group.group_name]|strtolower');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->do_add_specification();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Specification Added Sucessfully', 'url' => base_url('admin/user-specification')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'User Specification Not Added']));
            return FALSE;
        }
    }

    public function do_edit_specification($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('group_name', 'Specification Name', 'trim|required|strtolower');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->do_edit_specification($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'User specification updated successfully!', 'url' => base_url('admin/user-specification')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.', 'url' => base_url('admin/user-specification')]));
            return FALSE;
        }
    }

    public function get_specification_wrapper() {
        $this->output->set_content_type('application/json');
        $data['specifications'] = $this->category_model->getAllSpecification();
        $content_wrapper = $this->load->view('admin/user-specification/specification-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function change_specification_status($group_id, $status) {
        $this->output->set_content_type('application/json');
        $this->category_model->change_specification_status($group_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
}