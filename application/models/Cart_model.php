<?php

class Cart_model extends CI_Model {

    public function fetch_by_user($email) {
        $user_id = $this->cart_model->get_user_id($email);
        $this->db->select('cart_items.id AS "cart_id", cart_items.dish_id AS "dish_id", dishes.name AS "dish_name", dishes.img_path AS "img_path", quantity, price, restaurants.name AS "restaurant_name"');
        $this->db->join('dishes', 'dishes.id = cart_items.dish_id');
        $this->db->join('restaurants', 'restaurants.id = dishes.restaurant_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('cart_items');
        return $query->result_array();
    }

    public function get_user_id($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array()['id'];
    }

    public function get_record($user_id, $dish_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('dish_id', $dish_id);
        $query = $this->db->get('cart_items');
        return $query->row_array();
    }

    public function add_record($user_id, $dish_id, $quantity) {
        $data = array(
            'user_id' => $user_id,
            'dish_id' => $dish_id,
            'quantity' => $quantity
        );
        $this->db->insert('cart_items', $data);
        return $this->db->insert_id();
    }

    public function update_record($id, $quantity) {
        $this->db->set('quantity', $quantity);
        $this->db->where('id', $id);
        $this->db->update('cart_items');
    }

    public function remove_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('cart_items');
    }

    public function remove_all_records($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('cart_items');
    }

    public function add_to_paid_orders($order_number, $user_id, $dish_id, $quantity, $create_time) {
        $data = array(
            'order_number' => $order_number,
            'user_id' => $user_id,
            'dish_id' => $dish_id,
            'quantity' => $quantity,
            'create_time' => $create_time
        );
        $this->db->insert('orders', $data);
    }

    public function fetch_order_history($user_id) {
        $this->db->select('order_number, orders.dish_id AS "dish_id", dishes.name AS "dish_name", dishes.img_path AS "img_path", quantity, price, restaurants.name AS "restaurant_name", create_time');
        $this->db->join('dishes', 'dishes.id = orders.dish_id');
        $this->db->join('restaurants', 'restaurants.id = dishes.restaurant_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('orders');
        return $query->result_array();
    }

    public function fetch_by_order_number($order_number) {
        $this->db->select('order_number, orders.dish_id AS "dish_id", dishes.name AS "dish_name", dishes.img_path AS "img_path", quantity, price, restaurants.name AS "restaurant_name", create_time');
        $this->db->join('dishes', 'dishes.id = orders.dish_id');
        $this->db->join('restaurants', 'restaurants.id = dishes.restaurant_id');
        $this->db->where('order_number', $order_number);
        $query = $this->db->get('orders');
        return $query->result_array();
    }
}