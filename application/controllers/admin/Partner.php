<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email_partner');
    }

    public function getUserData() {
        $email = $this->session->userdata('email_partner');
        return $this->admin_model->getUserdata('partner', $email);
    }

    public function index() {
        if ($this->isLogin()) {
            redirect(base_url('partner/dashboard'));
        }
        $data['title'] = "Partner Login";
        $this->load->view('admin/partner', $data);
    }

    public function checkLogin() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->checkLogin('partner');
        if ($result) {
            if ($result['is_active'] == "Inactive") {
                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('partner/dashboard'), 'msg' => 'Your Account Has Been Deactivated!!']));
                return FALSE;
            }
            $this->session->set_userdata('is_partner', $this->input->post('partner'));
            $this->session->set_userdata('email_partner', $result['email']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('partner/dashboard'), 'msg' => 'Loading!! Please Wait']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
            return FALSE;
        }
    }

    public function dashboard() {
        if (!$this->isLogin()) {
            redirect(base_url('partner'));
        }
        $data['partner_js'] = '1';
        $data['title'] = 'Dashboard';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/commons/footer');
    }

    public function change_password() {
        if (!$this->isLogin()) {
            redirect(base_url('partner'));
        }
        $data['user'] = $this->getUserData();
        $data['title'] = 'Dashboard';
        $data['partner'] = '1';
        $data['partner_js'] = '1';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/change-password');
        $this->load->view('admin/commons/footer');
    }

    public function doChangePassword() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doChangePassword('partner', $this->isLogin());
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('partner/change-password'), 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
    }

    public function profile() {
        if (empty($this->isLogin())) {
            redirect(base_url('partner'));
        }
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['user'] = $this->getUserData();
        $data['title'] = 'User Profile';
        $data['partner_js'] = '1';
        $data['country_code'] = $this->admin_model->getCountryCode();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-profile', $data);
        $this->load->view('admin/commons/footer');
    }

    public function doUpdateProfile() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('address2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $email = $this->session->userdata('email_partner');
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadProfileImage();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $user = $this->admin_model->getUserDetail('partner', $email);
            $image_url = $user['image_url'];
        }
        $result = $this->admin_model->doUpdateProfile('partner', $email, $image_url,'');
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('partner/profile'), 'msg' => 'Profile Updated Succesfully!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made']));
            return FALSE;
        }
    }

    public function doUploadProfileImage() {
        $config = array(
            'upload_path' => "./uploads/profile_images/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048"
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

    public function logout() {
        $this->session->unset_userdata('email_partner');
        $this->session->unset_userdata('is_partner');
        redirect(base_url('partner'));
    }

    public function forgot_password() {

        $this->load->view('admin/forgot_password_partner');
    }

    public function forgot_password_checked() {
        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('email', 'Register Email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->varify_emailid();

        if (!empty($result)) {

            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $activationcode = substr(str_shuffle($str), 0, 10);

            $this->send_forgot_password_link($result, $activationcode);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Link has been sent on your email ', 'url' => base_url('admin/partner/forgot_password')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'errors' => 'This email id does not exist!']));
            return FALSE;
        }
    }

//end of function 

    public function send_forgot_password_link($result, $activationcode) {
        //$result = $result;
        //$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        //$activationcode = substr(str_shuffle($str), 0, 10);

        $getEmailResponse = $this->admin_model->insert_partner_activationcode($activationcode, $result);
        //if($getEmailResponse){	
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'canadianemarket@gmail.com',
            'smtp_pass' => 'HappyinGod!2017',
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = "<h3>Dear " . $result['first_name'] . ",</h3>";
        $htmlContent .= "<div style='padding-top:8px;'>Please click The following link For Update your password..</div>";
        $htmlContent .= base_url('partner/password-reset/' . $result['partner_id'] . '/' . $activationcode) . " Click Here!! Set new password!";

        $this->email->to($result['email']);
        $this->email->from('canadianemarket@gmail.com', 'MyWebsite');
        $this->email->subject('Hey!, ' . $result['first_name'] . " " . $result['last_name'] . ' your reset password link');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();

        return true;
    }

    public function password_reset($partner_id, $activationcode) {
        $data['partner_id'] = $partner_id;
        $checkResponse = $this->admin_model->update_partner_email_status($partner_id, $activationcode);

        if ($checkResponse) {
            $this->load->view('admin/partner_reset_password', $data);
        } else {
            echo "This is the Wrong or Expire Activation Code";
        }
    }

    public function update_forgot_password() {
        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doChangeForgotPassword();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('partner'), 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
    }

}
