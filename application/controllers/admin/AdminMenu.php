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
    
    private function filteredMenuCategory() {
        $list = ['' => 'Select Menu Category'];
        $menuCategorys = $this->restaurant_model->getActiveMenuCategory();
        foreach ($menuCategorys as $menuCategory) {
            $list[$menuCategory['menu_category_id']] = $menuCategory['menu_category_name'];
        }
        return $list;
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
    
    public function doAddRestaurantMenu($restaurant_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('menu_category', 'Menu Category', 'required');
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
        $result = $this->restaurant_model->doAddRestaurantMenu($restaurant_id,$image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/editRestaurant/'.$restaurant_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditRestaurantMenu($restaurant_id,$menu_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('menu_category', 'Menu Category', 'required');
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
            $store = $this->restaurant_model->getRestaurantMenuById($restaurant_id, $menu_id);
            $image_url = $store['image_url'];
        }
        $result = $this->restaurant_model->doEditRestaurantMenu($menu_id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('admin/editRestaurant/'.$restaurant_id)]));
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
      
    public function manage_menu_wrapper($restaurant_id, $menu_id=NULL){
        $this->output->set_content_type('application/json');
//        if(!empty($restaurant_id && $menu_id)){
//            $data['menu']= $this->restaurant_model->getRestaurantMenuById($restaurant_id,$menu_id);
//        }
        $data['title'] = 'Restaurant';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $data['menu_categorys'] = $this->filteredMenuCategory();
        $data['menus'] = $this->restaurant_model->getRestaurantMenu($restaurant_id);
        $content_wrapper = $this->load->view('admin/restaurant/include/manage-menu-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'restaurant_content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function editMenuWrapper($restaurant_id, $menu_id){
        $this->output->set_content_type('application/json');
        if(!empty($restaurant_id && $menu_id)){
            $data['menu']= $this->restaurant_model->getRestaurantMenuById($restaurant_id,$menu_id);
        }
        $data['title'] = 'Restaurant';
        $data['user'] = $this->getUserData();
        $data['restaurant_id'] = $restaurant_id;
        $data['menu_categorys'] = $this->filteredMenuCategory();
        $data['menus'] = $this->restaurant_model->getRestaurantMenu($restaurant_id);
        $content_wrapper = $this->load->view('admin/restaurant/include/edit-menu-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'edit_menu_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function doImportMenuInCSVFile($restaurant_id) {
        
        $this->output->set_content_type('application/json');
        $filename1 = $_FILES['new_menu_csv']['name'];
        $filename = $_FILES["new_menu_csv"]["tmp_name"];
        $ext = pathinfo($filename1, PATHINFO_EXTENSION);
        
        if (empty($filename)) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please Insert Csv File']));
            return FALSE;
        }
        if ($ext !== 'csv') {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please Upload only Csv File']));
            return FALSE;
        }
        if ($_FILES["new_menu_csv"]["size"] > 0) {
            $file = fopen($filename, "r");
            $count = 0;
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                if ($count > 0) {
                    $insert_csv = array();
                    $insert_csv['menu_category_id'] = addslashes($emapData[0]);
                    $insert_csv['restaurant_id'] = addslashes($emapData[1]);
                    $insert_csv['image_url'] = addslashes($emapData[2]);
                    $insert_csv['menu_name'] = addslashes($emapData[3]);
                    $insert_csv['price'] = addslashes($emapData[4]);
                    $insert_csv['emarket_point'] = addslashes($emapData[5]);
                    $insert_csv['discount'] = addslashes($emapData[6]);
                    $insert_csv['description'] = addslashes($emapData[7]);
                    $insert_csv['is_special'] = addslashes($emapData[8]);
                    $insert_csv['spicy'] = addslashes($emapData[9]);
                    $insert_csv['topping'] = addslashes($emapData[10]);
                    $insert_csv['is_active'] = addslashes($emapData[11]);
                    if (empty($insert_csv['menu_category_id'] || $insert_csv['restaurant_id'] || $insert_csv['image_url'] || $insert_csv['menu_name'] || $insert_csv['price'] || $insert_csv['description'] || $insert_csv['is_active'])) {
                        $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please fill all the Details']));
                        return FALSE;
                    }
                    
                    $alreadyexist = $this->restaurant_model->checkAlreadyExistMenu($insert_csv['menu_name']);
                    
                    if ($alreadyexist > 0) {
                        $this->output->set_output(json_encode(['result' => 0, 'errors' => 'This Menu ' . $insert_csv['menu_name'] . ' Already Exist in the Record on the line no. ' . $count]));
                        return FALSE;
                    }
                }
                $count++;
            }

            $file = fopen($filename, "r");
            $count = 0;
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                $z = 0;
                $list = [];
                if ($count > 0) {
                    $insert_csv = array();
                    $menu_section = $this->restaurant_model->getMenuCategoryName($emapData[0]);
                    $insert_csv['menu_category_id'] = $menu_section['menu_category_id'];
                    $restaurant_section = $this->restaurant_model->getRestaurantName($emapData[1]);
                    $insert_csv['restaurant_id'] = $restaurant_section['restaurant_id'];
                    $insert_csv['image_url'] = addslashes($emapData[2]);
                    $insert_csv['menu_name'] = addslashes($emapData[3]);
                    $insert_csv['price'] = addslashes($emapData[4]);
                    $insert_csv['emarket_point'] = addslashes($emapData[5]);
                    $insert_csv['discount'] = addslashes($emapData[6]);
                    $insert_csv['description'] = addslashes($emapData[7]);
                    $insert_csv['is_special'] = addslashes($emapData[8]);
                    $insert_csv['spicy'] = addslashes($emapData[9]);
                    $insert_csv['topping'] = addslashes($emapData[10]);
                    $insert_csv['is_active'] = addslashes($emapData[11]);

                    $data = array(
                        'menu_category_id' => $insert_csv['menu_category_id'],
                        'restaurant_id' => $insert_csv['restaurant_id'],
                        'image_url' => $insert_csv['image_url'],
                        'menu_name' => $insert_csv['menu_name'],
                        'price' => $insert_csv['price'],
                        'emarket_point' => $insert_csv['emarket_point'],
                        'discount' => $insert_csv['discount'],
                        'description' => $insert_csv['description'],
                        'is_special' => $insert_csv['is_special'],
                        'spicy' => $insert_csv['spicy'],
                        'topping' => $insert_csv['topping'],
                        'is_active' => $insert_csv['is_active']
                    );
                    
                    $menu_id = $this->restaurant_model->uploadMenucsvFile($data);
                }
                $count++;
            }
            fclose($file) or die("can't close file");
            redirect(base_url('admin/editRestaurant/' . $restaurant_id));
        }

        if ($menu_id) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Uploaded Sucessfully', 'url' => base_url('admin/editRestaurant/'.$restaurant_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.', 'url' => base_url('admin/editRestaurant/'.$restaurant_id)]));
            return FALSE;
        }
    }
    
    public function doExportMenuCSVFile($restaurant_id) {
//        $this->output->set_content_type('application/json');
        $menus = $this->restaurant_model->getMenuDataByRestaurantData($restaurant_id);
        
        $i = 0;
        $lists = array();
        foreach ($menus as $menu) {
            $lists[$i]['menu_id'] = $menu['menu_id'];
            $lists[$i]['menu_category_name'] = $menu['menu_category_name'];
            $lists[$i]['restaurant_name'] = $menu['restaurant_name'];
            $lists[$i]['image_url'] = $menu['image_url'];
            $lists[$i]['menu_name'] = $menu['menu_name'];
            $lists[$i]['price'] = $menu['price'];
            $lists[$i]['emarket_point'] = $menu['emarket_point'];
            $lists[$i]['discount'] = $menu['discount'];
            $lists[$i]['description'] = $menu['description'];
            $lists[$i]['is_special'] = $menu['is_special'];
            $lists[$i]['spicy'] = $menu['spicy'];
            $lists[$i]['topping'] = $menu['topping'];
            $lists[$i]['is_active'] = $menu['is_active'];
            $i++;
        }

        // file name
        $filename = 'product_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        header("Pragma: no-cache");
        header("Expires: 0");
        // file creation
        $file = fopen('php://output', 'w');
        $header = array("menu_category_name", "restaurant_name", "image_url", "menu_name", "price", "emarket_point", "discount", "description", "is_special", "spicy", "topping","is_active");
        fputcsv($file, $header);

        foreach ($lists as $list){
            $productData = array($list['menu_category_name'],$list['restaurant_name'],$list['image_url'],$list['menu_name'],$list['price'],$list['emarket_point'],$list['discount'],$list['description'],$list['is_special'],$list['spicy'],$list['topping'],$list['is_active']);
            
            fputcsv($file, $productData);
        }
        fclose($file);
        exit;
    }
}
