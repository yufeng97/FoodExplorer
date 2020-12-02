<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index($tab = 'dashboard', $message = null) {
        $restaurants = $this->admin_model->get_all_restaurants();
        $dishes = $this->admin_model->fetch_all_dishes();
        $data = array(
            'restaurants' => $restaurants,
            'tab' => $tab,
            'message' => $message,
            'dishes' => $dishes
        );
        $this->load->view('admin', $data);
    }

    public function add_dish() {
        if ($this->input->post('item_name')) {
            $restaurant_id = $this->input->post('restaurant_id');
            $name = $this->input->post('item_name');
            $category = $this->input->post('category');
            $price = $this->input->post('price');
            $description = $this->input->post('description');
            $prefix = 'upload_';
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $prefix . uniqid();
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
                return false;
            } else {
                $img_path = $this->upload->data('file_name');
            }
            $this->admin_model->add_dish($restaurant_id, $name, $category, $price, $description, $img_path);
            $this->index('add_dish', 'Add Dish Successfully');
        } else {
            $this->index('add_dish');
        }
        
    }

    public function add_restaurant() {
        if ($this->input->post('restaurant_name')) {
            $name = $this->input->post('restaurant_name');
            $description = $this->input->post('description');
            $location = $this->input->post('location');
            $prefix = 'upload_';
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $prefix . uniqid();
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $this->upload->display_errors();
                return false;
            } else {
                $img_path = $this->upload->data('file_name');
            }
            $this->admin_model->add_restaurant($name, $description, $location, $img_path);
            $this->index('add_restaurant', 'Add Restaurant Successfully');
        } else {
            $this->index('add_restaurant');
        }
    }

    public function remove_dish() {
        if ($this->uri->segment(3)) {
            $id = $this->uri->segment(3);
            $this->admin_model->remove_dish($id);
            $this->index('manage_dishes', 'Remove Dish Successfully');
        } else {
            $this->index('manage_dishes');
        }
    }

}