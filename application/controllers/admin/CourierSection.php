<?php

/**
 * Description of Courier_module
 *
 * @author Mohit Kant Gupta
 */
class CourierSection extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'category_model', 'courier_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata('admin', $email);
    }

    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 10);
        return $unique_id;
    }

    public function index() {
		
        $data['title'] = 'Courier';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
		
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/courier/viewCourier');
        $this->load->view('admin/commons/footer');
    }

    public function get_courier_wrapper() {
        $this->output->set_content_type('application/json');
        $data['couriers'] = $this->courier_model->getCourier();
        $content_wrapper = $this->load->view('admin/courier/courier-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addCourier($id = null) {
        if (!empty($id)) {
            $data['courier'] = $this->courier_model->getCourierById($id);
        }
        $data['title'] = 'Add Courier';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/courier/addCourier');
        $this->load->view('admin/commons/footer');
    }

    public function doAddCourier() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This {field} field is already taken');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[courier.email]');
        $this->form_validation->set_rules('phone_no', 'Phone Number', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('country', 'Country Name', 'required');
        $this->form_validation->set_rules('state', 'State Name', 'required');
        $this->form_validation->set_rules('city', 'City Name', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip code', 'required');
        $this->form_validation->set_rules('store_address1', 'Store Address', 'required');
       
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image_url = $this->doUploadImg();
       
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        //$password = strtoupper($this->uniqueId());
        //$email = $this->input->post('email');
        //$message = "Login ID:- " . $email . " Password:- " . $password . "   ";
        //$message .= "  Login Url:- " . "http://www.designoweb.work/canadianemarket/courier";
        //$this->sendEmail($email, $message);
        $result = $this->courier_model->doAddCourier($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Partner added sucessfully', 'url' => base_url('admin/courierSection')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Partner did not added sucessfully.']));
            return FALSE;
        }
    }

    public function sendEmail($email, $message) {
        $this->email->from('canadianemarket@gmail.com');
        $this->email->to($email);
        $this->email->subject('Login Credentials');
        $this->email->message($message);
        $this->email->send();
        return FALSE;
    }

    function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/courier",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3072" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['image_url' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function doEditCourier($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This {field} field is already taken');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        $this->form_validation->set_rules('phone_no', 'Phone Number', 'required');
        $this->form_validation->set_rules('country', 'Country Name', 'required');
        $this->form_validation->set_rules('state', 'State Name', 'required');
        $this->form_validation->set_rules('city', 'City Name', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip code', 'required');
        $this->form_validation->set_rules('store_address1', 'Store Address', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadImg();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $serviceProvider = $this->courier_model->getCourierById($id);
            $image_url = $serviceProvider['image_url'];
        }
        $result = $this->courier_model->doEditCourier($id, $image_url);

        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details Updated Sucessfully', 'url' => base_url('admin/courierSection')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made', 'url' => base_url('admin/courierSection')]));
            return FALSE;
        }
    }

    public function doDeleteCourier($id) {
        $this->output->set_content_type('application/json');
        $result = $this->courier_model->doDeleteCourier($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/courierSection')]));
        }
    }

    public function changeCourierStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->courier_model->changeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    // Courier Application
    
    public function courier_application() {
        $data['title'] = 'Courier Application';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/courier-application/viewCourierEnquiry');
        $this->load->view('admin/commons/footer');
    }
    
    public function get_courier_enquiry_wrapper() {
        $this->output->set_content_type('application/json');
        $data['couriers_enquiry'] = $this->courier_model->getCourierEnquiry();
        $content_wrapper = $this->load->view('admin/courier-application/courier-enquiry-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
     public function viewCourierEnquiry($id) {
        if (!empty($id)) {
            $data['couriers_enquiry'] = $this->courier_model->viewCourierEnquiry($id);
        }
        $data['title'] = 'Courier Application';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/courier-application/viewDetailCourierEnquiry');
        $this->load->view('admin/commons/footer');
    }
     ///Change Password
    
    public function courier_change_password($id)
    {
        if (!empty($id)) {
            $data['courier'] = $this->courier_model->getCourierById($id);
        }
        $data['title'] = 'Courier Change Password';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/courier/courier-password-change');
        $this->load->view('admin/commons/footer');
    }
     public function updatePassword($courierId){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->courier_model->doUpdateCourierPassword($courierId);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password Updated sucessfully', 'url' => base_url('admin/courierSection')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password Not Updated.']));
            return FALSE;
        }
        
    }

}
