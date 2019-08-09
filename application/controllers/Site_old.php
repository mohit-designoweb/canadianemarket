<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ecommerce_model');
        $this->load->config('facebook');
    }

    public function getLanguage() {
        if (!empty($this->session->userdata('language'))) {
            $language = $this->session->userdata('language');
        } else {
            $language = 'English';
            $this->session->set_userdata('language',$language);
        }
        $language_texts= $this->ecommerce_model->getTextByLang($language);
        $list=[];
        foreach ($language_texts as $text){
            $list[$text['text']]=$text[$language];
        }
        return $list;
    }

    public function getDataByUniqueId() {
        if (!empty($this->session->userdata('unique_id'))) {
            $unique_id = $this->session->userdata('unique_id');
            $data = $this->ecommerce_model->getDataByUniqueId($unique_id);
            return $data;
        }
    }

    public function index() {
        $data['user_data']=$this->getDataByUniqueId();
        $data['title']='Home';
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['language_text'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/index');
        $this->load->view('front/commons/footer');
    }

    public function changeLanguage() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('lang');
        $this->session->set_userdata('language', $language);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    public function setUserLocation(){
        $this->output->set_content_type('application/json');
        $latitude= $this->input->post('latitude');
        $longitude= $this->input->post('longitude');
        $this->session->set_userdata('latitude',$latitude);
        $this->session->set_userdata('longitude',$longitude);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function aboutus() {
		$data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/aboutus');
        $this->load->view('front/commons/footer');
    }

    public function accountupload() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/accountupload');
        $this->load->view('front/commons/footer');
    }

    public function stores() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/stores');
        $this->load->view('front/commons/footer');
    }

   public function career_detail($alias) {
        $data['job_detail'] = $this->ecommerce_model->getJobDetailByJobName($alias);
        $data['user_data']=$this->getDataByUniqueId();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/career-detail');
        $this->load->view('front/commons/footer');
    }
   public function career() {
        $data['user_data']=$this->getDataByUniqueId();
        $data['job_categories'] = $this->ecommerce_model->getActiveJobCategory();
        $data['all_jobs'] = $this->ecommerce_model->getAllActiveJob();
        $data['job_type'] = $this->ecommerce_model->getJobType();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/career', $data);
        $this->load->view('front/commons/footer');
    }
	
    public function cart() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/cart');
        $this->load->view('front/commons/footer');
    }

    public function confirm_order() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/confirm-order');
        $this->load->view('front/commons/footer');
    }

    public function courier() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $data['country_code'] = $this->ecommerce_model->getCountryCode();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/courier');
        $this->load->view('front/commons/footer');
    }

    public function fashion() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/fashion');
        $this->load->view('front/commons/footer');
    }

    public function giftcard() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/giftcard');
        $this->load->view('front/commons/footer');
    }

   public function help() {
        $data['user_data']=$this->getDataByUniqueId();
        $data['categories'] = $this->ecommerce_model->getHelpCategory();
        $this->load->view('front/commons/header');
        $this->load->view('front/help', $data);
        $this->load->view('front/commons/footer');
    }
	
	 public function help_category_wrapper() {
        $id = $this->input->post('cat_id');
        $this->output->set_content_type('application/json');
        $data['result'] = $this->ecommerce_model->help_category_wrapper($id);
        $content_wrapper = $this->load->view('front/help-content-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function market_place() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/market-place');
        $this->load->view('front/commons/footer');
    }

    public function myaccount() {
		$data['user_data']=$this->getDataByUniqueId();
        //$data['login_user_detail'] = $this->getDataByUniqueId();
        //$user_id = $data['login_user_detail']['user_id'];
        //$data['formData'] = $this->ecommerce_model->myAccountFormData($user_id);
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/myaccount');
        $this->load->view('front/commons/footer');
    }

    public function order_history() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/order-history');
        $this->load->view('front/commons/footer');
    }

    public function partner_with_us() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $data['country_code'] = $this->ecommerce_model->getCountryCode();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/partner-withus');
        $this->load->view('front/commons/footer');
    }

    public function payment() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/payment');
        $this->load->view('front/commons/footer');
    }

    public function product_detail() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/product-detail');
        $this->load->view('front/commons/footer');
    }

    public function privacy() {
        $data['user_data']=$this->getDataByUniqueId();
        $data['content'] = $this->ecommerce_model->getPrivacyPageContent();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/privacy');
        $this->load->view('front/commons/footer');
    }

    public function shipping() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/shipping');
        $this->load->view('front/commons/footer');
    }

    public function store_listing() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/store-listing');
        $this->load->view('front/commons/footer');
    }

     public function terms() {
        $data['user_data']=$this->getDataByUniqueId();
        $data['content'] = $this->ecommerce_model->getTermsPageContent();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/terms');
        $this->load->view('front/commons/footer');
    }

    public function tracking() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/tracking');
        $this->load->view('front/commons/footer');
    }

    public function change_password() {
		 $data['user_data']=$this->getDataByUniqueId();
        $data['login_user_detail'] = $this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/change_password');
        $this->load->view('front/commons/footer');
    }
    
    public function forgot_password()
    {
		$data['user_data']=$this->getDataByUniqueId();
        $data['all_languages'] = $this->ecommerce_model->getLanguage();
        $data['text_langs'] = $this->getLanguage();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/forgot_password');
        $this->load->view('front/commons/footer');
    }

    public function checkEmail($email) {
        $this->ecommerce_model->checkEmail($email);
    }

    public function login() {
        $this->output->set_content_type('application/json');
		$page_url = $this->session->userdata('page_url');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $email = $this->input->post('email');

        $result = $this->ecommerce_model->login();

        if ($result) {
            $this->session->set_userdata('unique_id', $result['unique_id']);
            $this->session->set_userdata('user_name', $result['user_name']);
            $this->session->set_userdata('email', $result['email']);
            $this->session->set_userdata('sourse', 'self');
            $this->output->set_output(json_encode(['result' => 1, 'url' => $page_url]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid User Name And Password']));
            return FALSE;
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('source');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('unique_id');
        redirect(base_url('site'));
    }

    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 10);
        return $unique_id;
    }

    public function registerForm() {
        $this->output->set_content_type('application/json');
        $unique_id = uniqid();
        // $this->form_validation->set_message('is_unique','You have registered with us already');
        $this->form_validation->set_rules('user_name_reg', 'User Name', 'required');
        $this->form_validation->set_rules('email_reg', 'Email', 'required');
        $this->form_validation->set_rules('password_reg', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->registerForm($unique_id);
        if ($result) {
            $this->session->set_userdata('user_name', $result['user_name']);
            $this->session->set_userdata('email', $result['email']);
            $this->session->set_userdata('unique_id', $unique_id);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Registration Done', 'url' => base_url('site')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'You have already created you account!!Please login']));
            return FALSE;
        }
    }

    public function myAccountForm() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('address2', 'Address', 'required');
        $this->form_validation->set_rules('dob', 'DATE OF BIRTH', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $login_user_detail = $this->getDataByUniqueId();
        $result = $this->ecommerce_model->myAccountForm($login_user_detail['id']);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/myaccount'), 'msg' => 'Record Inserted']));
            //redirect(base_url('ecommerce/myaccount'));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('site/myaccount'), 'msg' => 'Record Inserted']));
            return FALSE;
        }
    }

    public function myAccountFormUpdate() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', '');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('address2', 'Address', 'required');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $login_user_detail = $this->getDataByUniqueId();
        $result = $this->ecommerce_model->myAccountFormUpdate($login_user_detail['user_id']);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/myaccount'), 'msg' => 'Record Updated']));
            //redirect(base_url('ecommerce/myaccount'));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('site/myaccount'), 'msg' => 'Record Inserted']));
            return FALSE;
        }
    }

    public function changePassword($id=NULL) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $login_user_detail = $this->getDataByUniqueId();
        $id = $login_user_detail['user_id'];
        $result = $this->ecommerce_model->changePassword($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/change_password'), 'msg' => 'Password Change Successfully']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('site/change_password'), 'msg' => 'Password Not Matched']));
            return FALSE;
        }
    }
    
    public function doSetForgotPassword()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email','Email','required');
        if($this->form_validation->run()===FALSE)
        {
            $this->output->set_output(json_encode(['result'=>0,'errors'=>$this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doSetForgotPassword();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/forgot-Password'), 'msg' => 'Password Change link has been sent in your email id']));
            //$this->resetPasswordLinkMail($result['user_id'],$result['email']);
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('site'), 'msg' => 'This email id does not exist']));
            return FALSE;
        }
    }
    public function resetPasswordLinkMail($user_id,$emai)
    {
        $id=md5($user_id);
        $message = base_url('ecommerce/forgot-Password/?id=').$id;
        $this->email->from('canadianemarket@gmail.com');
        $this->email->to($emai);
        $this->email->subject('Reset Password Link');
        $this->email->message('$message');
        $this->send->email();
    }

    public function doUploadProfileImage() {
        $this->output->set_content_type('application/json');
        $login_user_detail = $this->getDataByUniqueId();
        $user_id = $login_user_detail['user_id'];
        if (!empty($_FILES['file']['name'])) {
            
            $image_name = $this->doUploadImages();
			
         }
        $result = $this->ecommerce_model->doUploadProfileImage($user_id,$image_name);
		
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Image Updated','url'=> base_url('site/myaccount')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Updattion Failed']));
            return FALSE;
        }
    }

    function doUploadImages() {
        $config = array(
            'upload_path' => "./uploads/profile_images/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['file' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function doAddPartnerWithUs() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This User Alredy Registered With Us');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[partner_query.email]');
        $this->form_validation->set_rules('store_name', 'Store Name', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('address2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('country_code', 'Country Code', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone Number', 'required|max_length[10]');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $otp = rand(1000, 9999);
        $country_code = $this->security->xss_clean(explode(',', $this->input->post('country_code')));
        $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
        $country_code = $country_code[0];
        $usermobile = '+' . $country_code . $phone_no;
        $this->load->library('Tw');
        $this->tw->sendSms($usermobile, $otp);
        $result = $this->ecommerce_model->doAddPartnerWithUs($otp);
        if ($result) {
            $this->session->set_userdata('partnerId', $result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Recoed Inserted Successfully']));
           // $this->email($email, 'Canadian e-market admin login password', $Genpassword);

            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Fill All Field', 'url' => base_url('site/partner_with_us')]));
            return FALSE;
        }
    }

    public function doCheckPartnerOtp() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doUpdatePartner(($this->session->userdata('partnerId')));
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/partner-with-us'), 'msg' => 'Registration Successfully!!']));
            $this->session->unset_userdata('partnerId');

            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Enter Valid OTP']));
            return FALSE;
        }
    }

    public function doAddCourier() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This User Alredy Registered With Us');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[courier_query.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|max_length[10]');
        $this->form_validation->set_rules('store_address1', 'Address', 'required');
        $this->form_validation->set_rules('store_address2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
//        $this->form_validation->set_rules('country_code', 'Country Code', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        } 
        $otp = rand(1000, 9999);
        $country_code = $this->security->xss_clean(explode(',', $this->input->post('country_code')));
        $phone_no = $this->security->xss_clean($this->input->post('phone'));
        $country_code = $country_code[0];
        $usermobile = '+' . $country_code . $phone_no;
        $this->load->library('Tw');
        $this->tw->sendSms($usermobile, $otp);
        $result = $this->ecommerce_model->doAddCourier($otp);
        if ($result) {
            $this->session->set_userdata('courierId', $result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Recoed Inserted Successfully']));
            //$this->email($email, 'Canadian e-market admin login password', $Genpassword);
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Fill All Field', 'url' => base_url('site/courier')]));
            return FALSE;
        }
    }

    public function doCheckCourierOtp() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('courireOtp', 'OTP', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doUpdateCourier(($this->session->userdata('courierId')));
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site/courier'), 'msg' => 'Registration Successfully!!']));
            $this->session->unset_userdata('courierId');
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Enter Valid OTP']));
            return FALSE;
        }
    }

    public function sendOTP($phone_no, $otp) {
        
    }

    public function email($to, $subject, $messgage) {
        $this->email->from('canadianemarket@gmail.com');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($messgage);
        $this->email->send();
        return FALSE;
    }

    public function saveUrl() {
        $this->output->set_content_type('application/json');
        $postUrl = $this->input->post('postUrl');

        $this->session->set_userdata('postUrl', $postUrl);
        // echo $this->session->userdata('postUrl'); exit;
        $this->output->set_output(json_encode(['result' => 1, 'url' => $postUrl]));
        return FALSE;
    }

    public function fbLogin() {
        $page_url = $this->session->userdata('page_url');
        if ($this->facebook->is_authenticated()) {
            $userProfile = $this->facebook->request('get', '/me?fields=id,name,email');
//             echo 'hello';
//             print_r($userProfile); die;
            if (!isset($userProfile['error'])) {
                $session_data['email'] = $userProfile['email'];
                $session_data['name'] = $userProfile['name'];
                $session_data['source'] = 'facebook';
                $email = $session_data['email'];
                $name = $session_data['name'];
                $source = 'facebook';
                $this->session->set_userdata('user_email', $email);
                $result = $this->ecommerce_model->checkClient($email, $source);
                if ($result) {
                    $this->session->set_userdata('source', 'facebook');
                    $this->session->set_userdata('user_name', $name);
                    $this->session->set_userdata('email', $email);
                    $this->session->set_userdata('unique_id', $result['unique_id']);
                    redirect($page_url);
                } else {
					$unique_id = $this->uniqueId();
                    $this->ecommerce_model->client_login($session_data, $unique_id);
                    $this->session->set_userdata('source', 'facebook');
                    $this->session->set_userdata('user_name', $name);
                    $this->session->set_userdata('email', $email);
                    $this->session->set_userdata('unique_id', $unique_id);
                    redirect($page_url);
                }
            } else {
                $this->facebook->destroy_session();
                $url = $this->session->userdata('postUrl');
                redirect($url);
                //  redirect('abkasa');
            }
            //redirect(base_url('cart/getCartData'));
        }
    }

    public function oauth2callback() {
        $page_url = $this->session->userdata('page_url');
        $google_data = $this->google->validate();
        // print_r($google_data);die;
        $session_data = array(
            'name' => $google_data['name'],
            'email' => $google_data['email'],
            'source' => 'Google'
        );
        $name = $session_data['name'];
        $email = $session_data['email'];
        $source = 'Google';
        $this->session->set_userdata('user_email', $email);
        $result = $this->ecommerce_model->checkClient($email, $source);
        if ($result) {
            //if ($result['is_verify'] == 0) {
			if ($result) {
                $this->session->set_userdata('source', 'google');
                $this->session->set_userdata('user_name', $name);
                $this->session->set_userdata('email', $email);
                $this->session->set_userdata('unique_id', $result['unique_id']);
                redirect($page_url);
            }
        } else {
			$unique_id = $this->uniqueId();
            $this->ecommerce_model->client_login($session_data, $unique_id);
            $this->session->set_userdata('source', 'google');
            $this->session->set_userdata('user_name', $name);
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('unique_id', $unique_id);
            redirect($page_url);
        }
        //redirect(base_url('cart/getCartData'));
    }
	public function jobEnquiry()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('job_first_name','First Name','required');
        $this->form_validation->set_rules('job_last_name','Last Name','required');
        $this->form_validation->set_rules('job_email','Email','required');
        $this->form_validation->set_rules('job_cover_letter','Cover Letter','required');
        $job_alias =$this->input->post('job_alias');
        if($this->form_validation->run()==FALSE)
        {
            $this->output->set_output(json_encode(['result'=>0,'url'=>  base_url('career-detail/'.$job_alias),'errors'=>$this->form_validation->error_array()]));
            return FALSE;
        }
       
        $job_id = $this->input->post('job_id');
        if (!empty($_FILES['job_file']['name'])) {

            $resume_name = $this->doUploadResume();
        }
        $result = $this->ecommerce_model->jobEnquiry($job_id,$resume_name);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('career-detail/'.$job_alias), 'msg' => 'Enquiry Detail Submitted Successfully']));           
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Enter All Detils Correctly']));
            return FALSE;
        }
        
    }
    
     function doUploadResume() {
        $config = array(
            'upload_path' => "./uploads/job_resume/",
            'allowed_types' => "jpeg|jpg|pdf|doc",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('job_file')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['file' => $this->upload->display_errors()]);
            return 0;
        }
    }
	  //////////career job filter functions
    public function getFilteredJobtype($id)
    {
        $this->output->set_content_type('application/json');
        $data['job_type'] = $this->ecommerce_model->getFilteredJobtype($id);
        $content_wrapper = $this->load->view('front/jobType-wrapper',$data,true);
        $this->output->set_output(json_encode(['result'=>1,'content_wrapper'=>$content_wrapper]));
        return FALSE;
    }
    
    public function getFilteredJobCity($id)
    {
        $this->output->set_content_type('application/json');
        $data['job_locations'] = $this->ecommerce_model->getFilteredJobCity($id);
        $content_wrapper = $this->load->view('front/jobLocation-wrapper',$data,true);
        $this->output->set_output(json_encode(['result'=>1,'content_wrapper'=>$content_wrapper]));
        return FALSE;
    }
    public function getAllFilterId()
    {
        $this->output->set_content_type('application/json');
        $cat_name = $this->input->post('cat');
        $type_name = $this->input->post('type');
        $location_name = $this->input->post('location');
        $cat_id = $this->ecommerce_model->getCategoryIdByName($cat_name);
        $type_id = $this->ecommerce_model->getTypeIdByName($type_name);
        $cat_id = $cat_id['job_category_id'];
        $type_id = $type_id['job_type_id'];
        $data['all_jobs'] = $this->ecommerce_model->getFilteredJobs($cat_id,$type_id,$location_name);
        $content_wrapper = $this->load->view('front/jobListingl-wrapper',$data,true);
        $this->output->set_output(json_encode(['result'=>1,'content_wrapper'=>$content_wrapper]));
        return FALSE;
    }
    public function getFilteredJobs($cat_id,$type_id,$location_name)
    {
        $this->output->set_content_type('application/json');
        $data['all_jobs'] = $this->ecommerce_model->getFilteredJobs($cat_id,$type_id,$location_name);
        $content_wrapper = $this->load->view('front/jobListingl-wrapper',$data,true);
        $this->output->set_output(json_encode(['result'=>1,'content_wrapper'=>$content_wrapper]));
        return FALSE;
    }

}
