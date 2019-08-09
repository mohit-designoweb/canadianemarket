<?php

/**
 * Description of Menu
 *
 * @author Mohit Kant Gupta
 */
class AdminMenu extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'restaurant_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }
    
    private function isLogin() {
        return $this->session->userdata('email_admin');
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    public function restaurant_menu($restaurant_id, $menu_category_id) {
        if (empty($this->isLogin())) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $data['menu_category_id'] = $menu_category_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-menu/view-restaurant-menu');
        $this->load->view('admin/commons/footer');
    }
    
    public function get_restaurant_menu_wrapper($restaurant_id,$menu_category_id){
        $this->output->set_content_type('application/json');
        $data['restaurant_id']=$restaurant_id;
        $data['menu_category_id']=$menu_category_id;
        $data['menus'] = $this->restaurant_model->getRestaurantMenu($restaurant_id,$menu_category_id);
        $content_wrapper = $this->load->view('admin/restaurant-menu/restaurent-menu-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function add_restaurant_menu($restaurant_id,$menu_category_id,$menu_id=null){
        if (empty($this->isLogin())) {
            redirect(base_url('admin'));
        }
        if(!empty($menu_id)){
            $data['menu']= $this->restaurant_model->getRestaurantMenuById($menu_id);
        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $data['menu_category_id'] = $menu_category_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-menu/add-restaurant-menu');
        $this->load->view('admin/commons/footer');
    }
    
    public function doUploadImg() {
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
    
    public function doAddRestaurantMenu($restaurant_id,$menu_category_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('emarket_point','Emarket Point','numeric');
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
        $result = $this->restaurant_model->doAddRestaurantMenu($restaurant_id,$menu_category_id,$image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/restaurant-menu/'.$restaurant_id.'/'.$menu_category_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditRestaurantMenu($restaurant_id,$menu_category_id,$menu_id){
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
            $image_url = $this->doUploadImg();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $store = $this->restaurant_model->getRestaurantMenuById($menu_id);
            $image_url = $store['image_url'];
        }
        $result = $this->restaurant_model->doEditRestaurantMenu($menu_id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('admin/restaurant-menu/'.$restaurant_id.'/'.$menu_category_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }
    
    public function changeRestaurantMenuStatus($menu_id,$status){
        $this->output->set_content_type('application/json');
        $this->restaurant_model->changeRestaurantMenuStatus($menu_id,$status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
