<?php

/**
 * Description of User
 *
 * @author Mohit Kant Gupta
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email_admin');
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata('admin', $email);
    }

    public function index() {
        if (empty($this->isLogin())) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'Registered User';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/registered-user/viewUser');
        $this->load->view('admin/commons/footer');
    }

    public function get_user_wrapper() {
        $this->output->set_content_type('application/json');
        $data['users'] = $this->admin_model->getUser();
        $content_wrapper = $this->load->view('admin/registered-user/user-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function add_registered_user($id = NULL) {
        if (!empty($id)) {
            $data['user_detail'] = $this->admin_model->getUserByID($id);
        }
        $data['title'] = 'Add Registered User';
        $data['user'] = $this->getUserData();
        $data['table'] = '1';
        $this->load->view('admin/commons/header', $data);
         $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/registered-user/addUser');
        $this->load->view('admin/commons/footer');
    }

    public function getPassword() {
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $password = substr(str_shuffle($str), 0, 10);
        return $password;
    }

    public function doUploadUserImg() {
        $config = array(
            'upload_path' => "./uploads/profile_images",
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

    public function doAddUser() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone', 'required');
        $this->form_validation->set_rules('address1', 'Street Address 1', 'required');
        $this->form_validation->set_rules('address2', 'Street Address 2', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image_url = $this->doUploadUserImg();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $user_email = $this->input->post('email');
        $password = $this->getPassword();
        $message = "User Name" . $user_email . "  and  " . "Password  " . $password;
        $this->sendMail($user_email, $message);
        $result = $this->admin_model->doAddUser($image_url, $password);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Added Successfully', 'url' => base_url('admin/registered-user')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'User Not Added']));
            return FALSE;
        }
    }

    public function sendMail($user_email, $message) {
        $this->email->from('canadianemarket@gmail.com');
        $this->email->to($user_email);
        $this->email->subject('Profile Username & Password');
        $this->email->message($message);
        $this->email->send();
        return FALSE;
    }

    public function doEditUser($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone', 'required');
        $this->form_validation->set_rules('address1', 'Street Address 1', 'required');
        $this->form_validation->set_rules('address2', 'Street Address 2', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadUserImg();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $product = $this->admin_model->getUserByID($id);
            $image_url = $product['image_url'];
        }

        $result = $this->admin_model->doEditUser($id, $image_url);

        if ($result) {


            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Profile Updated Successfully', 'url' => base_url('admin/registered-user')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Update Profile']));
            return FALSE;
        }
    }

    public function doDeleteUserById($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->doDeleteUserById($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => '', 'url' => base_url('admin/registered-user')]));
            return FALSE;
        }
    }

    public function doChangeUserStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->admin_model->doChangeUserStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    //Restaurant Slider
    public function restaurantsSlider() {
        if (empty($this->isLogin())) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'restaurantsSlider';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['user_type'] = $this->session->userdata('user_type');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/restaurantsSlider/viewSlider');
        $this->load->view('admin/commons/footer');
    }

    public function get_slider_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['sliders'] = $this->admin_model->getSlider();
        $content_wrapper = $this->load->view('admin/restaurantsSlider/slider-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addSlider($id = null) {
        if (!empty($id)) {
            $data['partner'] = $this->slider_model->getPartnerById($id);
        }
        $data['title'] = 'Slider';
        // $data['countries'] = $this->getFilterCountry();
        $data['user_type'] = $this->session->userdata('user_type');
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/restaurantsSlider/addSlider');
        $this->load->view('admin/commons/footer');
    }

    public function doAddSlider() {
        $this->output->set_content_type('application/json');
        $image_url = $this->doUploadImg();

        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $result = $this->admin_model->doAddSlider($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Slider added sucessfully', 'url' => base_url('admin/admin/restaurantsSlider')]));
            return FALSE;
        }
    }

    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/restaurants_slider",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
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

    public function doDeleteSlider($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->doDeleteSlider($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Slider Deleted sucessfully', 'url' => base_url('admin/restaurantsSlider')]));
            return FALSE;
        }
    }

    public function changeSliderStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->admin_model->changeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    /////////to import csv file!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 14);
        return $unique_id;
    }

    function uploadData()
    {
        $this->output->set_content_type('application/json');
        $unique_id = $this->uniqueId();
        $password = $this->getPassword();
        $filename1 = $_FILES['userfile']['name'];
        $filename=$_FILES["userfile"]["tmp_name"];
        $ext = pathinfo($filename1, PATHINFO_EXTENSION);
        //echo $ext; die;
        if(empty($filename)){
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please Insert Csv File']));
            return FALSE;
        }
        if($ext !== 'csv'){
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please Upload only Csv File']));
            return FALSE;
        }
        if($_FILES["userfile"]["size"] > 0)
        {
        $file = fopen($filename, "r");
        $count=0;
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            if($count>0)
            {
                 $insert_csv = array();
                 $insert_csv['user_name'] =addslashes($emapData[0]);
                 $insert_csv['email'] =addslashes($emapData[1]);
                 $insert_csv['password'] =$password;
                 $insert_csv['source'] =addslashes($emapData[2]);
                 $insert_csv['unique_id'] =$unique_id; 
                 $insert_csv['last_name'] =addslashes($emapData[3]);
                 $insert_csv['phone'] =addslashes($emapData[4]);
                 $insert_csv['address1'] =addslashes($emapData[5]);
                 $insert_csv['address2'] =addslashes($emapData[6]);
                 $insert_csv['dob'] =addslashes($emapData[7]);
                 $insert_csv['gender'] =addslashes($emapData[8]);
                 $insert_csv['is_active'] =addslashes($emapData[9]);

                if(empty($insert_csv['user_name']) || empty($insert_csv['email']) || empty($insert_csv['source']) || empty($insert_csv['unique_id']) || empty($insert_csv['last_name']) || empty($insert_csv['phone']) || empty($insert_csv['address1']) || empty($insert_csv['address2']) || empty($insert_csv['dob']) || empty($insert_csv['gender']) || empty($insert_csv['is_active'])){
                    $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please fill all the Details']));
                    return FALSE;

                 }
                  $result = $this->admin_model->checkData($insert_csv['user_name'],$insert_csv['email']);
                  if($result>0){
                    $this->output->set_output(json_encode(['result' => 0, 'errors' => 'User already inserted']));
                    return FALSE;
                  } 
        }
        $count++;
        }

        $file = fopen($filename, "r");
        $count=0;
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            
            if($count>0)
            {
                 $insert_csv = array();
                 $insert_csv['user_name'] =addslashes($emapData[0]);
                 $insert_csv['email'] =addslashes($emapData[1]);
                 $insert_csv['password'] =$password;
                 $insert_csv['source'] =addslashes($emapData[2]);
                 $insert_csv['unique_id'] =$unique_id; 
                 $insert_csv['last_name'] =addslashes($emapData[3]);
                 $insert_csv['phone'] =addslashes($emapData[4]);
                 $insert_csv['address1'] =addslashes($emapData[5]);
                 $insert_csv['address2'] =addslashes($emapData[6]);
                 $insert_csv['dob'] =addslashes($emapData[7]);
                 $insert_csv['gender'] =addslashes($emapData[8]);
                 $insert_csv['is_active'] =addslashes($emapData[9]);

                $data = array(
                'user_name' => $insert_csv['user_name'] ,
                'email' => $insert_csv['email'],
                'password' => $insert_csv['password'],
                'source' => $insert_csv['source'],
                'unique_id' => $insert_csv['unique_id'],
                'last_name' => $insert_csv['last_name'],
                'phone' => $insert_csv['phone'],
                'address1' => $insert_csv['address1'],
                'address2' => $insert_csv['address2'],
                'dob' => $insert_csv['dob'],
                'gender' => $insert_csv['gender'],
                'is_active' => $insert_csv['is_active']
            );

                  $this->admin_model->uploadData($data);
           
                  $user_email = $insert_csv['email'];
            
                  $message = "User Name" . $user_email . "  and  " . "Password  " . $password;
                  $this->sendMail($user_email, $message);
        }
        $count++;
        $unique_id = $this->uniqueId();
        $password = $this->getPassword();
        }
          redirect('admin/registered-user');
          fclose($file) or die("can't close file");
        }
    }
    /////////End import csv file!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    ////change password
    
    public function user_change_password($id)
    {
        if (!empty($id)) {
            $data['user'] = $this->admin_model->getUserdataById($id);
        }
        $data['title'] = 'User Change Password';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/registered-user/user-password-change');
        $this->load->view('admin/commons/footer');
    }
     public function updatePassword($userId){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doUpdateUserPassword($userId);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password Updated sucessfully', 'url' => base_url('admin/user')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password Not Updated.']));
            return FALSE;
        }
        
    }

}
