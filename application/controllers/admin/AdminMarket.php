<?php

/**
 * Description of AdminMarket
 *
 * @author Manish Khandelwal
 */
class AdminMarket extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'market_place_model']);
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
        $partners = $this->market_place_model->getActivePartner();
        foreach ($partners as $partner) {
            $list[$partner['partner_id']] = $partner['first_name'] . ' ' . $partner['last_name'];
        }
        return $list;
    }

    private function getFilteredCategories() {
        $list = ['' => '--Select The Category--'];
        $categories = $this->market_place_model->getAllActiveMarketPlaceCategory();
        foreach ($categories as $category) {
            $list[$category['market_place_category_id']] = $category['category_name'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Market Place Product';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/market-product/view-product');
        $this->load->view('admin/commons/footer');
    }

    public function get_market_place_product_wrapper() {
        $this->output->set_content_type('application/json');
        $data['products'] = $this->market_place_model->getAllProduct();
        $content_wrapper = $this->load->view('admin/market-product/product-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addProduct($id = null) {
        if (!empty($id)) {
            $data['product'] = $this->market_place_model->getProductById($id);
        }
        $data['user'] = $this->getUserData();
        $data['title'] = 'Market Place Product';
        $data['partners'] = $this->filteredPartner();
        $data['category'] = $this->getFilteredCategories();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/market-product/add-product');
        $this->load->view('admin/commons/footer');
    }

    public function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/market-product",
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

    public function doAddProduct() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('market_place_category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
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
        $result = $this->market_place_model->doAddProduct($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/adminMarket')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Restaurant did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditProduct($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('market_place_category_id', 'Category', 'required');
        $this->form_validation->set_rules('partner_id', 'Partner', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
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
            $product = $this->market_place_model->getProductById($id);
            $image_url = $product['image_url'];
        }
        $result = $this->market_place_model->doEditProduct($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail updated sucessfully', 'url' => base_url('admin/adminMarket')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes Were Made.']));
            return FALSE;
        }
    }

    public function changeProductStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $result = $this->market_place_model->changeProductStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
