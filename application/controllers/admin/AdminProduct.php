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

    // Product
    public function index($store_id, $shop_section_id) {
        $data['title'] = 'Product';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['store_id'] = $store_id;
        $data['shop_section_id'] = $shop_section_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/product/viewProduct');
        $this->load->view('admin/commons/footer');
    }

    public function get_product_wrapper($store_id, $shop_section_id) {
        $this->output->set_content_type('application/json');
        $data['store_id'] = $store_id;
        $data['shop_section_id'] = $shop_section_id;
        $data['products'] = $this->product_model->getProductBySectionId($store_id, $shop_section_id);
        $content_wrapper = $this->load->view('admin/product/product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function add_product($store_id, $shop_section_id, $product_id = null) {
        if (!empty($product_id)) {
            $data['product'] = $this->product_model->getProductById($product_id);
            $data['specifications'] = $this->product_model->getProductGroupingMappingByProductId($product_id);
        }
        $data['title'] = 'Product';
        $data['user'] = $this->getUserData();
        $data['store_id'] = $store_id;
        $data['shop_section_id'] = $shop_section_id;
        $data['specification'] = $this->getFilterSpecification();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/product/addProduct');
        $this->load->view('admin/commons/footer');
    }

    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/product",
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

    public function doAddProduct($store_id, $shop_section_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
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
        $result = $this->product_model->doAddProduct($store_id, $shop_section_id, $image_url);
        if ($result) {
            $this->add_product_group_mapping($result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/adminProduct/' . $store_id . '/' . $shop_section_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product did not added sucessfully.', 'url' => base_url('admin/adminProduct/' . $store_id . '/' . $shop_section_id)]));
            return FALSE;
        }
    }

    public function add_product_group_mapping($result) {
        $specifications = $this->input->post('specification');
        foreach ($specifications as $spec) {
            $this->product_model->add_product_group_mapping($spec, $result);
        }
        return 1;
    }

    public function removeProductGroupMapping($mapping_id) {
        $this->output->set_content_type('application/json');
        $this->product_model->removeProductGroupMapping($mapping_id);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function updateProductGroupMapping($product_id) {
        $specification = $this->input->post('specification[]');
        $mapping_id = $this->input->post('mapping_id[]');
        $count = count($specification);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($mapping_id[$i])) {
                $this->product_model->updateProductGroupMapping($specification[$i], $mapping_id[$i]);
            } else {
                $this->product_model->add_product_group_mapping($specification[$i], $product_id);
            }
        }
        return 1;
    }

    public function doEditProduct($store_id, $shop_section_id, $product_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
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
            $product = $this->product_model->getProductById($product_id);
            $image_url = $product['image_url'];
        }
        $result = $this->product_model->doEditProduct($image_url, $product_id);
        $this->updateProductGroupMapping($product_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/adminProduct/' . $store_id . '/' . $shop_section_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.', 'url' => base_url('admin/adminProduct/' . $store_id . '/' . $shop_section_id)]));
            return FALSE;
        }
    }

    public function changeProductStatus($product_id, $status) {
        $this->output->set_content_type('application/json');
        $this->product_model->changeProductStatus($product_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    // Product Sku

    public function view_product_sku($store_id, $shop_section_id, $product_id) {
        $data['title'] = 'Product';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['store_id'] = $store_id;
        $data['shop_section_id'] = $shop_section_id;
        $data['product_id'] = $product_id;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/product-sku/viewProductSku');
        $this->load->view('admin/commons/footer');
    }

    public function get_product_sku_wrapper($store_id, $shop_section_id, $product_id) {
        $this->output->set_content_type('application/json');
        $data['store_id'] = $store_id;
        $data['shop_section_id'] = $shop_section_id;
        $data['product_id'] = $product_id;
        $data['products'] = $this->product_model->getProductSkuByproductId($product_id);
        $content_wrapper = $this->load->view('admin/product-sku/product-sku-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function getFileteredMapping($product_sku_id) {
        $mappings = $this->product_model->getProductSkuGroupMappingByProductSkuId($product_sku_id);
        foreach ($mappings as $mapping) {
            $list[$mapping['group_id']] = $mapping['group_value'];
        }
        return $list;
    }

    public function add_product_sku($store_id, $shop_section_id, $product_id, $product_sku_id = null) {
        if (!empty($product_sku_id)) {
            $data['product'] = $this->product_model->getProductSkuByProductSkuId($product_sku_id);
            $data['sku_mapping'] = $this->product_model->getProductSkuGroupMappingByProductSkuId($product_sku_id);
            $data['mapping'] = $this->getFileteredMapping($product_sku_id);
        }
        $data['title'] = 'Product';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['store_id'] = $store_id;
        $data['shop_section_id'] = $shop_section_id;
        $data['product_id'] = $product_id;
        $data['specifications'] = $this->product_model->getSpecificationByProductId($product_id);
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/product-sku/addProductSku');
        $this->load->view('admin/commons/footer');
    }

    public function doAddProductSku($store_id, $shop_section_id, $product_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('sku', 'Sku', 'required|is_unique[product_sku.sku]');
        $specifications = $this->product_model->getSpecificationByProductId($product_id);
        foreach ($specifications as $spec) {
            $this->form_validation->set_rules($spec['group_name'], $spec['group_name'], 'required');
        }
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $images = $this->doUploadProductImage();
        $result = $this->product_model->doAddProductSku($product_id);
        if ($result) {
            foreach ($images as $image) {
                $this->product_model->addProductSkuImage($image, $result);
            }
            $this->doAddProductGroupMapping($result, $product_id);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/view-product-sku/' . $store_id . '/' . $shop_section_id . '/' . $product_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Product Sku did not added sucessfully.', 'url' => base_url('admin/view-product-sku/' . $store_id . '/' . $shop_section_id . '/' . $product_id)]));
            return FALSE;
        }
    }

    public function doAddProductGroupMapping($product_sku_id, $product_id) {
        $specifications = $this->product_model->getSpecificationByProductId($product_id);
        $group_id = $this->input->post('group_id');
        $i = 0;
        foreach ($specifications as $spec) {
            $group_value = $this->input->post($spec['group_name']);
            $this->product_model->doAddProductGroupMapping($group_id[$i], $group_value, $product_sku_id);
            $i++;
        }
        return 1;
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

    public function get_product_sku_image_wrapper($product_sku_id) {
        $this->output->set_content_type('application/json');
        $data['images'] = $this->product_model->getProductSkuImages($product_sku_id);
        $content_wrapper = $this->load->view('admin/product-sku/product-sku-image-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doDeleteProductSkuImage($image_id) {
        $this->output->set_content_type('application/json');
        $this->product_model->doDeleteProductSkuImage($image_id);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    public function mergeProductSkuImage($image, $product_images) {
        $count = count($image);
        foreach ($product_images as $p_image) {
            $image[++$count] = $p_image['image_url'];
        }
        return $image;
    }

    public function doEditProductSku($store_id, $shop_section_id, $product_id, $product_sku_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('sku', 'Sku', 'required');
        $specifications = $this->product_model->getSpecificationByProductId($product_id);
        foreach ($specifications as $spec) {
            $this->form_validation->set_rules($spec['group_name'], $spec['group_name'], 'required');
        }
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['tmp_name'][0])) {
            $image = $this->doUploadProductImage();
            $product_images = $this->product_model->getProductSkuImages($product_sku_id);
            $images = $this->mergeProductSkuImage($image, $product_images);
        }
        $this->product_model->doEditProductSku($product_sku_id);
        if (!empty($images)) {
            $this->product_model->deleteAllProductSkuImage($product_sku_id);
            foreach ($images as $image) {
                $this->product_model->addProductSkuImage($image, $product_sku_id);
            }
        }
        $this->doUpdateProductGroupMapping($product_id);
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Updated Sucessfully', 'url' => base_url('admin/view-product-sku/' . $store_id . '/' . $shop_section_id . '/' . $product_id)]));
        return FALSE;
    }

    public function doUpdateProductGroupMapping($product_id) {
        $specifications = $this->product_model->getSpecificationByProductId($product_id);
        $mapping_id = $this->input->post('mapping_id');
        $group_id = $this->input->post('group_id');
        $i = 0;
        foreach ($specifications as $spec) {
            $group_value = $this->input->post($spec['group_name']);
            $this->product_model->doUpdateProductGroupMapping($mapping_id[$i], $group_id[$i], $group_value);
            $i++;
        }
        return 1;
    }

    public function changeProductSkuStatus($product_sku_id, $status) {
        $this->output->set_content_type('application/json');
        $this->product_model->changeProductSkuStatus($product_sku_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
