
<?php

/**
 * Description of AdminStoreReview
 *
 * @author
 */
class AdminStoreReview extends CI_Controller {

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
    public function index() {
        $data['title'] = 'StoreReview';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/Review/viewStoreReview');
        $this->load->view('admin/commons/footer');
    }

    public function get_store_review_wrapper() {
        $this->output->set_content_type('application/json');
        $data['storeReview'] =$storeReview = $this->category_model->getStoreReview();
       
        
        $content_wrapper = $this->load->view('admin/Review/storeReview-Wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    } 
    
    public function changeStoreReviewStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->category_model->changeStoreReviewStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
}
