<?php

/**
 * Description of AdminStore
 *
 * @author Mohit Kant Gupta
 */
class AdminStore extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'category_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    private function getFilteredCategories() {
        $list = ['' => '--Select The Category--'];
        $categories = $this->category_model->getAllActiveCategory();
        foreach ($categories as $category) {
            $list[$category['category_id']] = $category['category_name'];
        }
        return $list;
    }

    private function getFilteredStores() {
        $list = ['' => '--Select The Store--'];
        $stores = $this->category_model->getAllActiveStores();
        foreach ($stores as $store) {
            $list[$store['store_id']] = $store['store_name'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Store';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/store/viewStore');
        $this->load->view('admin/commons/footer');
    }

    public function get_store_wrapper() {
        $this->output->set_content_type('application/json');
        $data['stores'] = $this->category_model->getStore();
        $content_wrapper = $this->load->view('admin/store/store-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    private function filteredPartner() {
        $list = ['' => 'Select the Partner'];
        $partners = $this->category_model->getActivePartner();
        foreach ($partners as $partner) {
            $list[$partner['partner_id']] = $partner['first_name'] . ' ' . $partner['last_name'];
        }
        return $list;
    }

    public function addStore($id = null) {
        if (!empty($id)) {
            $data['store'] = $this->category_model->getStoreById($id);
        }
        $data['map'] = '1';
        $data['user'] = $this->getUserData();
        $data['title'] = 'Store';
        $data['partners'] = $this->filteredPartner();
        $data['category'] = $this->getFilteredCategories();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/store/addStore');
        $this->load->view('admin/commons/footer');
    }

    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/store",
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

    public function doAddStore() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        $this->form_validation->set_rules('store_name', 'Store Name', 'required|is_unique[store.store_name]');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required');
        $this->form_validation->set_rules('opening_time_from', 'Opening Time', 'required');
        $this->form_validation->set_rules('opening_time_to', 'Closing Time', 'required');
//        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
//        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
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
        $result = $this->category_model->doAddStore($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/adminStore')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditStore($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required');
        $this->form_validation->set_rules('opening_time_from', 'Opening Time', 'required');
        $this->form_validation->set_rules('opening_time_to', 'Closing Time', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
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
            $store = $this->category_model->getStoreById($id);
            $image_url = $store['image_url'];
        }
        $result = $this->category_model->doEditStore($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('admin/adminStore')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }

    public function changeStoreStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->category_model->changeStoreStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

	public function changeStoreStatusOpenOrClose($id, $status) {
        $this->output->set_content_type('application/json');
        $this->category_model->changeStoreStatusOpenOrClose($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }


//  Shop Section

    public function shop_section($id = null) {
		
        if (!empty($id)) {
            $data['shop_section'] = $this->category_model->getShopSectionById($id);
        }
        $data['title'] = 'Shop Section';
        $data['user'] = $this->getUserData();
        $data['table'] = '1';
        $data['stores'] = $this->getFilteredStores();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/shop-section/shop-section');
        $this->load->view('admin/commons/footer');
    }

    public function get_shop_section_wrapper() {
        $this->output->set_content_type('application/json');
        $data['user_type'] = $user_type = $this->session->userdata('user_type');
        if ($user_type == 'service_provider') {
            $user = $this->getUserData();
            $data['shop_sections'] = $this->category_model->getShopSectionByServiceProviderId($user['service_provider_id']);
        } else {
            $data['shop_sections'] = $this->category_model->getShopSection();
        }
        $content_wrapper = $this->load->view('admin/shop-section/shop-section-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddShopSection() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('store_id', 'Store Name', 'required');
        $this->form_validation->set_rules('shop_section_name', 'Shop Section Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->doAddShopSection();
        if ($result) {
            if ($this->user_type == 'admin') {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'details added sucessfully', 'url' => base_url('admin/shop-section')]));
            } else if ($this->user_type == 'partner') {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'details added sucessfully', 'url' => base_url('partner/shop-section')]));
            }
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditShopSection($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('store_id', 'Store Name', 'required');
        $this->form_validation->set_rules('shop_section_name', 'Shop Section Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->category_model->doEditShopSection($id);
        if ($result) {
            if ($this->user_type == 'admin') {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details updated sucessfully', 'url' => base_url('admin/shop-section')]));
            } else if ($this->user_type == 'partner') {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details updated sucessfully', 'url' => base_url('partner/shop-section')]));
            }
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made']));
            return FALSE;
        }
    }

    public function changeShopSectionStatus($shop_section_id, $status) {
        $this->output->set_content_type('application/json');
        $this->category_model->doChangeCategoryStatus($shop_section_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function removeSpecification($id) {
        $this->admin_model->doRemoveSpecification($id);
    }

    public function showDetails($id) {
        $data['product'] = $this->admin_model->getProductById($id);
        $data['specification'] = $this->admin_model->getSpecificationByProductById($id);
        $data['title'] = 'Product';

        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/product/viewProductDetails');
        $this->load->view('admin/commons/footer');
    }

    public function changeProductStatus($id) {
        $this->admin_model->doChangeProductStatus($id);
    }

    public function specification($id = null) {
        if (!empty($id)) {
            $data['specification'] = $this->admin_model->getSpecificationById($id);
        }
        $data['title'] = 'Specification';
        $data['table'] = '1';
        $data['specifications'] = $this->admin_model->getSpecification();
        $data['user'] = $this->getUserData();
        $data['user_type'] = $this->session->userdata('user_type');
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/specification/specification');
        $this->load->view('admin/commons/footer');
    }

    public function doAddSpecification() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('group_name', 'Group Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddSpecification();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Specification group added sucessfully', 'url' => base_url('store/specification')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Category did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditSpecification($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('group_name', 'Group Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditSpecification($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('store/specification')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }

    public function changeSpecificationStatus($id) {
        $result = $this->admin_model->doChangeSpecificationStatus($id);
    }
	 ////slider function
    
    public function store_slider() {
        $data['title'] = 'Store Slider';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
         $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/store-slider/viewSlider');
        $this->load->view('admin/commons/footer');
    }

    public function get_store_slider_wrapper() {
        $this->output->set_content_type('application/json');
        $data['sliders'] = $this->admin_model->getSlider();
        $content_wrapper = $this->load->view('admin/store-slider/slider-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
     public function addStoreSlider() {
        $data['title'] = 'Store Slider';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
         $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/store-slider/addSlider');
        $this->load->view('admin/commons/footer');
    }

    public function doAddStoreSlider() {
        $this->output->set_content_type('application/json');
        $image_url = $this->doUploadSliderImg();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $result = $this->admin_model->doAddSlider($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Slider added sucessfully', 'url' => base_url('admin/store-slider')]));
            return FALSE;
        }
    }

    public function doUploadSliderImg() {
        $config = array(
            'upload_path' => "./uploads/slider",
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
    
    

    public function doDeleteStoreSlider($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->doDeleteSlider($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Slider Deleted sucessfully', 'url' => base_url('admin/store-slider')]));
            return FALSE;
        }
    }

    public function changeStoreSliderStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->admin_model->changeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
/////////store delivery charges..............................!!!!!!!!!!!!!!!!!!   
    public function storeDeliveryCharges() {
        $data['title'] = 'Store Delivery Charges';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/store-delivery-charges/viewStoreDeliveryCharges');
        $this->load->view('admin/commons/footer');
    }
    public function get_store_delivery_charges_wrapper() {
        $this->output->set_content_type('application/json');
        $data['charges'] = $this->admin_model->getStoreDeliveryCharges();
        $content_wrapper = $this->load->view('admin/store-delivery-charges/store-delivery-charges-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addStoreDeliveryCharges($id = null) {
        if (!empty($id)) {
            $data['charges'] = $this->admin_model->getStoreDeliveryChargesId($id);
        }
        $data['title'] = 'Store Delivery Charges';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/store-delivery-charges/addStoreDeliveryCharges');
        $this->load->view('admin/commons/footer');
    }

    public function doAddStoreDeliveryCharges() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('store_distance', 'Store Distance', 'required');
        $this->form_validation->set_rules('base_charge', 'Base Charge', 'required');
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'required');
       
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $data = array(
           
            'store_distance' => $this->security->xss_clean($this->input->post('store_distance')),
            'base_charge' => $this->security->xss_clean($this->input->post('base_charge')),
            'extra_charge' => $this->security->xss_clean($this->input->post('extra_charge')),
        );
        
        $result = $this->admin_model->doAddStoreDeliveryCharges($data);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Delevery Charges added sucessfully', 'url' => base_url('admin/storeDeliveryCharges')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Delevery Charges did not added sucessfully.']));
            return FALSE;
        }
    }
    public function doEditStoreDeliveryCharges($id) {

        $this->output->set_content_type('application/json');

       
       $this->form_validation->set_rules('store_distance', 'Store Distance', 'required');
        $this->form_validation->set_rules('base_charge', 'Base Charge', 'required');
        $this->form_validation->set_rules('extra_charge', 'Extra Charge', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $data = array(
           
            'store_distance' => $this->security->xss_clean($this->input->post('store_distance')),
            'base_charge' => $this->security->xss_clean($this->input->post('base_charge')),
            'extra_charge' => $this->security->xss_clean($this->input->post('extra_charge')),
        );
        $result = $this->admin_model->doEditStoreDeliveryCharges($data, $id);

        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details Updated Sucessfully', 'url' => base_url('admin/storeDeliveryCharges')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made', 'url' => base_url('admin/storeDeliveryCharges')]));
            return FALSE;
        }
    }
////// End store delivery charges !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!     

}
