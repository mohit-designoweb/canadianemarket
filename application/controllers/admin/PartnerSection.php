<?php

/**
 * Description of Partner_module
 *
 * @author Mohit Kant Gupta
 */
class PartnerSection extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'category_model', 'partner_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    private function getFilterCountry() {
        $list = ['' => 'Select the Country'];
        $countries = $this->category_model->getCountry();
        foreach ($countries as $country) {
            $list[$country['id']] = $country['name'];
        }
        return $list;
    }

    private function getFilterCity($state_id) {
        $list = ['' => 'Select the City'];
        $cities = $this->category_model->getCity($state_id);
        foreach ($cities as $city) {
            $list[$city['id']] = $city['name'];
        }
        return $list;
    }

    private function getFilterState($country_id) {
        $list = ['' => 'Select the State'];
        $countries = $this->category_model->getState($country_id);
        foreach ($countries as $country) {
            $list[$country['id']] = $country['name'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Partner';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/partner/viewPartner');
        $this->load->view('admin/commons/footer');
    }

    public function addPartner($id = null) {
        if (!empty($id)) {
            $data['partner'] = $this->partner_model->getPartnerById($id);
        }
        $data['title'] = 'Add Partner';
        $data['countries'] = $this->getFilterCountry();
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/partner/addPartner');
        $this->load->view('admin/commons/footer');
    }

    public function changeState() {
        $data['states'] = $this->getFilterState($this->input->post('country_id'));
        $this->load->view('admin/city/changeState', $data);
    }

    public function changeCity() {
        $data['cities'] = $this->getFilterCity($this->input->post('state_id'));
        $this->load->view('admin/city/changeState', $data);
    }
	public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 14);
        return $unique_id;
    }

    public function doAddPartner() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This {field} field is already taken');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[partner.email]');
        $this->form_validation->set_rules('phone_no', 'Phone Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('country', 'Country Name', 'required');
        $this->form_validation->set_rules('state', 'State Name', 'required');
        $this->form_validation->set_rules('city', 'City Name', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip code', 'required');
        $this->form_validation->set_rules('store_address1', 'Store Address', 'required');
        $this->form_validation->set_rules('store_address2', 'Address Line 2', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
//		$sendPwd = $this->uniqueId();
//        $password = hash('sha256',$sendPwd);
//		$email = $this->input->post('email');
//		$message = "Your Login Id Is:- ".$email." And Password Is:- ".$sendPwd;
//		$this->emailPassword($email,$message);
        $image_url = $this->doUploadImg();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
//        $password = substr(strtoupper(md5(uniqid())), 0, 10);
        $result = $this->partner_model->doAddPartner($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Partner added sucessfully', 'url' => base_url('admin/partnerSection')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Partner did not added sucessfully.']));
            return FALSE;
        }
    }
