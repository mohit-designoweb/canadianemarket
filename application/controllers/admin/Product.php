
<?php

/**
 * Description of Product
 *
 * 	@author Ram Ji Yadav/Mohit Kant Gupta
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'product_model']);
        if (empty($this->session->userdata('email'))) {
            redirect(base_url('admin'));
        }
    }

    private function filteredStore() {
        $list = ['' => 'Select the Store'];
        $stores = $this->admin_model->getStores();
        foreach ($stores as $store) {
            $list[$store['store_id']] = $store['store_name'];
        }
        return $list;
    }

    private function filteredCategory() {
        $list = ['' => 'Select Store Category'];
        $categories = $this->admin_model->getStoreCategoryName();
        foreach ($categories as $category) {
            $list[$category['shop_section_id']] = $category['shop_section_name'];
        }
        return $list;
    }

    private function getFilterSpecification() {
        $list = ['' => 'Select the Group'];
        $specifications = $this->admin_model->getSpecifications();
        foreach ($specifications as $specification) {
            $list[$specification['group_id']] = $specification['group_name'];
        }
        return $list;
    }
    
//    private function filteredShopSection(){
//        $list = ['' => 'Select the Group'];
//        $specifications = $this->admin_model->getSpecifications();
//        foreach ($specifications as $specification) {
//            $list[$specification['group_id']] = $specification['group_name'];
//        }
//        return $list;
//    }
    
    public function get_shop_section() {
        $this->output->set_content_type('application/json');
        $data['changeCategories'] = $this->admin_model->getShopSectionByStoreId($this->input->post('store_id'));
        $shop_section=$this->load->view('admin/product/changeCategory', $data,true);
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 1, 'shop_section' => $shop_section]));
            return FALSE;
        }
    }
    
    public function changeProductByCategory() {
        $data['products'] = $this->admin_model->doChangeProductByCategory($this->input->post('category_id'), $this->input->post('store_id'));
        $this->load->view('admin/product/changeProduct', $data);
    }

    public function index() {
        $data['title'] = 'Product';
        $data['table'] = '1';
        $data['stores'] = $this->filteredStore();
        $data['categories'] = $this->filteredCategory();
        $data['products'] = $this->admin_model->getProduct();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/product/viewProduct');
        $this->load->view('admin/commons/footer');
    }

    public function addProduct($id = null) {
        if (!empty($id)) {
            $data['product'] = $this->admin_model->getProductById($id);
            $data['specification'] = $this->admin_model->getSpecificationByProductById($id);
//            $data['categories'] = $this->filteredCategory();
//            $data['shop_sections']= $this->filteredShopSection();
        }
        $data['title'] = 'Product';
        $data['stores'] = $this->filteredStore();
        $data['specifications'] = $this->getFilterSpecification();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/product/addProduct');
        $this->load->view('admin/commons/footer');
    }

    function doUploadProductImg() {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        $small_image = "";
        $large_image = "";
        if ($this->upload->do_upload('small_image')) {
            $data = $this->upload->data();
            $small_image = $data['file_name'];
        }
        if ($this->upload->do_upload('large_image')) {
            $data = $this->upload->data();
            $large_image = $data['file_name'];
            return $small_image . "," . $large_image;
        }
        if (($this->upload->do_upload('small_image')) || ($this->upload->do_upload('large_image'))) {
            return $small_image . "," . $large_image;
        } if (empty($this->upload->do_upload('small_image'))) {
            $this->session->set_userdata('error1', ['small_image' => $this->upload->display_errors()]);
            return 0;
        }if (empty($this->upload->do_upload('large_image'))) {
            $this->session->set_userdata('error2', ['large_image' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function doAddProduct() {
//        $this->output->set_content_type('application/json');
//        $this->form_validation->set_rules('store_id', 'Store Name', 'required');
//        $this->form_validation->set_rules('shop_section_id', 'Shop Section', 'required');
//        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
//        $this->form_validation->set_rules('sku', 'Product SKU', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
//        if ($this->form_validation->run() === FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
//            return FALSE;
//        }
//        $product_id = $this->admin_model->doAddProduct();
        $product_id=1;
        $sku= $this->input->post('sku');
        $this->createSku($product_id,$sku);
        die;
//        echo '<pre>';
//        print_r($arr);
        
//        
//        if ($product_id) {
//            $sku = $this->input->post('sku');
//            $group_id = $this->input->post('group_id');
//            $group_value = $this->input->post('group_value');
//            for ($i = 0; $i < count($group_id); $i++) {
//                
//                $specification=$this->product_model->getSpecificationById($group_id[$i]);
//                $this->product_model->addProductSku($specification['']);
////                $this->db->insert('product_group_mapping', ['product_id' => $product_id, 'group_id' => $group_id[$i], 'group_value' => $group_value[$i]]);
//            }
//        }
//        $group_id = explode(",",$this->input->post('group_id'));
//        $group_valus = explode(",",$this->input->post('group_value'));
//        if ($result) {
//            $group_value = $this->input->post('group_value');
//            $group_id = $this->input->post('group_id');
//            $id = $result;
//            for ($i = 0; $i < count($group_id); $i++) {
//                $this->db->insert('product_group_mapping', ['product_id' => $id, 'group_id' => $group_id[$i], 'group_value' => $group_value[$i]]);
//            }
//            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('product')]));
//            return FALSE;
//        } else {
//            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product did not added sucessfully.']));
//            return FALSE;
//        }
    }
    
    public function createSku($product_id,$sku){
        $group_id= $this->input->post('group_id');
        $group_value= $this->input->post('group_value');
        $n='';
        $arr=[];
        for($i=0;$i<count($group_id);$i++){
            $n=$group_id[$i];
            if(array_key_exists($n,$arr)){
                $val=$arr[$n];
                $val.=$group_value[$i].',';
                $arr[$n]=$val;
            }else{
                $arr[$n]= $group_value[$i].',';
            }
        }
//        echo '<pre>';
//        print_r($arr);
//        die;
        
        foreach ($arr as $key => $value) {
//            $product_sku_id=$this->admin_model->addProductSku($product_id,$sku);
            
            echo $key.' => '.$value.'<br>';
            $grp_val= rtrim($value,',');
            
            $group_val_arrs=explode(',',$grp_val);
//            foreach($group_val_arrs as $group_val_arr){
//                $this->admin_model->addProductGroupMapping($product_sku_id,$key,$group_val_arr);
//            }
//            echo '<pre>';
//            print_r($group_val_arr);
        }
        
        
        
    }

//    public function doEditProduct($id) {
//        $this->output->set_content_type('application/json');
//        $this->form_validation->set_rules('store_id', 'Store Name', 'required');
//        $this->form_validation->set_rules('shop_section_id', 'Shop Section', 'required');
//        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
//        $this->form_validation->set_rules('price', 'Product Price', 'required');
//        $this->form_validation->set_rules('sku', 'Product SKU', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
//        if ($this->form_validation->run() === FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
//            return FALSE;
//        }
//        $img_url = explode(',', $this->doUploadProductImg());
//        if (!empty($_FILES['small_image']['name'])) {
//            $small_image = $img_url[0];
//            if (!$small_image) {
//                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
//                $this->session->unset_userdata('error');
//                return FALSE;
//            }
//        }
//        if (!empty($_FILES['large_image']['name'])) {
//            $large_image = $img_url[1];
//            if (!$large_image) {
//                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
//                $this->session->unset_userdata('error');
//                return FALSE;
//            }
//        } if (empty($_FILES['small_image']['name'])) {
//            $product = $this->admin_model->getProductById($id);
//            $small_image = $product['small_image'];
//        }
//        if (empty($_FILES['large_image']['name'])) {
//            $product = $this->admin_model->getProductById($id);
//            $large_image = $product['large_image'];
//        }
//        $result = $this->admin_model->doEditProduct($small_image, $large_image, $id);
//        if ($result) {
//            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('store/product')]));
//            return FALSE;
//        } else {
//            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product did not added sucessfully.']));
//            return FALSE;
//        }
//    }

//    public function createSku($id) {
//        $data['title'] = 'Product';
//        $data['table'] = '1';
//        $data['product'] = $this->admin_model->getProductById($id);
//        $data['products'] = $this->admin_model->getSkuByProductId($id);
//        $this->load->view('admin/commons/header', $data);
//        $this->load->view('admin/commons/sidebar');
//        $this->load->view('admin/product/viewProductSku');
//        $this->load->view('admin/commons/footer');
//    }
//
//    public function addSku($id) {
//        $data['title'] = 'Product';
//        $data['product_id'] = $id;
//        $data['product'] = $this->admin_model->getProductById($id);
//        $data['specifications'] = $this->getFilterSpecification();
//        //   print_r($data['Stores']);die;
//        $this->load->view('admin/commons/header', $data);
//        $this->load->view('admin/commons/sidebar');
//        $this->load->view('admin/product/addProductSku');
//        $this->load->view('admin/commons/footer');
//    }
//
//    public function doAddSku($id) {
//        $this->output->set_content_type('application/json');
//        $this->admin_model->doAddSku($id);
//    }

//    public function index() {
//        $data['title'] = 'Product';
//        $data['table'] = '1';
//        $data['products'] = $this->admin_model->getProduct();
//        $this->load->view('admin/commons/header', $data);
//        $this->load->view('admin/commons/sidebar');
//        $this->load->view('admin/product/viewProduct');
//        $this->load->view('admin/commons/footer');
//    }
//
//    public function changeSubacategory() {
//        $data['changeSubactegorys'] = $this->admin_model->changeSubacategory($this->input->post('category_id'));
//        $this->load->view('admin/product/changeSubacategory', $data);
//    }
//
//    public function addProduct($id = null) {
//        $data['categorys'] = $this->admin_model->getCategory();
//        $data['subcategorys'] = $this->admin_model->getSubcategory();
//        if (!empty($id)) {
//            $data['product'] = $this->admin_model->getProductById($id);
//            $data['subcategorys'] = $this->admin_model->getSubcategoryByProductId($id);
//        }
//        $data['title'] = 'Product';
//
//        $this->load->view('admin/commons/header', $data);
//        $this->load->view('admin/commons/sidebar');
//        $this->load->view('admin/product/addProduct');
//        $this->load->view('admin/commons/footer');
//    }
//
//    public function doAddProduct() {
//        $this->output->set_content_type('application/json');
//        $this->form_validation->set_rules('category_id', 'Category Name', 'required');
//        $this->form_validation->set_rules('subcategory_id', 'Sub-Category Name', 'required');
//        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
//        if ($this->form_validation->run() === FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
//            return FALSE;
//        }
//        if (!empty($_FILES['image_url']['name'])) {
//            $image_url = $this->doUploadImg();
//            if (!$image_url) {
//                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
//                $this->session->unset_userdata('error');
//                return FALSE;
//            }
//        } else {
//            $image_url = '';
//        }
//        $result = $this->admin_model->doAddProduct($image_url);
//        if ($result) {
//            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('product')]));
//            return FALSE;
//        } else {
//            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product did not added sucessfully.']));
//            return FALSE;
//        }
//    }
//
//    function doUploadImg() {
//        $config = array(
//            'upload_path' => "./uploads/",
//            'allowed_types' => "jpeg|jpg|png",
//            'file_name' => rand(11111, 99999),
//            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
//        );
//        $this->load->library('upload', $config);
//        if ($this->upload->do_upload('image_url')) {
//            $data = $this->upload->data();
//            return $data['file_name'];
//        } else {
//            $this->session->set_userdata('error', ['image_url' => $this->upload->display_errors()]);
//            return 0;
//        }
//    }
//
//    public function doEditProduct($id) {
//        $this->output->set_content_type('application/json');
//        $this->form_validation->set_rules('category_id', 'Category Name', 'required');
//        $this->form_validation->set_rules('subcategory_id', 'Sub-Category Name', 'required');
//        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
//        if ($this->form_validation->run() === FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
//            return FALSE;
//        }
//        if (!empty($_FILES['image_url']['name'])) {
//            $image_url = $this->doUploadImg();
//            if (!$image_url) {
//                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
//                $this->session->unset_userdata('error');
//                return FALSE;
//            }
//        } else {
//            $product = $this->admin_model->getProductById($id);
//            $image_url = $product['image_url'];
//        }
//        $result = $this->admin_model->doEditProduct($id, $image_url);
//        if ($result) {
//            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('product')]));
//            return FALSE;
//        } else {
//            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
//            return FALSE;
//        }
//    }
//
//    public function showDetails($id) {
//        $data['product'] = $this->admin_model->getProductById($id);
//        $data['title'] = 'Product';
//
//        $this->load->view('admin/commons/header', $data);
//        $this->load->view('admin/commons/sidebar');
//        $this->load->view('admin/product/viewProductDetails');
//        $this->load->view('admin/commons/footer');
//    }
//
//    public function deleteProduct($id) {
//        $result = $this->admin_model->deleteProduct($id);
//        if ($result) {
//            redirect(base_url('product'));
//        }
//    }
}
