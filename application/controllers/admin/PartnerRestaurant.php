<?php

/**
 * Description of PartnerRestaurant
 *
 * @author Mohit Kant Gupta
 */
class PartnerRestaurant extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'partner_model','restaurant_model']);
        if (empty($this->session->userdata('email_partner'))) {
            redirect(base_url('partner'));
        }
        $this->is_partner = $this->session->userdata('is_partner');
    }

    public function getUserData() {
        $email = $this->session->userdata('email_partner');
        return $this->admin_model->getUserdata($this->is_partner, $email);
    }
    
    private function filteredPartner() {
        $list = ['' => 'Select the Partner'];
        $partners = $this->partner_model->getActivePartner();
        foreach ($partners as $partner) {
            $list[$partner['partner_id']] = $partner['first_name'] . ' ' . $partner['last_name'];
        }
        return $list;
    }

    private function getFilteredCategories() {
        $list = ['' => '--Select The Category--'];
        $categories = $this->partner_model->getAllActiveCategory();
        foreach ($categories as $category) {
            $list[$category['restaurant_category_id']] = $category['category_name'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['is_admin']=$this->session->userdata('is_admin');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-restaurant/view-restaurant');
        $this->load->view('admin/commons/footer');
    }

    public function get_partner_restaurant_wrapper() {
        $this->output->set_content_type('application/json');
        $email = $this->session->userdata('email_partner');
        $result = $this->partner_model->getPartnerId($email);
        $partner_id = $result['partner_id'];
        $data['restaurants'] = $this->partner_model->getRestaurantByPartnerId($partner_id);
        
        $content_wrapper = $this->load->view('admin/partner-restaurant/restaurant-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addPartnerRestaurant($id) {
        $data['restaurant'] = $this->partner_model->getRestaurantById($id);
        $data['map'] = '1';
        $data['user'] = $this->getUserData();
        $data['title'] = 'Restaurant';
        $data['partners'] = $this->filteredPartner();
        $data['category'] = $this->getFilteredCategories();
       // $data['user_type'] = $this->user_type;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-restaurant/add-restaurant');
        $this->load->view('admin/commons/footer');
    }

    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/restaurant",
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

    public function doAddRestaurant() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('restaurant_category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        $this->form_validation->set_rules('restaurant_name', 'Restaurant Name', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('about', 'About', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('speciality', 'Speciality', 'required');
        $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required');
        $this->form_validation->set_rules('opening_time_from', 'Opening Time', 'required');
        $this->form_validation->set_rules('opening_time_to', 'Closing Time', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
		$this->form_validation->set_rules('service_fee','Service Fee','numeric');
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
        $result = $this->partner_model->doAddRestaurant($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/restaurant')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditPartnerRestaurant($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('restaurant_name', 'Restaurant Name', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('about', 'About', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('speciality', 'Speciality', 'required');
        $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required');
        $this->form_validation->set_rules('opening_time_from', 'Opening Time', 'required');
        $this->form_validation->set_rules('opening_time_to', 'Closing Time', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
		$this->form_validation->set_rules('service_fee','Service Fee','numeric');
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
            $store = $this->partner_model->getRestaurantById($id);
            $image_url = $store['image_url'];
        }
        $result = $this->partner_model->doEditPartnerRestaurant($id, $image_url);
        if ($result) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('partner/partnerRestaurant')]));
                 return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }

    public function changePartnerRestaurantStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->partner_model->changePartnerRestaurantStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    //Restaurant Menu Category

    public function partner_restaurant_menu_category($restaurant_id, $menu_category_id = null) {
        if (!empty($menu_category_id)) {
            
            $data['men'] = $this->partner_model->getRestaurantMenuCategoryById($menu_category_id);
//            print_r($data); die;
        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
//        $data['user_type'] = $this->user_type;
        $data['restaurant_id'] = $restaurant_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-restaurant-menu-category/category');
        $this->load->view('admin/commons/footer');
    }

    public function get_partner_restaurant_menu_category_wrapper($restaurant_id) {
        $this->output->set_content_type('application/json');
//        $data['user_type'] = $this->user_type;
        $restaurants=$this->partner_model->getRestaurantById($restaurant_id);
        $data['name'] = $restaurants['restaurant_name'];
        $data['menus'] = $this->partner_model->getRestaurantCategoryMenuByRestaurantId($restaurant_id);
        $content_wrapper = $this->load->view('admin/partner-restaurant-menu-category/category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddPartnerRestaurantMenuCategory($restaurant_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_category_name', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->partner_model->doAddPartnerRestaurantMenuCategory($restaurant_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('partner/partner-restaurant-menu-category/' . $restaurant_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditPartnerRestaurantMenuCategory($restaurant_id, $menu_category_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_category_name', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->partner_model->doEditPartnerRestaurantMenuCategory($menu_category_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Updated Sucessfully', 'url' => base_url('partner/partner-restaurant-menu-category/' . $restaurant_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant category not updated.', 'url' => base_url('admin/restaurant-menu-category/' . $restaurant_id)]));
            return FALSE;
        }
    }

    public function changePartnerRestaurantMenuCategoryStatus($menu_category_id, $status) {
        $this->output->set_content_type('application/json');
        $this->partner_model->changeRestaurantMenuCategoryStatus($menu_category_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    public function partner_restaurant_menu($restaurant_id, $menu_category_id) {
//        if (empty($this->isLogin())) {
//            redirect(base_url('admin'));
//        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $data['menu_category_id'] = $menu_category_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-restaurant-menu/view-restaurant-menu');
        $this->load->view('admin/commons/footer');
    }
    
    public function get_partner_restaurant_menu_wrapper($restaurant_id,$menu_category_id){
        $this->output->set_content_type('application/json');
        $data['restaurant_id']=$restaurant_id;
        $data['menu_category_id']=$menu_category_id;
        $data['menus'] = $this->partner_model->getRestaurantMenu($restaurant_id,$menu_category_id);
        $content_wrapper = $this->load->view('admin/partner-restaurant-menu/restaurent-menu-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function add_partner_restaurant_menu($restaurant_id,$menu_category_id,$menu_id=null){
//        if (empty($this->isLogin())) {
//            redirect(base_url('admin'));
//        }
        if(!empty($menu_id)){
            $data['menu']= $this->partner_model->getRestaurantMenuById($menu_id);
        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $data['menu_category_id'] = $menu_category_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/partner-sidebar', $data);
        $this->load->view('admin/partner-restaurant-menu/add-restaurant-menu');
        $this->load->view('admin/commons/footer');
    }
    
    public function doUploadImgMenu() {
        $config = array(
            'upload_path' => "./uploads/menu",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048"
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
    
    public function doAddPartnerRestaurantMenu($restaurant_id,$menu_category_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('emarket_point','Emarket Point','numeric');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image_url = $this->doUploadImgMenu();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $result = $this->partner_model->doAddRestaurantMenu($restaurant_id,$menu_category_id,$image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('partner/partner-restaurant-menu/'.$restaurant_id.'/'.$menu_category_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditPartnerRestaurantMenu($restaurant_id,$menu_category_id,$menu_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('emarket_point','Emarket Point','numeric');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadImgMenu();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $store = $this->partner_model->getRestaurantMenuById($menu_id);
            $image_url = $store['image_url'];
        }
        $result = $this->partner_model->doEditPartnerRestaurantMenu($menu_id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('partner/partner-restaurant-menu/'.$restaurant_id.'/'.$menu_category_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }
    
    public function changePartnerRestaurantMenuStatus($menu_id,$status){
        $this->output->set_content_type('application/json');
        $this->partner_model->changeRestaurantMenuStatus($menu_id,$status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
