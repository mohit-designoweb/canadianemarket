<?php
/**
 * Description of AdminProduct
 *
 * @author Mohit Kant Gupta
 */
class AdminProduct extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'product_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata($this->session->userdata('is_admin'), $email);
    }

    private function getFilterSpecification() {
        $list = ['' => 'Select the Group'];
        $specifications = $this->product_model->getActiveSpecification();
        foreach ($specifications as $specification) {
            $list[$specification['group_id']] = $specification['group_name'];
        }
        return $list;
    }

    private function getFilterProductCategory($store_id) {
        $list = ['' => 'Select the Product Category'];
        $categorys = $this->product_model->getFilterProductCategory($store_id);
        foreach ($categorys as $categorys) {
            $list[$categorys['shop_section_id']] = $categorys['shop_section_name'];
        }
        return $list;
    }

    // Product
//    public function index($store_id, $shop_section_id) {
//        $data['title'] = 'Product';
//        $data['table'] = '1';
//        $data['user'] = $this->getUserData();
//        $data['store_id'] = $store_id;
//        $data['shop_section_id'] = $shop_section_id;
//        $this->load->view('admin/commons/header', $data);
//        $this->load->view('admin/commons/admin-sidebar', $data);
//        $this->load->view('admin/product/viewProduct');
//        $this->load->view('admin/commons/footer');
//    }
//
//    public function get_product_wrapper($store_id, $shop_section_id) {
//        $this->output->set_content_type('application/json');
//        $data['store_id'] = $store_id;
//        $data['shop_section_id'] = $shop_section_id;
//        $data['products'] = $this->product_model->getProductBySectionId($store_id, $shop_section_id);
//        $content_wrapper = $this->load->view('admin/product/product-wrapper', $data, true);
//        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
//        return FALSE;
//    }

    public function manage_product_wrapper($store_id = NULL, $product_id = NULL) {
        if (!empty($product_id)) {
            $data['product'] = $this->product_model->getProductById($product_id);
            $data['pro_image'] = $this->product_model->getProductImagesById($product_id);
            $data['specifications'] = $this->product_model->getProductGroupingMappingByProductId($product_id);
           
        }
        $this->output->set_content_type('application/json');
        $data['title'] = 'Product';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['store_id'] = $store_id;
        $data['products'] = $products = $this->product_model->getProductBySectionId($store_id);
        
        $i = 0;
        $allProduct =array();
        foreach($products as $product){
            $allProduct[$i]['product_id'] = $product['product_id'];
            $allProduct[$i]['product_name'] = $product['product_name'];
            $allProduct[$i]['description'] = $product['description'];
            $allProduct[$i]['price'] = $product['price'];
            $allProduct[$i]['shop_section_name'] = $product['shop_section_name'];
            $allProduct[$i]['sku'] = $product['sku'];
            $allProduct[$i]['stock'] = $product['stock'];
            $allProduct[$i]['is_active'] = $product['is_active'];
           
            $images = $this->product_model->getProductAllImages($product['product_id']);
            
            $allProduct[$i]['image_url'] = $images['image_url'];
            $i++;
        }
        
        $data['allProduct'] = $allProduct;
        $data['specification'] = $this->getFilterSpecification();
        $data['categorys'] = $this->getFilterProductCategory($store_id);
        
        $content_wrapper = $this->load->view('admin/store/include/manage-product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'store_content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doUploadProductImage() {
        $this->output->set_content_type('application/json');
        $this->load->library('upload');
        $count = count($_FILES['image_url']['size']);
        $image = [];
        $i = 1;
        
        foreach ($_FILES as $key => $value) {
            for ($s = 0; $s < $count; $s++) {
                $_FILES['image_url']['name'] = $value['name'][$s];
                $_FILES['image_url']['type'] = $value['type'][$s];
                $_FILES['image_url']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['image_url']['error'] = $value['error'][$s];
                $_FILES['image_url']['size'] = $value['size'][$s];
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('image_url');
                $data = $this->upload->data();
                $image[$i] = $data['file_name'];
                $i++;
            }
        }
        return $image;
    }
    
    private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/product-sku';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = '2048';
        $config['overwrite'] = FALSE;
        $config['file_name'] = rand(11111, 99999);
        return $config;
    }
    
    public function doAddProduct() {
        
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|is_unique[product.product_name]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('emarket_point', 'Emarket Point', 'trim|numeric');
        $this->form_validation->set_rules('sku', 'SKU/UPC', 'trim|required|is_unique[product.sku]');
        $this->form_validation->set_rules('shop_section_id', 'Product Category', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $store_id = $this->input->post('store_id');
        $images = $this->doUploadProductImage();
        if (!$images) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        
        $result = $this->product_model->doAddProduct();
        if ($result) {
            foreach ($images as $image) {
                $this->product_model->addProductImage($image, $result);
            }
            $this->add_product_group_mapping($result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Product Detail Added Sucessfully', 'url' => base_url('admin/editStore/' . $store_id)]));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product did not added sucessfully.', 'url' => base_url('admin/editStore/' . $store_id)]));
            return FALSE;
        }
    }

    public function add_product_group_mapping($product_id) {
        $specifications = $this->input->post('specification');
        $specifications_value = $this->input->post('specification_value');

        for ($i = 0; $i < count($specifications); $i++) {
            $this->product_model->add_product_group_mapping($product_id, $specifications[$i], $specifications_value[$i]);
        }
        return True;
    }
       
    public function editProductDataWrapper($store_id = null, $product_id = null) {
        $this->output->set_content_type('application/json');
        if (!empty($product_id)) {
            $data['product'] = $this->product_model->getProductById($product_id);
            $data['pro_image'] = $this->product_model->getProductImagesById($product_id);
            $data['specifications'] = $this->product_model->getProductGroupingMappingByProductId($product_id);
        }
        $data['title'] = 'Product';
        $data['user'] = $this->getUserData();
        $data['store_id'] = $store_id;
        $data['specification'] = $this->getFilterSpecification();
        $data['categorys'] = $this->getFilterProductCategory($store_id);

        $content_wrapper = $this->load->view('admin/store/include/edit-product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'edit_product_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function get_product_image_wrapper($product_id) {
        $this->output->set_content_type('application/json');
        $data['pro_image'] = $this->product_model->getProductImages($product_id);
        $images_wrapper = $this->load->view('admin/store/include/product-image-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'image_wrapper' => $images_wrapper]));
        return FALSE;
    }

    public function doDeleteProductSkuImage($store_id, $product_id, $image_id) {
        $this->output->set_content_type('application/json');
        
        $this->product_model->doDeleteProductImage($image_id);
        if (!empty($product_id)) {
            $data['store_id'] = $store_id;
            $data['product'] = $this->product_model->getProductById($product_id);
            $data['pro_image'] = $this->product_model->getProductImagesById($product_id);
            $data['specifications'] = $this->product_model->getProductGroupingMappingByProductId($product_id);
        }
        $data['title'] = 'Product';
        $data['user'] = $this->getUserData();
        $data['specification'] = $this->getFilterSpecification();
        $data['categorys'] = $this->getFilterProductCategory($store_id);
        $content_wrapper = $this->load->view('admin/store/include/edit-product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'edit_product_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function mergeProductSkuImage($image, $product_images) {
        $count = count($image);
        foreach ($product_images as $p_image) {
            $image[++$count] = $p_image['image_url'];
        }
        return $image;
    }

    public function doEditProduct($store_id, $product_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('emarket_point', 'Emarket Point', 'trim|numeric');
        $this->form_validation->set_rules('sku', 'SKU/UPC', 'trim|required');
        $this->form_validation->set_rules('shop_section_id', 'Product Category', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['tmp_name'][0])) {
           $image = $this->doUploadProductImage();
           if (!$image) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
           $this->product_model->getProductImagesById($product_id);
        }
       
        if (!empty($image)) {
           $this->product_model->deleteAllProductImage($product_id);
           foreach ($image as $img) {
               $this->product_model->addProductSkuImage($img, $product_id);
           }
        }
        $updateProduct = $this->product_model->doEditProduct($product_id);
        $updateMapping = $this->updateProductGroupMapping($product_id);
        if ($updateProduct || $updateMapping) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/editStore/' . $store_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.', 'url' => base_url('admin/editStore/' . $store_id)]));
            return FALSE;
        }
    }

    public function updateProductGroupMapping($product_id) {
        $specifications = $this->input->post('specification');
        $specifications_value = $this->input->post('specification_value');
        $mapping_id = $this->input->post('sku_mapping_id');
        $count = count($specifications);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($mapping_id[$i])) {
                $this->product_model->updateProductGroupMapping($mapping_id[$i], $specifications[$i], $specifications_value[$i]);
            } else {
                $this->product_model->add_product_group_mapping($product_id, $specifications[$i], $specifications_value[$i]);
            }
        }
        return True;
    }

    public function changeProductStatus($product_id, $status) {
        $this->output->set_content_type('application/json');
        $this->product_model->changeProductStatus($product_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function doUploadProductBycsv($store_id) {
        $this->output->set_content_type('application/json');
        $filename1 = $_FILES['new_product_csv']['name'];
        $filename = $_FILES["new_product_csv"]["tmp_name"];
        $ext = pathinfo($filename1, PATHINFO_EXTENSION);
        if (empty($filename)) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please Insert Csv File']));
            return FALSE;
        }
        if ($ext !== 'csv') {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please Upload only Csv File']));
            return FALSE;
        }
        if ($_FILES["new_product_csv"]["size"] > 0) {
            $file = fopen($filename, "r");
            $count = 0;
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {

                if ($count > 0) {
                    $insert_csv = array();
                    $insert_csv['shop_section_id'] = addslashes($emapData[0]);
                    $insert_csv['store_id'] = addslashes($emapData[1]);
                    $insert_csv['image_url'] = addslashes($emapData[2]);
                    $insert_csv['product_name'] = addslashes($emapData[3]);
                    $insert_csv['description'] = addslashes($emapData[4]);
                    $insert_csv['price'] = addslashes($emapData[5]);
                    $insert_csv['discount'] = addslashes($emapData[6]);
                    $insert_csv['sku'] = addslashes($emapData[7]);
                    $insert_csv['stock'] = addslashes($emapData[8]);
                    $insert_csv['emarket_point'] = addslashes($emapData[9]);
                    $insert_csv['is_active'] = addslashes($emapData[10]);
                    $insert_csv['group_id'] = addslashes($emapData[11]);
                    $insert_csv['group_value'] = addslashes($emapData[12]);
                    $insert_csv['group_id'] = addslashes($emapData[13]);
                    $insert_csv['group_value'] = addslashes($emapData[14]);
                    if (empty($insert_csv['shop_section_id'] || $insert_csv['store_id'] || $insert_csv['product_name'] || $insert_csv['description'] || $insert_csv['price'] || $insert_csv['sku'] || $insert_csv['is_active'] || $insert_csv['group_id'] || $insert_csv['group_value'])) {
                        $this->output->set_output(json_encode(['result' => 0, 'errors' => 'Please fill all the Details']));
                        return FALSE;
                    }
                    $alreadyexist = $this->product_model->checkAlreadyExistData($insert_csv['product_name'], $insert_csv['sku']);
                    if ($alreadyexist > 0) {
                        $this->output->set_output(json_encode(['result' => 0, 'errors' => 'This Product ' . $insert_csv['product_name'] . ' Already Exist in the Record on the line no. ' . $count]));
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
//                    $insert_csv['shop_section_id'] = addslashes($emapData[0]);
                    $shop_section = $this->product_model->getCategoryName($emapData[0]);
                    $insert_csv['shop_section_id'] = $shop_section['shop_section_id'];
//                    $insert_csv['store_id'] = addslashes($emapData[1]);
                    $store_section = $this->product_model->getStoreName($emapData[1]);
                    $insert_csv['store_id'] = $store_section['store_id'];
                    $insert_csv['image_url'] = addslashes($emapData[2]);
                    $insert_csv['product_name'] = addslashes($emapData[3]);
                    $insert_csv['description'] = addslashes($emapData[4]);
                    $insert_csv['price'] = addslashes($emapData[5]);
                    $insert_csv['discount'] = addslashes($emapData[6]);
                    $insert_csv['sku'] = addslashes($emapData[7]);
                    $insert_csv['stock'] = addslashes($emapData[8]);
                    $insert_csv['emarket_point'] = addslashes($emapData[9]);
                    $insert_csv['is_active'] = addslashes($emapData[10]);

                    if (!empty($emapData[11])) {

                        $group_section = $this->product_model->getGroupName(addslashes($emapData[11]));
                        $insert_csv['group_id'] = $group_section['group_id'];
                        $list[$z]['group_id'] = $insert_csv['group_id'];
                    }
                    if (!empty($emapData[12])) {

                        $insert_csv['group_value'] = addslashes($emapData[12]);
                        $list[$z]['group_value'] = $insert_csv['group_value'];
                        $z++;
                    }

                    if (!empty($emapData[13])) {

                        $group_section = $this->product_model->getGroupName(addslashes($emapData[13]));
                        $insert_csv['group_id'] = $group_section['group_id'];
                        $list[$z]['group_id'] = $insert_csv['group_id'];
                    }
                    if (!empty($emapData[14])) {
                        $insert_csv['group_value'] = addslashes($emapData[14]);
                        $list[$z]['group_value'] = $insert_csv['group_value'];
                        $z++;
                    }

                    if (!empty($emapData[15])) {

                        $group_section = $this->product_model->getGroupName(addslashes($emapData[15]));
                        $insert_csv['group_id'] = $group_section['group_id'];
                        $list[$z]['group_id'] = $insert_csv['group_id'];
                    }
                    if (!empty($emapData[16])) {
                        $insert_csv['group_value'] = addslashes($emapData[16]);
                        $list[$z]['group_value'] = $insert_csv['group_value'];
                        $z++;
                    }

                    $data = array(
                        'shop_section_id' => $insert_csv['shop_section_id'],
                        'store_id' => $insert_csv['store_id'],
                        'image_url' => $insert_csv['image_url'],
                        'product_name' => $insert_csv['product_name'],
                        'description' => $insert_csv['description'],
                        'price' => $insert_csv['price'],
                        'discount' => $insert_csv['discount'],
                        'sku' => $insert_csv['sku'],
                        'stock' => $insert_csv['stock'],
                        'emarket_point' => $insert_csv['emarket_point'],
                        'is_active' => $insert_csv['is_active']
                    );

                    $product_id = $this->product_model->uploadProductcsvFile($data);

                    $sku = array(
                        'product_id' => $product_id,
                        'group_id' => $insert_csv['group_id'],
                        'group_value' => $insert_csv['group_value']
                    );
                    $result = $this->product_model->uploadProductskuDetails($sku);

                    if (!empty($list)) {
                        foreach ($list as $mapp) {
                            $sku = array(
                                'product_id' => $product_id,
                                'group_id' => $mapp['group_id'],
                                'group_value' => $mapp['group_value']
                            );
                            $result = $this->product_model->uploadProductskuDetails($sku);
                        }
                    }
                }
                $count++;
            }
            fclose($file) or die("can't close file");
            redirect(base_url('admin/editStore/' . $store_id));
        }

//        $uploadedfile = $this->product_model->doEditProduct($image_url, $product_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Uploaded Sucessfully', 'url' => base_url('admin/editStore/' . $store_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.', 'url' => base_url('admin/editStore/' . $store_id)]));
            return FALSE;
        }
    }

    public function doExportCSVFile($store_id) {
//        $this->output->set_content_type('application/json');
        $products = $this->product_model->getProductDataByStoreId($store_id);
        $i = 0;
        $lists = array();
        foreach ($products as $product) {
            $lists[$i]['product_id'] = $product['product_id'];
            $lists[$i]['shop_section_name'] = $product['shop_section_name'];
            $lists[$i]['store_name'] = $product['store_name'];
            $lists[$i]['image_url'] = $product['image_url'];
            $lists[$i]['product_name'] = $product['product_name'];
            $lists[$i]['description'] = $product['description'];
            $lists[$i]['price'] = $product['price'];
            $lists[$i]['discount'] = $product['discount'];
            $lists[$i]['sku'] = $product['sku'];
            $lists[$i]['stock'] = $product['stock'];
            $lists[$i]['emarket_point'] = $product['emarket_point'];
            $lists[$i]['is_active'] = $product['is_active'];
            $skumappings = $this->product_model->getProductSKUMappings($product['product_id']);
            $j = 0;
            foreach ($skumappings as $skumapping) {
                $lists[$i]['productmapping'][$j]['group_name'] = $skumapping['group_name'];
                $lists[$i]['productmapping'][$j]['group_value'] = $skumapping['group_value'];
                $j++;
            }
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
        $productHeading = array("shop_section_name", "store_name", "image_url", "product_name", "description", "price", "discount", "sku", "stock", "emarket_point", "is_active");
        $productMapping = array("group_name", "group_value","group_name", "group_value","group_name", "group_value");

        $header = array_merge($productHeading, $productMapping);
        fputcsv($file, $header);

        foreach ($lists as $list){
            $productData = array($list['shop_section_name'],$list['store_name'],$list['image_url'],$list['product_name'],$list['description'],$list['price'],$list['discount'],$list['sku'],$list['stock'],$list['emarket_point'],$list['is_active']);
            $Mappings = array();
            $i = 0;
            foreach($list['productmapping'] as $productMapping){
                $Mappings[$i] = array($productMapping['group_name'],$productMapping['group_value']);
                $i++;
            }
            if(!empty($Mappings[0])){
                $mapping = $Mappings[0];
            }
            if(!empty($Mappings[0] && $Mappings[1])){
                $mapping = array_merge($Mappings[0], $Mappings[1]); 
            }
            if(!empty($Mappings[0] && $Mappings[1] && $Mappings[2])){
                $mapping = array_merge(array_merge($Mappings[0], $Mappings[1]),$Mappings[2]);
            }
            fputcsv($file, array_merge($productData,$mapping));
        }
        fclose($file);
        exit;
    }

    public function doProductDelete(){
        echo "HEy1";
        echo $this->input->post('product_ids');exit;
    }

    public function doProductActivate(){
        echo "HEy2";
        echo $this->input->post('checkboxValues').'/'.$this->input->post('value');exit;
    }


    public function doProductDeactivate(){
        echo "HEy3";
        echo $this->input->post('product_ids');exit;
    }

    public function doProductOutOfStock(){
        echo "HEy4";
        echo $this->input->post('product_ids');exit;
    }
}
