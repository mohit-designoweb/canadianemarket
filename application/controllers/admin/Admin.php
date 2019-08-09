<?php

class Admin extends CI_Controller {

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
        if ($this->isLogin()) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = "Admin Login";
        $this->load->view('admin/login', $data);
    }

    public function checkLogin() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->checkLogin('admin');
        if ($result) {
            $this->session->set_userdata('is_admin', $this->input->post('admin'));
            $this->session->set_userdata('email_admin', $result['email']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/dashboard'), 'msg' => 'Loading!! Please Wait']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
            return FALSE;
        }
    }

    public function dashboard() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
		$data['total_user'] = $this->admin_model->countUsersForDashboard();
		$data['total_courier'] = $this->admin_model->countCourierForDashboard();
        $data['total_courier_enquiries'] = $this->admin_model->countCourierEnquiriesForDashboard();
        $data['total_partner_enquiries'] = $this->admin_model->countPartnerEnquiriesForDashboard();
        $data['title'] = 'Dashboard';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/commons/footer');
    }

    public function change_password() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['user'] = $this->getUserData();
        $data['title'] = 'Dashboard';
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['admin']='1';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
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
        $result = $this->admin_model->doChangePassword('admin', $this->isLogin());
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/change-password'), 'msg' => 'Password changes sucessfully.']));
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
        $email = $this->session->userdata('email_admin');
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['title'] = 'User Profile';
        $data['country_code'] = $this->admin_model->getCountryCode();
        $data['user_detail'] = $this->admin_model->getUserDetail('admin', $email);
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/admin-profile', $data);
        $this->load->view('admin/commons/footer');
    }

    public function doUpdateProfile() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $email = $this->session->userdata('email_admin');

        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadProfileImage();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $user = $this->admin_model->getUserDetail('admin', $email);
            $image_url = $user['image_url'];
        }

        $result = $this->admin_model->doUpdateProfile('admin', $email, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/profile'), 'msg' => 'Profile Updated Succesfully!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }
	public function getStoreProductWishlist($product_id){
        
        $query = $this->db->get_where('store_product_wishlist', ['product_id'=>$product_id]);
        return $query->row_array();
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
        $this->session->unset_userdata('email_admin');
        $this->session->unset_userdata('is_admin');
        redirect(base_url('admin'));
    }
	
	public function forgot_password() {
        
        $this->load->view('admin/forgot_password_admin');
    }
	
	public function forgot_password_checked(){
        $this->output->set_content_type('application/json');
        
        $this->form_validation->set_rules('email', 'Register Email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->varify_admin_emailid();
		
        if(!empty($result)){
		
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$activationcode = substr(str_shuffle($str), 0, 10);	
		
        $this->send_forgot_password_link($result,$activationcode);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Link has been sent on your email ', 'url' => base_url('admin/forgot_password')]));
            return FALSE;
        }
        else{
            $this->output->set_output(json_encode(['result' => -1, 'errors' => 'This email id does not exist!']));
            return FALSE;
        }
        
    }//end of function 
	
	public function send_forgot_password_link($result,$activationcode) {
    
	
	$getEmailResponse = $this->admin_model->insert_admin_activationcode($activationcode,$result);
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
	$htmlContent = "<h3>Dear ".$result['first_name'].",</h3>";
	$htmlContent.="<div style='padding-top:8px;'>Please click The following link For Update your password..</div>";
	$htmlContent.= base_url('admin/password-reset/'.$result['admin_id'].'/'.$activationcode)." Click Here!! Set new password!";
	
	$this->email->to($result['email']);
	$this->email->from('canadianemarket@gmail.com','MyWebsite');
	$this->email->subject('Hey!, '.$result['first_name']." ".$result['last_name'].' your reset password link');
	$this->email->message($htmlContent);

	//Send email
	$this->email->send();
		
		return true;
		}
		
	public function password_reset($admin_id,$activationcode){
		$data['admin_id'] = $admin_id;
		$checkResponse = $this->admin_model->update_admin_email_status($admin_id,$activationcode);
		
		if($checkResponse){
			$this->load->view('admin/admin_reset_password',$data);
			
		}else{
			echo "This is the Wrong or Expire Activation Code";
		}
		
	
	}

	public function update_forgot_password(){
        $this->output->set_content_type('application/json');
        
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doChangeForgotPasswordAdmin();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin'), 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
        
    }
  ///////restaurant Order functions
    public function restaurant_orders()
    {
        $data['title'] = 'Admin Restaurant Orders';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/admin-restaurant-order-management/view-order');
        $this->load->view('admin/commons/footer');
    }
    
     public function get_admin_restaurant_order_wrapper() {
        $this->output->set_content_type('application/json');
        $partner = $this->getUserData();
        $data['orders'] = $this->admin_model->getRestaurantOrderData();
        $content_wrapper = $this->load->view('admin/admin-restaurant-order-management/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
     public function viewOrderDetail($id,$restaurant_id=NULL) {
        if(!empty($restaurant_id))
        {
        $restaurant_detail = $this->admin_model->getRestaurantDetailById($restaurant_id);
        $this->session->set_userdata('restaurant_id',$restaurant_detail['restaurant_id']);
        $this->session->set_userdata('restaurant_latitude',$restaurant_detail['latitude']);
        $this->session->set_userdata('restaurant_longitude',$restaurant_detail['longitude']);
        }
        $data['order_detail1'] = $this->admin_model->getOrderDetailById($id);
        $data['user_info'] = $this->admin_model->getUserDetailById($data['order_detail1']['user_id']);
        $data['menu'] = $this->admin_model->getMenuDetailById($data['order_detail1']['menu_id']);
       // $data['courier'] = $this->admin_model->getCourierDetailById($data['order_detail1']['courier_id']);
        $data['order_detail'] = $this->admin_model->getOrderDetailByUniqueId($data['order_detail1']['unique_order_id']);
        //if($data['order_detail1']['courier_id']!="")
        //{
          //  $data['courierDetail'] = $this->admin_model->getCourierDetailById($data['order_detail1']['courier_id']);
        //}
        //$data['couriers'] = $this->getAllActiveCourier();
        $data['detail'] = $this->session->userdata('order_Detail');
        $data['user'] = $this->getUserData();
        $data['title'] = 'Restaurant Orders';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/admin-restaurant-order-management/add-order');
        $this->load->view('admin/commons/footer');
    }
	//////Store Order Function
	 public function store_orders()
    {
        $data['title'] = 'Admin Store Orders';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/admin-store-order-management/view-order');
        $this->load->view('admin/commons/footer');
    }
	 public function get_admin_store_order_wrapper() {
        $this->output->set_content_type('application/json');
        $partner = $this->getUserData();
        $data['orders'] = $this->admin_model->getStoreOrderData();
        $content_wrapper = $this->load->view('admin/admin-store-order-management/order-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
	public function viewStoreOrderDetail($order_unique_id)
	{
		$results = $this->admin_model->getStoreOrderDetailByUniqueId($order_unique_id);
		//echo "<pre>";
		//print_r($results);
		//echo "<pre>"; die;
		$list = [];
		$i=0;
		foreach($results as $result)
		{
			$product_id = $result['product_id'];
			$product_detail = $this->admin_model->getProductDetailById($product_id);
			$list[$i]['product_name'] = $product_detail['product_name'];
			$list[$i]['image_url'] = $product_detail['image_url'];
			$list[$i]['sku'] = $result['product_sku'];
			$list[$i]['price'] = $result['price'];
			$list[$i]['qty'] = $result['qty'];
			$i++;
		}
		$data['user'] = $this->getUserData();
        $data['title'] = 'Store Orders';
		$data['order_details'] = $list;
		$data['price_detail'] = $this->admin_model->getPriceDetailByUniqueId($order_unique_id);
		$data['user_info'] = $this->admin_model->getUserDetailById($data['price_detail']['user_id']);
		
		//echo "<pre>";
		//print_r($list);
		//echo "<pre>"; die;
		$this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/admin-store-order-management/add-order');
        $this->load->view('admin/commons/footer');
	}	

}
