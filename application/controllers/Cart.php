<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model');
        if (!isset($_SESSION['email'])) {
            redirect(base_url() . 'Login');
        }
    }

    public function index($message = null) {
        $cart = $this->cart_model->fetch_by_user($_SESSION['email']);
        $data = array('tab' => 'Cart', 'title' => 'Cart', 'cart' => $cart, 'message' => $message);
        $this->load->view('header', $data);
        $this->load->view('cart', $data);
        $this->load->view('footer');
    }

    public function add_item() {
        $dish_id = $this->input->post('dish_id');
        if ($dish_id) {
            $user_id = $this->cart_model->get_user_id($_SESSION['email']);
            $record = $this->cart_model->get_record($user_id, $dish_id);
            if ($record) {
                $quantity = $this->cart_model->get_record($user_id, $dish_id)['quantity'];
                ++$quantity;
                $id = $record['id'];
                $this->cart_model->update_record($id, $quantity);
            } else {
                $quantity = 1;
                $this->cart_model->add_record($user_id, $dish_id, $quantity);
            }
            echo true;
        }
        
    }

    public function remove_item() {
        $id = $this->uri->segment(3);
        $this->cart_model->remove_record($id);
        $message = 'Item removed from Cart';
        $this->index($message);
    }

    public function remove_all_items() {
        $user_id = $this->cart_model->get_user_id($_SESSION['email']);
        $this->cart_model->remove_all_records($user_id);
        $message = 'Item removed from Cart';
        $this->index($message);
    }

    public function checkout() {
        $this->load->model('user_model');
        $this->user_model->get_user_profile($_SESSION['email']);
        $this->load->library('Pdf');
        $this->pdf->loadHtml($this->order());
        $this->pdf->render();
        $this->pdf->setBasePath(base_url().'css/components/container.min.css');
        $this->pdf->setBasePath(base_url().'css/components/table.min.css');
        $this->pdf->stream('order_detail.pdf', array('Attachment' => 0));
    }

    private function order() {
        $email = $_SESSION['email'];
        $this->load->model('user_model');
        $data = $this->user_model->get_user_profile($email);
        $order = uniqid();
        $data['order_number'] = $order;
        $date = new DateTime('now', new DateTimeZone('Australia/Brisbane'));
        $data['create_time'] = $date->format('Y-m-d H:i:s');
        $cart = $this->cart_model->fetch_by_user($_SESSION['email']);
        $data['cart'] = $cart;
        $this->pay($order, $data['create_time']);
        return $this->load->view('order_details', $data, true);
    }

    private function pay($order_number, $create_time) {
        $cart = $this->cart_model->fetch_by_user($_SESSION['email']);
        $user_id = $this->cart_model->get_user_id($_SESSION['email']);
        foreach ($cart as $row) {
            $this->cart_model->add_to_paid_orders($order_number, $user_id, $row['dish_id'], $row['quantity'], $create_time);
        }
        $this->cart_model->remove_all_records($user_id);
    }
    
}