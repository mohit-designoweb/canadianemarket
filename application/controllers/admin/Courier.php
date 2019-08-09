<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Courier extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'courier_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email_courier');
    }

    public function getUserData() {
        $email = $this->session->userdata('email_courier');
        return $this->admin_model->getUserdata('courier', $email);
    }

    public function getAllCourierData() {
        $data['user'] = $this->getUserData();
        $data['is_courier'] = $this->session->userdata('is_courier');
        $restaurant_order_id = $data['restaurant_order_id'] = $this->courier_model->getRestaurantOrderDetail($data['user']['courier_id']);
        $i = 0;
        $getRestaurantUserDetail = [];
        foreach ($restaurant_order_id as $order_id) {
            $getRestaurantUserDetail[$i] = $this->courier_model->getRestaurantUserDetail($order_id);
            $i++;
        }
        return $getRestaurantUserDetail;
    }

    public function index() {
        if ($this->isLogin()) {
            redirect(base_url('courier/dashboard'));
        }
        $data['title'] = "Courier Login";
        $this->load->view('admin/courier', $data);
    }

    public function checkLogin() {

        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->checkLogin('courier');
        if ($result) {
            $this->session->set_userdata('is_courier', $this->input->post('courier'));
            $this->session->set_userdata('email_courier', $result['email']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('courier/dashboard'), 'msg' => 'Loading!! Please Wait']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
            return FALSE;
        }
    }

    public function dashboard() {
        if (!$this->isLogin()) {
            redirect(base_url('courier'));
        }
        $data['title'] = 'Dashboard';
        $data['user'] = $this->getUserData();
        $data['getRestaurantUserDetail'] = $this->getAllCourierData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/courier-sidebar', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/commons/footer');
    }

    public function change_password() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'Dashboard';
        $this->load->view('admin/commons/header', $data);
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
        $result = $this->admin_model->doChangePassword($this->isLogin());
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
    }

    public function profile() {
        if (empty($this->isLogin())) {
            redirect(base_url('admin'));
        }
        $email = $this->session->userdata('email');
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['user'] = $this->getUserData();
        $data['title'] = 'User Profile';
        $data['country_code'] = $this->admin_model->getCountryCode();
        $data['user_detail'] = $this->admin_model->getUserDetail('courier', $email);
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/courier-sidebar', $data);
        $this->load->view('admin/courier-profile');
        $this->load->view('admin/commons/footer');
    }

    public function doUpdateProfile() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'First Name', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('address2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
        $this->form_validation->set_rules('country_code', 'Country', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $email = $this->session->userdata('email_courier');
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadProfileImage();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $user = $this->admin_model->getUserDetail('courier', $email);
            $image_url = $user['image_url'];
        }
        if (!empty($_FILES['dl_image_url']['name'])) {
            $dl_image_url = $this->doUploadDrivingLicenceLImage();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $user = $this->admin_model->getUserDetail('courier', $email);
            $dl_image_url = $user['driving_licence_image'];
        }
        $result = $this->admin_model->doUpdateProfile('courier', $email, $image_url, $dl_image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('courier/profile'), 'msg' => 'Profile Updated Succesfully!!']));
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

    public function doUploadDrivingLicenceLImage() {
        $config = array(
            'upload_path' => "./uploads/courier_driving_licence/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('dl_image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['image_url' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function logout() {
        $this->session->unset_userdata('email_courier');
        $this->session->unset_userdata('is_courier');
        redirect(base_url('courier'));
    }

    public function get_notification() {
        $this->output->set_content_type('application/json');
        $data['user'] = $this->getUserData();
        $data['is_courier'] = $this->session->userdata('is_courier');
        $restaurant_order = $data['restaurant_order_id'] = $this->courier_model->getSingleRestaurantOrderDetail($data['user']['courier_id']);
        $data['order_detail'] = $order_detail = $this->courier_model->getSingleRestaurantUserDetail($restaurant_order['restaurant_order_id']);
        if (!empty($order_detail)) {
//            print_r($order_detail);
            if ($order_detail['status'] == 0) {
                $notification_wrapper = $this->load->view('admin/commons/includes/get-notification', $data, true);
                $this->output->set_output(json_encode(['result' => 1, 'notification_wrapper' => $notification_wrapper]));
                return FALSE;
            } else {
                $this->output->set_output(json_encode(['result' => -1]));
                return FALSE;
            }
        }
    }

    public function view_order() {
        $data['title'] = "Courier Order";
        $data['user'] = $this->getUserData();
        $data['getRestaurantUserDetail'] = $this->getAllCourierData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/courier-sidebar', $data);
        $this->load->view('admin/courier-order-management/view-order');
        $this->load->view('admin/commons/footer');
    }

    public function get_courier_restaurant_order_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user'] = $this->getUserData();
        $data['getRestaurantUserDetail'] = $this->getAllCourierData();
        $content_wrapper = $this->load->view('admin/courier-order-management/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function setCourierLocation() {
        $this->output->set_content_type('application/json');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $data = $this->getUserData();
        $result = $this->courier_model->setCourierLocation($latitude, $longitude, $data['courier_id']);
        $this->session->set_userdata('latitude', $latitude);
        $this->session->set_userdata('longitude', $longitude);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function startService() {
        $this->output->set_content_type('application/json');
        $data = $this->getUserData();
        $now = date('H:i:s');
        $service_end_time = date('H:i:s', strtotime('4 hour'));
        $result = $this->courier_model->startService($data['courier_id'], $now);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('courier/dashboard'), 'form' => 'start-service']));
        return false;
    }

    public function endService() {
        $this->output->set_content_type('application/json');
        $data = $this->getUserData();
        $result = $this->courier_model->endService($data['courier_id']);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('courier/dashboard')]));
        return false;
    }

    public function courierOrderDetail($order_id, $courier_order_mapping_id = NULL) {
        if (!empty($courier_order_mapping_id)) {
            $this->courier_model->updateCourierOrderMappingStatus($courier_order_mapping_id);
        }
        $data['title'] = 'Courier Order';
        $data['user'] = $this->getUserData();
        $data['getRestaurantUserDetail'] = $this->getAllCourierData();
        $data['courierOrderMappingDetail'] = $this->courier_model->getOrderDateTime($order_id);
        $data['order_id'] = $order_id;
        $data['order_detail1'] = $this->courier_model->getOrderDetailById($order_id);
        $data['user_info'] = $this->courier_model->getUserDetailById($data['order_detail1']['user_id']);
        $data['menu'] = $this->courier_model->getMenuDetailById($data['order_detail1']['menu_id']);
        $data['order_detail'] = $this->courier_model->getOrderDetailByUniqueId($data['order_detail1']['unique_order_id']);
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/courier-sidebar', $data);
        $this->load->view('admin/courier-order-management/courier-order');
        $this->load->view('admin/commons/footer');
    }

    public function get_courier_wrapper($order_id) {
        $this->output->set_content_type('applicatiion/json');
        $data['courierOrderMappingDetail'] = $mappingDetail = $this->courier_model->getOrderDateTime($order_id);
        $data['order_detail1'] = $order_detail1 = $this->courier_model->getOrderDetailById($order_id);
        if ($mappingDetail['order_accepted_status'] == 'No') {
            $courier_order_wrapper = $this->load->view('admin/courier-order-management/includes/courier-order-accept-wrapper', $data, TRUE);
            $this->output->set_output(json_encode(['result' => 1, 'courier_order_wrapper' => $courier_order_wrapper]));
            return FALSE;
        }
        if ($order_detail1['order_status'] == 'OutForDelivery' && $mappingDetail['order_received'] == 'No') {
            $courier_order_wrapper = $this->load->view('admin/courier-order-management/includes/courier-order-accept-wrapper', $data, TRUE);
            $this->output->set_output(json_encode(['result' => 1, 'courier_order_wrapper' => $courier_order_wrapper]));
            return FALSE;
        }
        if ($order_detail1['order_status'] == 'OutForDelivery' && $mappingDetail['order_received'] == 'Yes') {
            $courier_order_wrapper = $this->load->view('admin/courier-order-management/includes/courier-order-delivered-wrapper', $data, TRUE);
            $this->output->set_output(json_encode(['result' => 1, 'courier_order_wrapper' => $courier_order_wrapper]));
            return FALSE;
        }
    }

    public function updateCourierAvailableStatus($mapping_id, $restaurant_order_id, $status) {
        $this->output->set_content_type('application/json');
        $courier = $this->getUserData();
        if ($status == 'Accepted') {
            $data['order_id'] = $restaurant_order_id;
            $this->courier_model->updateOrderAcceptedStatus($mapping_id, 'Yes');
            $this->courier_model->restaurantOrderAcceptedStatus($restaurant_order_id, 'Accepted', $courier['courier_id']);
            $this->courier_model->updateCourierAvailableStatus($courier['courier_id'], 'No');
            $courier_order_wrapper = $this->load->view('admin/courier-order-management/includes/courier-waiting-wrapper', $data, TRUE);
            $this->output->set_output(json_encode(['result' => 1, 'courier_order_wrapper' => $courier_order_wrapper]));
            return FALSE;
        } else if ($status == 'Rejected') {
            $this->courier_model->restaurantOrderAcceptedStatus($restaurant_order_id, 'Rejected', $courier['courier_id']);
            $this->courier_model->orderRejectedByCourier($mapping_id);
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('courier/view-order')]));
            return FALSE;
        }
    }

    public function check_for_accept_order($order_id) {
        $this->output->set_content_type('application/json');
        $result = $this->courier_model->checkOrderStatus($order_id);
        $data['order_id'] = $order_id;
        $data['courierOrderMappingDetail'] = $mappingDetail = $this->courier_model->getOrderDateTime($order_id);
        if ($result) {
            $courier_order_wrapper = $this->load->view('admin/courier-order-management/includes/courier-item-receive-wrapper', $data, TRUE);
            $this->output->set_output(json_encode(['result' => 1, 'courier_order_wrapper' => $courier_order_wrapper]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1]));
            return FALSE;
        }
    }

    public function updateOrderReceivedStatus($mapping_id, $order_id) {
        $this->output->set_content_type('application/json');
        $result = $this->courier_model->updateOrderReceivedStatus($mapping_id);
        $data['courierOrderMappingDetail'] = $this->courier_model->getOrderDateTime($order_id);
        $data['order_detail1'] = $order_detail1 = $this->courier_model->getOrderDetailById($order_id);
        if ($result) {
            $courier_order_wrapper = $this->load->view('admin/courier-order-management/includes/courier-order-delivered-wrapper', $data, TRUE);
            $this->output->set_output(json_encode(['result' => 1, 'courier_order_wrapper' => $courier_order_wrapper]));
            return FALSE;
        }
    }

    public function updateCourierDeliveryStatus($id, $order_id) {
        $this->output->set_content_type('application/json');
        $data['courier'] = $this->getUserData();
        $status = "Yes";
        $result = $this->courier_model->updateOrderStatusInRestaurant($order_id);
        $result = $this->courier_model->updateCourierAvailableStatus($data['courier']['courier_id'], $status);
        $result = $this->courier_model->updateCourierDeliveryStatus($id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('courier/view-order')]));
        return FALSE;
    }

    public function forgot_password() {

        $this->load->view('admin/forgot_password_courier');
    }

    public function forgot_password_checked() {
        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('email', 'Register Email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->varify_courier_emailid();

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

        $getEmailResponse = $this->admin_model->insert_courier_activationcode($activationcode, $result);
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
        $htmlContent .= base_url('courier/password-reset/' . $result['courier_id'] . '/' . $activationcode) . " Click Here!! Set new password!";

        $this->email->to($result['email']);
        $this->email->from('canadianemarket@gmail.com', 'MyWebsite');
        $this->email->subject('Hey!, ' . $result['first_name'] . " " . $result['last_name'] . ' your reset password link');
        $this->email->message($htmlContent);

        //Send email
        $this->email->send();

        return true;
    }

    public function password_reset($courier_id, $activationcode) {
        $data['courier_id'] = $courier_id;
        $checkResponse = $this->admin_model->update_courier_email_status($courier_id, $activationcode);

        if ($checkResponse) {
            $this->load->view('admin/courier_reset_password', $data);
        } else {
            echo "This is the Wrong or Expire Activation Code";
        }
    }

//end of function 

    public function update_forgot_password() {
        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doChangeForgotPasswordCourier();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('courier'), 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
    }

}
