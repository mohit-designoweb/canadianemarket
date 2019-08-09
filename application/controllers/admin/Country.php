<?php

/**
 * Description of Courier_module
 *
 * @author Rajesh kumar yadav
 * @modified by Mohit kant Gupta
 */
class Country extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model', 'Country_model']);
        if (empty($this->session->userdata('email_admin'))) {
            redirect(base_url('admin'));
        }
    }

    public function getUserData() {
        $email = $this->session->userdata('email_admin');
        return $this->admin_model->getUserdata('admin', $email);
    }

    public function index($country_id = null) {
        if (!empty($country_id)) {
            $data['country'] = $this->Country_model->getCountryById($country_id);
        }
        $data['title'] = 'Country';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/country/viewCountry');
        $this->load->view('admin/commons/footer');
    }

    public function get_country_wrapper() {
        $this->output->set_content_type('application/json');
        $data['countries'] = $this->Country_model->getCountry();
        $content_wrapper = $this->load->view('admin/country/country-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddCountry() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'Country name already added');
        $this->form_validation->set_rules('country_name', 'Country Name', 'required|is_unique[country.country_name]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Country_model->doAddCountry();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Partner added sucessfully', 'url' => base_url('admin/country')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Partner did not added sucessfully.']));
            return FALSE;
        }
    }

    function doUploadImg() {
        $config = array(
            'upload_path' => "./uploads/country",
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

    public function doEditCountry($country_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('country_name', 'Country Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Country_model->doEditCountry($country_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Details Updated Sucessfully', 'url' => base_url('admin/country')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made', 'url' => base_url('admin/country')]));
            return FALSE;
        }
    }

    public function doDeleteCountry($id) {
        $this->output->set_content_type('application/json');
        $result = $this->Country_model->doDeleteCountry($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/country')]));
        }
    }

    public function changeCountryStatus($id, $status) {
        $this->output->set_content_type('application/json');
        $this->Country_model->changeStatus($id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    // City Module

    private function getFilterCountry() {
        $list = ['' => 'Select the Country'];
        $countries = $this->Country_model->getCountry();
        foreach ($countries as $country) {
            $list[$country['country_id']] = $country['country_name'];
        }
        return $list;
    }

    public function city($city_id = null) {
        if (!empty($city_id)) {
            $data['city'] = $this->Country_model->getCitiesById($city_id);
        }
        $data['title'] = 'City';
        $data['table'] = '1';
        $data['user'] = $this->getUserData();
        $data['country'] = $this->getFilterCountry();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/commons/admin-sidebar', $data);
        $this->load->view('admin/cities/cities');
        $this->load->view('admin/commons/footer');
    }

    public function cities_wrapper() {
        $this->output->set_content_type('application/json');
        $data['cities'] = $this->Country_model->getAllCity();
        $content_wrapper = $this->load->view('admin/cities/cities-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function doAddCities() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'City name already added');
        $this->form_validation->set_rules('city_name', 'City Name', 'required|is_unique[city.city_name]');
        $this->form_validation->set_rules('country_id', 'Country Name', 'required');
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
        $result = $this->Country_model->doAddCity($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Detail Added Sucessfully', 'url' => base_url('admin/city')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'City did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditCities($city_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('city_name', 'City Name', 'required');
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
            $city = $this->country_model->getCitiesById($city_id);
            $image_url = $city['image_url'];
        }
        $result = $this->Country_model->doEditCities($city_id,$image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Cities Updated Sucessfully', 'url' => base_url('admin/city')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Cities category not updated.', 'url' => base_url('admin/city')]));
            return FALSE;
        }
    }

    public function changeCitiesStatus($cities_id, $status) {
        $this->output->set_content_type('application/json');
        $this->Country_model->changeCitiesStatus($cities_id, $status);
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }

    //// Cities...............
}
