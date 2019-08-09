<?php

/**
 * Description of Restaurant
 *
 * @author Mohit Kant Gupta
 */
class AdminRestaurant extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'restaurant_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    private function filteredPartner() {
        $list = ['' => 'Select the Partner'];
        $partners = $this->restaurant_model->getActivePartner();
        foreach ($partners as $partner) {
            $list[$partner['partner_id']] = $partner['first_name'] . ' ' . $partner['last_name'];
        }
        return $list;
    }

    private function getFilteredCategories() {
        $list = ['' => '--Select The Category--'];
        $categories = $this->restaurant_model->getAllActiveCategory();
        foreach ($categories as $category) {
            $list[$category['restaurant_category_id']] = $category['category_name'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant/view-restaurant');
        $this->load->view('admin/commons/footer');
    }

    public function get_restaurant_wrapper() {
        $this->output->set_content_type('application/json');
        $data['restaurants'] = $this->restaurant_model->getAllRestaurant();
        $content_wrapper = $this->load->view('admin/restaurant/restaurant-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addRestaurant($id = null) {
        if (!empty($id)) {
            $data['restaurant'] = $this->restaurant_model->getRestaurantById($id);
        }
        $data['map'] = '1';
        $data['user'] = $this->getUserData();
        $data['title'] = 'Restaurant';
        $data['partners'] = $this->filteredPartner();
        $data['category'] = $this->getFilteredCategories();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant/add-restaurant');
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
		$this->form_validation->set_rules('is_unique','This Name restaurant already entered');
        $this->form_validation->set_rules('restaurant_category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        $this->form_validation->set_rules('restaurant_name', 'Restaurant Name', 'required|is_unique[restaurant.restaurant_name]');
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
        $result = $this->restaurant_model->doAddRestaurant($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/adminRestaurant')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditRestaurant($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('restaurant_category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        //$this->form_validation->set_rules('restaurant_name', 'Restaurant Name', 'required');
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
            $store = $this->restaurant_model->getRestaurantById($id);
            $image_url = $store['image_url'];
        }
        $result = $this->restaurant_model->doEditRestaurant($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('admin/adminRestaurant')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }

    public function changeAdminRestaurantStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->restaurant_model->changeRestaurantStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
	public function changeAdminRestaurantStatusOpenOrClose($id, $status) {
        $this->output->set_content_type('application/json');
        $this->restaurant_model->changeAdminRestaurantStatusOpenOrClose($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    //Restaurant Menu Category

    public function restaurant_menu_category($restaurant_id, $menu_category_id = null) {
        if (!empty($menu_category_id)) {
            $data['men'] = $this->restaurant_model->getRestaurantMenuCategoryById($menu_category_id);
        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-menu-category/category');
        $this->load->view('admin/commons/footer');
    }

    public function get_restaurant_menu_category_wrapper($restaurant_id) {
        $this->output->set_content_type('application/json');
        $data['menus'] = $this->restaurant_model->getRestaurantCategoryMenuByRestaurantId($restaurant_id);
        $content_wrapper = $this->load->view('admin/restaurant-menu-category/category-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddRestaurantMenuCategory($restaurant_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_category_name', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->restaurant_model->doAddRestaurantMenuCategory($restaurant_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/restaurant-menu-category/' . $restaurant_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditRestaurantMenuCategory($restaurant_id, $menu_category_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_category_name', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->restaurant_model->doEditRestaurantMenuCategory($menu_category_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/restaurant-menu-category/' . $restaurant_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.', 'url' => base_url('admin/restaurant-menu-category/' . $restaurant_id)]));
            return FALSE;
        }
    }

    public function changeRestaurantMenuCategoryStatus($menu_category_id, $status) {
        $this->output->set_content_type('application/json');
        $this->restaurant_model->changeRestaurantMenuCategoryStatus($menu_category_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
/////////Restaurant delivery charges..............................!!!!!!!!!!!!!!!!!!   
    public function restaurantDeliveryCharges() {
        $data['title'] = 'Restaurant Delivery Charges';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-delivery-charges/viewRestaurantDeliveryCharges');
        $this->load->view('admin/commons/footer');
    }
    public function get_restaurant_delivery_charges_wrapper() {
        $this->output->set_content_type('application/json');
        $data['charges'] = $this->admin_model->getRestaurantDeliveryCharges();
        $content_wrapper = $this->load->view('admin/restaurant-delivery-charges/restaurant-delivery-charges-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addRestaurantDeliveryCharges($id = null) {
        if (!empty($id)) {
            $data['charges'] = $this->admin_model->getRestaurantDeliveryChargesId($id);
        }
        $data['title'] = 'Restaurant Delivery Charges';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-delivery-charges/addRestaurantDeliveryCharges');
        $this->load->view('admin/commons/footer');
    }

    public function doAddRestaurantDeliveryCharges() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('restaurant_distance', 'Store Distance', 'required');
        $this->form_validation->set_rules('base_charge', 'Base Charge', 'required');
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'required');
       
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $data = array(
           
            'restaurant_distance' => $this->security->xss_clean($this->input->post('restaurant_distance')),
            'base_charge' => $this->security->xss_clean($this->input->post('base_charge')),
            'extra_charge' => $this->security->xss_clean($this->input->post('extra_charge')),
        );
        
        $result = $this->admin_model->doAddRestaurantDeliveryCharges($data);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Delevery Charges added sucessfully', 'url' => base_url('admin/restaurantDeliveryCharges')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Delevery Charges did not added sucessfully.']));
            return FALSE;
        }
    }
    public function doEditRestaurantDeliveryCharges($id) {

        $this->output->set_content_type('application/json');

       
       $this->form_validation->set_rules('restaurant_distance', 'Store Distance', 'required');
        $this->form_validation->set_rules('base_charge', 'Base Charge', 'required');
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $data = array(
           
            'restaurant_distance' => $this->security->xss_clean($this->input->post('restaurant_distance')),
            'base_charge' => $this->security->xss_clean($this->input->post('base_charge')),
            'extra_charge' => $this->security->xss_clean($this->input->post('extra_charge')),
        );
        $result = $this->admin_model->doEditRestaurantDeliveryCharges($data, $id);

        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details Updated Sucessfully', 'url' => base_url('admin/restaurantDeliveryCharges')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made', 'url' => base_url('admin/restaurantDeliveryCharges')]));
            return FALSE;
        }
    }
////// End Restaurant delivery charges !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!    

}
