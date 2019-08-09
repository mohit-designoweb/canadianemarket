
<?php

/**
 * Description of AdminStoreReview
 *
 * @author
 */
class AdminSubscriber extends CI_Controller {
    
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
        $data['title'] = 'Subscribe';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/subscriber/viewSubscriber');
        $this->load->view('admin/commons/footer');
    }

    public function get_subscriber_review_wrapper() {
        $this->output->set_content_type('application/json');
        $data['subscriber'] =$storeReview = $this->category_model->getSubscriber();
        
        $content_wrapper = $this->load->view('admin/subscriber/subscriber-Wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    } 
    
}