//	public function emailPassword($email,$message)
//	{
//		$this->email->from('canadianemarket@gmail.com');
//		$this->email->to($email);
//		$this->email->subject('Profile Login Detail');
//		$this->email->message($message);
//		$this->email->send();
//	}

    function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/partner",
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

    public function doEditPartner($id) {
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
        $this->form_validation->set_rules('store_address2', 'Address Line 2', 'required');
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
            $serviceProvider = $this->partner_model->getPartnerById($id);
            $image_url = $serviceProvider['image_url'];
        }
        $result = $this->partner_model->doEditPartner($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details Updated Sucessfully', 'url' => base_url('admin/partnerSection')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made', 'url' => base_url('admin/partnerSection')]));
            return FALSE;
        }
    }
	
	public function partnerChangePassword($id){
        if (!empty($id)) {
            $data['partner'] = $this->partner_model->getPartnerById($id);
        }
        $data['title'] = 'Change Password';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/partner/partner-password-change');
        $this->load->view('admin/commons/footer');
    }
    
    public function updatePassword($partnerid){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->partner_model->doUpdatePartnerPassword($partnerid);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password Updated sucessfully', 'url' => base_url('admin/partnerSection')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password Not Updated.']));
            return FALSE;
        }
        
    }

    public function get_partner_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['partners'] = $this->partner_model->getPartner();
        $content_wrapper = $this->load->view('admin/partner/partner-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function changePartnerStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->partner_model->changeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function partner_application() {
        $data['title'] = 'Partner Application';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/partner-application/viewPartnerEnquiry');
        $this->load->view('admin/commons/footer');
    }

    public function viewPartnerEnquiry($id) {
        if (!empty($id)) {
            $data['partner_enquiry'] = $this->partner_model->viewPartnerEnquiry($id);
        }
        $data['title'] = 'Partner Application';
        $data['countries'] = $this->getFilterCountry();
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/partner-application/viewDetailPartnerEnquiry');
        $this->load->view('admin/commons/footer');
    }

    public function get_partner_enquiry_wrapper() {
        $this->output->set_content_type('application/json');
        $data['partners'] = $this->partner_model->getPartnerEnquiry();
        $content_wrapper = $this->load->view('admin/partner-application/partner-enquiry-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    /////////import partne thrugh CSV file!!!!!!!!!!!!!!!!!!!!!!!!!!

    function uploadData()
    {
          $this->output->set_content_type('application/json');
          $sendPwd = $this->uniqueId();
          $password = hash('sha256',$sendPwd);
         $filename1 = $_FILES['userfile']['name'];
         $filename=$_FILES["userfile"]["tmp_name"];
         $ext = pathinfo($filename1, PATHINFO_EXTENSION);
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
                 $insert_csv['first_name'] =addslashes($emapData[0]);
                 $insert_csv['last_name'] =addslashes($emapData[1]);
                 $insert_csv['password'] = $password; 
                 $insert_csv['email'] =addslashes($emapData[2]);
                 $insert_csv['address1'] =addslashes($emapData[3]);
                 $insert_csv['address2'] =addslashes($emapData[4]);
                 $insert_csv['city'] =addslashes($emapData[5]);
                 $insert_csv['state'] =addslashes($emapData[6]);
                 $insert_csv['zipcode'] =addslashes($emapData[7]);               
                 $insert_csv['country'] =addslashes($emapData[8]);
                 $insert_csv['phone_no'] =addslashes($emapData[9]);
                 $insert_csv['is_active'] =addslashes($emapData[10]);
                 if(empty($insert_csv['first_name']) || empty($insert_csv['last_name']) || empty($insert_csv['email']) || empty($insert_csv['address1']) || empty($insert_csv['address2']) || empty($insert_csv['city']) || empty($insert_csv['state']) || empty($insert_csv['zipcode']) || empty($insert_csv['country']) || empty($insert_csv['phone_no']) || empty($insert_csv['is_active'])){
                    $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please fill all the Details']));
                    return FALSE;

                 }
                   $result = $this->partner_model->checkData($insert_csv['first_name'],$insert_csv['email']);
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
                 $insert_csv['first_name'] =addslashes($emapData[0]);
                 $insert_csv['last_name'] =addslashes($emapData[1]);
                 $insert_csv['password'] =$password;
                 $insert_csv['email'] =addslashes($emapData[2]);
                 $insert_csv['address1'] =addslashes($emapData[3]);
                 $insert_csv['address2'] =addslashes($emapData[4]);
                 $insert_csv['city'] =addslashes($emapData[5]);
                 $insert_csv['state'] =addslashes($emapData[6]);
                 $insert_csv['zipcode'] =addslashes($emapData[7]);
                 $insert_csv['country'] =addslashes($emapData[8]);
                 $insert_csv['phone_no'] =addslashes($emapData[9]);
                 $insert_csv['is_active'] =addslashes($emapData[10]);
                 
             $data = array(
                'first_name' => $insert_csv['first_name'] ,
                'last_name' => $insert_csv['last_name'],
                'password' => $insert_csv['password'],
                'email' => $insert_csv['email'],
                'address1' => $insert_csv['address1'],
                'address2' => $insert_csv['address2'],
                'city' => $insert_csv['city'],
                'state' => $insert_csv['state'],
                'zipcode' => $insert_csv['zipcode'],
                'country' => $insert_csv['country'],
                'phone_no' => $insert_csv['phone_no'],
                'is_active' => $insert_csv['is_active']
            );

                $this->partner_model->uploadData($data);

                $email = $insert_csv['email'];
                $message = "Your Login Id Is:- ".$email." And Password Is:- ".$password;
                $this->emailPassword($email,$message);   
       
        }
        $count++;
          $sendPwd = $this->uniqueId();
          $password = hash('sha256',$sendPwd);
        }
        redirect('admin/partnerSection');
        fclose($file) or die("can't close file");
        }    
    }


}
