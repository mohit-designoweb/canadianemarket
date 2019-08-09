<?php
/**
 * Description of User 
 *
 * @author Mukesh Yadav
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ecommerce_model');
        $this->load->config('facebook');
    }
    
    public function index(){
        redirect('user/my-account');
    }
    
    public function getFilterCountry(){
        $countries=$this->ecommerce_model->getCountry();
        $list=[''=>'Select Country'];
        foreach($countries as $country){
            $list[$country['country_id']]=$country['country_name'];
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
    
	public function getCities() {
        if (!empty($this->input->cookie('country_id', true))) {
            $country_id = $this->input->cookie('country_id', true);
            $cities = $this->ecommerce_model->getCityByCountry($country_id);
            return $cities;
        } else {
            return null;
        }
    }
	
    public function login() {
        $this->output->set_content_type('application/json');
        $page_url = $this->session->userdata('page_url');
        $this->form_validation->set_rules('email_id', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->login();
        if (!empty($result)) {
            $this->session->set_userdata('unique_id', $result['unique_id']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => $page_url]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid User Name And Password']));
            return FALSE;
        }
    }
    
    public function fbLogin() {
        $page_url = $this->session->userdata('page_url');
        if ($this->facebook->is_authenticated()) {
            $userProfile = $this->facebook->request('get', '/me?fields=id,name,email');
            if (!isset($userProfile['error'])) {
                $session_data['email'] = $userProfile['email'];
                $session_data['name'] = $userProfile['name'];
                $session_data['source'] = 'facebook';
                $email = $session_data['email'];
                $name = $session_data['name'];
                $source = 'facebook';
                $result = $this->ecommerce_model->checkClient($email, $source);
                if ($result) {
                    $this->session->set_userdata('unique_id', $result['unique_id']);
                    redirect($page_url);
                } else {
                    $unique_id = $this->uniqueId();
                    $this->ecommerce_model->client_login($session_data, $unique_id);
                    $this->session->set_userdata('unique_id', $unique_id);
                    redirect($page_url);
                }
            } else {
                $this->facebook->destroy_session();
                $url = $this->session->userdata('postUrl');
                redirect(base_url('site'));
            }
        }
    }

    public function oauth2callback() {

        $page_url = $this->session->userdata('page_url');
        $google_data = $this->google->validate();
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
            $this->session->set_userdata('unique_id', $result['unique_id']); 
            redirect($page_url);
        } else {
            $unique_id = $this->uniqueId();
            $this->ecommerce_model->client_login($session_data, $unique_id);
            $this->session->set_userdata('unique_id', $unique_id);
            redirect($page_url);
        }
    }
    
    public function logout() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('source');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('unique_id');
        
        $this->session->unset_userdata('coupon');
        $this->session->unset_userdata('check');
        $this->session->unset_userdata('delivery_type');
        $this->session->unset_userdata('payment_data');
        $this->session->unset_userdata('restaurant_cart');
        $this->cart->destroy();
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
        $page_url = $this->session->userdata('page_url');
        $unique_id = $this->uniqueId();
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
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Registration Done', 'url' => $page_url]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'You have already created you account or Please fill correct referance code!', 'id' => 'error_msg']));
            return FALSE;
        }
    }

    public function myAccountForm() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        //$this->form_validation->set_rules('address1', 'Address', 'required');
        //$this->form_validation->set_rules('address2', 'Address', 'required');
		$this->form_validation->set_rules('address_id','Address','required');
		
        $this->form_validation->set_rules('dob', 'DATE OF BIRTH', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $login_user_detail = $this->getDataByUniqueId();
        $result = $this->ecommerce_model->myAccountForm($login_user_detail['id']);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('user/my-account'), 'msg' => 'Record Inserted']));
            //redirect(base_url('ecommerce/myaccount'));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('user/my-account'), 'msg' => 'Record Inserted']));
            return FALSE;
        }
    }
    
    public function myaccount() {
        if (empty($this->session->userdata('unique_id'))) {
            redirect(base_url('site'));
        }
		$data['title'] = 'Profile';
        $data['webcam']='1';
		$data['countries'] = $this->getFilterCountry();
        $data['user_data'] = $this->getDataByUniqueId();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/myaccount');
        $this->load->view('front/commons/footer');
    }
    public function getUserAddress()
	{
		$list = [];
		$i = 0;
		$list = [''=>'----SELECT ADDRESS----'];
		$user_data = $this->getDataByUniqueId();
		$addresses = $this->ecommerce_model->getUserAddress($user_data['user_id']);
		foreach($addresses as $address)
		{
			$list[$address['address_id']] = $address['address'];
		}
		return $list;
	}
    public function my_account_wrapper(){
        $this->output->set_content_type('application/json');
		$data['user_address'] = $this->getUserAddress();
        $data['user_data'] = $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/my-account-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
//    public function accountupload() {
//        if (empty($this->session->userdata('unique_id'))) {
//            redirect(base_url('site'));
//        }
//        $data['user_data'] = $this->getDataByUniqueId();
//        $this->load->view('front/commons/header', $data);
//        $this->load->view('front/accountupload');
//        $this->load->view('front/commons/footer');
//    }
    
    public function profile_upload_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/profile-upload-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function doUploadProfileImage() {
        $this->output->set_content_type('application/json');
        $login_user_detail = $this->getDataByUniqueId();
        $user_id = $login_user_detail['user_id'];
        if (!empty($_FILES['image_url']['name'])) {
            $image_name = $this->doUploadImages();
        }
        $result = $this->ecommerce_model->doUploadProfileImage($user_id, $image_name);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Image Updated', 'url' => base_url('user/my-account')]));
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
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['file' => $this->upload->display_errors()]);
            return 0;
        }
    }
    
    public function order_history() {
        if (empty($this->session->userdata('unique_id'))) {
            redirect(base_url('site'));
        }
        $data['user_data'] = $this->getDataByUniqueId();
	    $data['countries'] = $this->getFilterCountry();
        $this->load->view('front/commons/header', $data);
        $this->load->view('front/order-history');
        $this->load->view('front/commons/footer');
    }
    
    public function order_history_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/order-history-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }    

    public function market_credit_point_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/credit-point-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
	public function auto_re_order_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $complete_store_orders = $this->ecommerce_model->get_store_complete_order($user_data['user_id']);
        $data['complete_store_orders'] = $this->getActiveStoreDetails($complete_store_orders);
        $complete_restaurant_orders = $this->ecommerce_model->get_restaurant_complete_order_byuser($user_data['user_id']);
        $data['complete_restaurant_orders'] = $this->getActiveRestaurantDetails($complete_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/auto-re-order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	
    public function myAccountFormUpdate() {
        if (empty($this->session->userdata('unique_id'))) {
            redirect(base_url('site'));
        }
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', '');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
       // $this->form_validation->set_rules('address1', 'Address', 'required');
        //$this->form_validation->set_rules('address2', 'Address', 'required');
		$this->form_validation->set_rules('address_id','Address','required');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $login_user_detail = $this->getDataByUniqueId();
        $result = $this->ecommerce_model->myAccountFormUpdate($login_user_detail['user_id']);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('user/my-account'), 'msg' => 'Record Updated']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('user/my-account'), 'msg' => 'No chnages made!']));
            return FALSE;
        }
    }
    
    public function change_password_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/chnage-password-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
	public function wishlist_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $data['resturant_wishlists'] = $this->ecommerce_model->getRestaurantWishlistByUserId($user_data['user_id']); 
        $data['storeproduct_wishlists'] = $this->ecommerce_model->getStoreProductWishlistByUserId($user_data['user_id']);
        $content_wrapper = $this->load->view('front/includes/wishlist-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function removeRestaurantItemFromWishlist($restaurant_wishlist_id)
    {
        $this->output->set_content_type('application/json');
        $this->ecommerce_model->removeRestaurantItemFromWishlist($restaurant_wishlist_id);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    public function removeStoreItemFromWishlist($store_wishlist_id)
    {
        $this->output->set_content_type('application/json');
        $this->ecommerce_model->removeStoreItemFromWishlist($store_wishlist_id);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
	
    public function changePassword($id = NULL) {
        
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
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('user/my-account'), 'msg' => 'Password Change Successfully']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('user/my-account'), 'msg' => 'Password Not Matched']));
            return FALSE;
        }
    }
    
    public function forgot_password() {
        $this->output->set_content_type('application/json');
        $page_url = $this->session->userdata('page_url');
        $this->form_validation->set_rules('regiter_email', 'Register Email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->varify_emailid();
		
		
         if(!empty($result)){
		
			$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$activationcode = substr(str_shuffle($str), 0, 10);	
            
            $this->send_forgot_password_link($result,$activationcode);
            $this->output->set_output(json_encode(['result' => 1,  'msg' => 'Password Change link has been sent in your email id']));
            return FALSE;
        }
        else{
            $this->output->set_output(json_encode(['result' => -1, 'errors' => 'This email id does not exist!']));
            return FALSE;
        }
    }
    
    public function send_forgot_password_link($result,$activationcode) {
        //$this->load->library('email');
       $getEmailResponse = $this->ecommerce_model->insert_user_activationcode($activationcode,$result);
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
	$htmlContent = "<h3>Dear ".$result['user_name'].",</h3>";
	$htmlContent.="<div style='padding-top:8px;'>Please click The following link For Update your password..</div>";
	$htmlContent.= base_url('user/password-reset/'.$result['user_id'].'/'.$activationcode)." Click Here!! Set new password!";
	
	$this->email->to($result['email']);
	$this->email->from('canadianemarket@gmail.com','MyWebsite');
	$this->email->subject('Hey!, '.$result['user_name']." ".$result['last_name'].' your reset password link');
	$this->email->message($htmlContent);

	//Send email
	$this->email->send();
		
		return true;
    }
	
	public function password_reset($user_id,$activationcode){
        
		$checkResponse = $this->ecommerce_model->update_user_email_status($user_id,$activationcode);
		
		if($checkResponse){
		$data['user_id'] = $user_id;
		
		$data['user_data'] = $this->getDataByUniqueId();
        $data['title'] = 'Terms and condition'; 
        $data['content'] = $this->ecommerce_model->getTermsPageContent();
        $data['countries'] = $this->getFilterCountry();
        $this->load->view('front/commons/header',$data);
        $this->load->view('front/commons/user_reset_password',$data);
        $this->load->view('front/commons/footer');
			
		}else{
			echo "This is the Wrong or Expire Activation Code";
		}
	
        
    }
	
	public function update_forgot_password(){
        $this->output->set_content_type('application/json');
        
        $this->form_validation->set_rules('password', 'New Password', 'required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doChangeForgotPasswordUser();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
        
    }
	
	
    
    public function password_reset_link($user_id){
        echo "reset password here";
    }
    
    public function do_reset_password() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'cpassword', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->do_reset_password();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('site'), 'msg' => 'Password Change link has been sent in your email id']));
            //$this->resetPasswordLinkMail($result['user_id'],$result['email']);
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url' => base_url('site'), 'msg' => 'This email id does not exist']));
            return FALSE;
        }
    }
	
	    
    public function getActiveStoreDetails($active_store_orders){     
        $list=[];
        $i=0;
        foreach($active_store_orders as $order){
            $list[$i]['order_unique_id']=$order['order_unique_id'];
            $list[$i]['order_date']=$order['order_date'];
            $list[$i]['status']=$order['status'];
            $list[$i]['total_amount']=$order['total_amount'];
            $ordered_products = $this->ecommerce_model->getStoreOrderedProductByOrderUniqueId($order['order_unique_id']);
//            print_r($ordered_products);exit;
            $j=0;
            foreach($ordered_products as $ordered_product){
                $list[$i]['ordered_product'][$j]['product_id'] = $ordered_product['product_id'];
                $list[$i]['ordered_product'][$j]['product_name'] = $ordered_product['product_name'];
                $list[$i]['ordered_product'][$j]['price'] = $ordered_product['price'];
                $list[$i]['ordered_product'][$j]['image_url'] = $ordered_product['image_url'];
                $list[$i]['ordered_product'][$j]['store_name'] = $ordered_product['store_name'];
                $product_skudata = $this->ecommerce_model->getProductskuDataByProductskuId($ordered_product['product_sku']);
                $product_sku_mappings = $this->ecommerce_model->getProductskuMappingDataByProductskuId($product_skudata['product_sku_id']);
                $k = 0;
                foreach($product_sku_mappings as $product_sku_mapping){
                    $list[$i]['ordered_product'][$j]['ordered_product_sku'][$k]['group_name'] = $product_sku_mapping['group_name'];
                    $list[$i]['ordered_product'][$j]['ordered_product_sku'][$k]['group_value'] = $product_sku_mapping['group_value'];
                    $k++;
                }
                $j++;
            }
        }
//        print_r($list);
        return $list;
    }
    
    public function getActiveRestaurantDetails($active_restaurant_orders){
        $list=[];
        $i=0;
        foreach($active_restaurant_orders as $active_restaurant_order){
            $list[$i]['restaurant_id']=$active_restaurant_order['restaurant_id'];
            $list[$i]['unique_order_id']=$active_restaurant_order['unique_order_id'];
            $list[$i]['total_amount']=$active_restaurant_order['total_amount'];
            $list[$i]['order_status']=$active_restaurant_order['order_status'];
            $list[$i]['order_date']=$active_restaurant_order['order_date'];
            $restaurantdata = $this->ecommerce_model->getRestaurantOrderedProductByOrderUniqueId($active_restaurant_order['restaurant_id']);
            $list[$i]['restaurant_name']=$restaurantdata['restaurant_name'];
            $menu_ids  = explode(",", $active_restaurant_order['menu_id']);
            $j = 0;
            foreach($menu_ids as $menu_id){
                
                $restaurant_menudata = $this->ecommerce_model->getRestaurantOrderedMenuByMenuId($menu_id);
                $list[$i]['restaurant_menudetail'][$j]['menu_id']=$restaurant_menudata['menu_id'];
                $list[$i]['restaurant_menudetail'][$j]['menu_name']=$restaurant_menudata['menu_name'];
                $list[$i]['restaurant_menudetail'][$j]['image_url']=$restaurant_menudata['image_url'];
                $list[$i]['restaurant_menudetail'][$j]['price']=$restaurant_menudata['price'];
                $j++;
            }
            $i++;
        }
//        print_r($list);
        return $list;
    }
    
    public function active_order_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $active_store_orders= $this->ecommerce_model->getactive_store_active_order($user_data['user_id']);
        $data['active_store_orders'] = $this->getActiveStoreDetails($active_store_orders);
        $active_restaurant_orders= $this->ecommerce_model->getactive_restaurant_active_order($user_data['user_id']);
        $data['active_restaurant_orders'] = $this->getActiveRestaurantDetails($active_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/active-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function complete_order_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $complete_store_orders = $this->ecommerce_model->get_store_complete_order($user_data['user_id']);
        $data['complete_store_orders'] = $this->getActiveStoreDetails($complete_store_orders);
        $complete_restaurant_orders = $this->ecommerce_model->get_restaurant_complete_order_byuser($user_data['user_id']);
        $data['complete_restaurant_orders'] = $this->getActiveRestaurantDetails($complete_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/complete-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function cancel_order_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $cancel_store_orders = $this->ecommerce_model->get_store_cancel_order($user_data['user_id']);
        $data['cancelled_store_orders'] = $this->getActiveStoreDetails($cancel_store_orders);
        $cancel_restaurant_orders = $this->ecommerce_model->get_restaurant_cancel_order_byuser($user_data['user_id']);
        $data['cancelled_restaurant_orders'] = $this->getActiveRestaurantDetails($cancel_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/cancel-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function return_order_wrapper(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $return_store_orders = $this->ecommerce_model->get_store_return_order($user_data['user_id']);
        $data['return_store_orders'] = $this->getActiveStoreDetails($return_store_orders);
        $return_restaurant_orders = $this->ecommerce_model->get_restaurant_return_order_byuser($user_data['user_id']);
        $data['return_restaurant_orders'] = $this->getActiveRestaurantDetails($return_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/return-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function store_order_cancel($order_unique_id){
        $this->output->set_content_type('application/json');
        $result = $this->ecommerce_model->store_order_cancel($order_unique_id);
        if(!empty($result)){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Your Order Successfully Cancelled!']));
            return FALSE;
        }
    }
    
    public function received_gift_card(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $complete_store_orders = $this->ecommerce_model->get_store_complete_order($user_data['user_id']);
        $data['complete_store_orders'] = $this->getActiveStoreDetails($complete_store_orders);
        $complete_restaurant_orders = $this->ecommerce_model->get_restaurant_complete_order_byuser($user_data['user_id']);
        $data['complete_restaurant_orders'] = $this->getActiveRestaurantDetails($complete_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/complete-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function send_gift_card(){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $complete_store_orders = $this->ecommerce_model->get_store_complete_order($user_data['user_id']);
        $data['complete_store_orders'] = $this->getActiveStoreDetails($complete_store_orders);
        $complete_restaurant_orders = $this->ecommerce_model->get_restaurant_complete_order_byuser($user_data['user_id']);
        $data['complete_restaurant_orders'] = $this->getActiveRestaurantDetails($complete_restaurant_orders);
        $content_wrapper = $this->load->view('front/includes/complete-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function restaurant_order_cancel($order_unique_id){
        $this->output->set_content_type('application/json');
        $result = $this->ecommerce_model->restaurant_order_cancel($order_unique_id);
        if(!empty($result)){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Your Order Successfully Cancelled!']));
            return FALSE;
        }
    }
     
    public function doAddRateReview($product_id){
        $this->output->set_content_type('application/json');
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $this->form_validation->set_rules('review', 'Review', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->doAddRateReview($user_data['user_id'],$product_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url'=>base_url('user/my-account'), 'msg' => 'Thanks for the review']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url'=>base_url('user/my-account'), 'msg' => 'Review did not added sucessfully']));
            return FALSE;
        }
    }
    
    public function doAddReview($restaurant_id){
        $this->output->set_content_type('application/json');
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
//        $this->form_validation->set_rules('review', 'Review', 'required');
//        if ($this->form_validation->run() === FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
//            return FALSE;
//        }
        $result = $this->ecommerce_model->doAddReview($user_data['user_id'], $restaurant_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url'=>base_url('user/my-account'), 'msg' => 'Thanks for the review']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1,  'url'=>base_url('user/my-account'),'msg' => 'Review did not added sucessfully']));
            return FALSE;
        }
    }
    
    public function rateReview($id){
        $this->output->set_content_type('application/json');
        $data['product_id'] = $id;
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/reviewForm', $data, true);
        $this->output->set_output(json_encode(['content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function restaurantReview($id){
        $this->output->set_content_type('application/json');
        $data['restaurant_id'] = $id;
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/restaurant_review', $data, true);
        $this->output->set_output(json_encode(['content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	
	public function product_reorder($id){
        $this->output->set_content_type('application/json');
        $data['product_orderid'] = $id;
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/product_reorder', $data, true);
        $this->output->set_output(json_encode(['content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function restaurant_reorder($id){
        $this->output->set_content_type('application/json');
        $data['restaurant_orderid'] = $id;
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/restaurant_reorder', $data, true);
        $this->output->set_output(json_encode(['content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	
	public function do_product_reorder($product_uniqueid){
        $this->output->set_content_type('application/json');
        $user_data= $this->getDataByUniqueId();
        $this->form_validation->set_rules('product_reorder_date', 'Reorder Date', 'required');
        $this->form_validation->set_rules('product_reorder_time', 'Reorder Time', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->do_product_reorder($user_data['user_id'],$product_uniqueid);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url'=>base_url('user/my-account'), 'msg' => 'Thanks for Reorder Product']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url'=>base_url('user/my-account'), 'msg' => 'Re-order did not added sucessfully']));
            return FALSE;
        }
    }
    
    public function do_restaurant_reorder($restaurant_uniqueid){
        $this->output->set_content_type('application/json');
        $user_data= $this->getDataByUniqueId();
        $this->form_validation->set_rules('restaurant_reorder_date', 'Reorder Date', 'required');
        $this->form_validation->set_rules('restaurant_reorder_time', 'Reorder Time', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->ecommerce_model->do_restaurant_reorder($user_data['user_id'],$restaurant_uniqueid);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url'=>base_url('user/my-account'), 'msg' => 'Thanks for Reorder Menu']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'url'=>base_url('user/my-account'), 'msg' => 'Re-order did not added sucessfully']));
            return FALSE;
        }
    }
    public function storeReview($id){
        $this->output->set_content_type('application/json');
        $data['store_id'] = $id;
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $content_wrapper = $this->load->view('front/includes/store_review', $data, true);
        $this->output->set_output(json_encode(['content_wrapper' => $content_wrapper]));
        return FALSE;
    }
     public function doAddStroeReview($store_id){
        $this->output->set_content_type('application/json');
        $data['user_data'] =$user_data= $this->getDataByUniqueId();
        $result = $this->ecommerce_model->doAddStoreReview($user_data['user_id'], $store_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url'=>base_url('store'), 'msg' => 'Thanks for the review']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1,  'url'=>base_url('store'),'msg' => 'Review did not added sucessfully']));
            return FALSE;
			
        }
    }
	
	public function return_order($item_id,$user_id){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $orderId= $this->ecommerce_model->get_unique_order_id_byproductid($item_id);
        $is_return=$this->ecommerce_model->update_store_status($user_id,$orderId['order_unique_id']); 
        
        //$content_wrapper = $this->load->view('front/includes/return-orders', $data, true);
        $this->output->set_output(json_encode(['result' => 1,'msg' => 'Item return successfull.. ','url'=>  base_url('user/my-account')]));
        return FALSE;
        
    }
    
    public function return_order_restaurant($restaurant_id,$user_id){
        $this->output->set_content_type('application/json');
        $data['user_data'] = $user_data = $this->getDataByUniqueId();
        $is_return = $this->ecommerce_model->update_restaurant_status($restaurant_id,$user_id);
        $this->output->set_output(json_encode(['result' => 1,'msg' => 'Item return successfull.. ','url'=>  base_url('user/my-account')]));
        return FALSE;
    }
}