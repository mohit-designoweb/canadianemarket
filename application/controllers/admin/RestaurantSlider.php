<?php

/**
 * Description of RestaurantSlider
 *
 * @author Mohit Kant Gupta
 */
class RestaurantSlider extends CI_Controller {

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

    public function index() {
        $data['title'] = 'Slider';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
         $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-slider/viewSlider');
        $this->load->view('admin/commons/footer');
    }

    public function get_slider_wrapper() {
        $this->output->set_content_type('application/json');
        $data['sliders'] = $this->restaurant_model->getSlider();
        $content_wrapper = $this->load->view('admin/restaurant-slider/slider-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function addSlider() {
        $data['title'] = 'Slider';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
         $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/restaurant-slider/addSlider');
        $this->load->view('admin/commons/footer');
    }

    public function doAddSlider() {
        $this->output->set_content_type('application/json');
        $image_url = $this->doUploadImg();
        if (!$image_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
        $result = $this->restaurant_model->doAddSlider($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Slider added sucessfully', 'url' => base_url('admin/restaurant-slider')]));
            return FALSE;
        }
    }

    public function doUploadImg() {
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

    public function doDeleteSlider($id) {
        $this->output->set_content_type('application/json');
        $result = $this->restaurant_model->doDeleteSlider($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Slider Deleted sucessfully', 'url' => base_url('admin/restaurant-slider')]));
            return FALSE;
        }
    }

    public function changeSliderStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->restaurant_model->changeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

}
