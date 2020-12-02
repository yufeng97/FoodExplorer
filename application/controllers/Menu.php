<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
        $dishes = $this->admin_model->get_all_dishes();
        $data = array('dishes' => $dishes, 'tab' => 'Menu', 'title' => 'Menu');
        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('footer');
    }

}