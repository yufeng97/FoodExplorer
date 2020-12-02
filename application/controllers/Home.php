<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
        $this->load->library('session');
        // $tabs = page('Home', true);
        // $data['tabs'] = $tabs;
        $data = array('tab' => 'Home', 'title' => 'Homepage');
        $this->load->view('header', $data);
        $this->load->view('home');  
        $this->load->view('footer');
    }

    function autocompleteData() {
        $data = array();
        $name = $this->input->get('name');
        $restaurants = $this->admin_model->similar_restaurants($name);
        $dishes = $this->admin_model->similar_dishes($name);
        foreach ($restaurants as $restaurant) {
            $temp['name'] = $restaurant['name'];
            $temp['id'] = $restaurant['id'];
            $temp['type'] = 'restaurant';
            $temp['url'] = base_url() . 'Shop/visit/' . $restaurant['id'];
            array_push($data, $temp);
        }
        foreach ($dishes as $dish) {
            $temp['name'] = $dish['name'];
            $temp['id'] = $dish['restaurant_id'];
            $temp['type'] = 'dish';
            $temp['url'] = base_url() . 'Shop/visit/' . $dish['id'];
            array_push($data, $temp);
        }
        $output = '';
        foreach ($data as $row) {
            $output .= '<a class="item" href="'.base_url().'Shop/visit/?id='.$row['id'].'"><div class="right floated content">'.$row['type'].'</div><span class="content">'.$row['name'].'</span></a>';
        }
        echo $output;
    }

}