<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        if (!isset($_SESSION['email'])) {
            redirect(base_url() . 'Home');
        }
    }

    public function index() {
        $data = $this->user_model->get_user_profile($_SESSION['email']);
        $data['order_history'] = $this->order_history();
        $data['tab'] = 'User';
        $data['title'] = 'Personal Page';
        $this->load->view('header', $data);
        $this->load->view('personal_page', $data);
        $this->load->view('footer');
    }

    public function change_username() {
        $username = $this->input->post('username');
        if ($username) {
            $this->user_model->update_username($_SESSION['email'], $username);
            redirect(base_url() . 'User');
        }
    }

    public function update_profile() {
        $fullname = $this->input->post('fullname');
        $mobile_phone = $this->input->post('mobile_phone');
        $position = $this->input->post('position');
        $address = $this->input->post('address');
        $this->user_model->update_profile($_SESSION['email'], $fullname, $mobile_phone, $position, $address);
        redirect(base_url() . 'User');
    }

    public function logout() {
        session_destroy();
        redirect(base_url() . 'Home');
    }

    public function ajax_upload() {
        $prefix = 'upload_';
        $date = new DateTime('now', new DateTimeZone('Australia/Brisbane'));
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $prefix . $date->format('YmdHis');
        $this->load->library('upload', $config);
        // if directory does not exist, create it
        if (!file_exists($config['upload_path']) || !is_dir($config['upload_path'])) {
            return mkdir($config['upload_path'], 0777, true);
        }
        // check file is writeable
        if (!is_writable($config['upload_path'])) {
            return chmod($config['upload_path'], 0777);
        }
        if (!$this->upload->do_upload('file')) {
            $this->upload->display_errors();
            echo FALSE;
        } else {
            $imgPath = $config['upload_path'] . $this->upload->data('file_name');
            $this->user_model->upload_image($imgPath);
            echo $imgPath;
        }
    }

    private function order_history() {
        $this->load->model('cart_model');
        $user_id = $this->cart_model->get_user_id($_SESSION['email']);
        $rows = $this->cart_model->fetch_order_history($user_id);
        $orders = array();
        foreach($rows as $row) {
            if (array_key_exists($row['order_number'], $orders)) {
                array_push($orders[$row['order_number']], $row);
            } else {
                $orders[$row['order_number']] = array();
                array_push($orders[$row['order_number']], $row);
            }
        }
        return $orders;
    }

    public function view_order() {
        $order_number = $this->input->get('number');
        $this->load->model('cart_model');
        $data = $this->user_model->get_user_profile($_SESSION['email']);
        $data['cart'] = $this->cart_model->fetch_by_order_number($order_number);
        $data['order_number'] = $order_number;
        $data['create_time'] = $data['cart'][0]['create_time'];
        $this->load->library('Pdf');
        $view = $this->load->view('order_details', $data, true);
        $this->pdf->loadHtml($view);
        $this->pdf->render();
        $this->pdf->setBasePath(base_url().'css/components/container.min.css');
        $this->pdf->setBasePath(base_url().'css/components/table.min.css');
        $this->pdf->stream('order_detail.pdf', array('Attachment' => 0));
    }

    public function get_user_details() {
        $data = $this->user_model->get_user_profile($_SESSION['email']);
        echo json_encode($data);
    }
    
}