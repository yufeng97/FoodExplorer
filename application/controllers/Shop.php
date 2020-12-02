<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
        $restaurants = $this->admin_model->get_all_restaurants();
        $data = array('restaurants' => $restaurants, 'tab' => 'Shop', 'title' => 'Shop');
        $this->load->view('header', $data);
        $this->load->view('shop', $data);
        $this->load->view('footer');
    }

    public function visit() {
        $id = $this->input->get('id');
        $restaurant = $this->admin_model->get_restaurant($id);
        $dishes = $this->admin_model->get_restaurant_menu($id);
        $data = array(
            'tab' => 'Shop',
            'restaurant' => $restaurant,
            'dishes' => $dishes,
            'title' => $restaurant['name']
        );
        $this->load->view('header', $data);
        $this->load->view('restaurant', $data);
        $this->load->view('footer');
    }
    
}