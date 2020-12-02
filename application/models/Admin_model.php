<?php

class Admin_model extends CI_Model {
    
    public function add_restaurant($name, $description, $location, $img_path=null) {
        $data = array(
            'name' => $name,
            'description' => $description,
            'location' => $location,
            'img_path' => $img_path
        );
        $this->db->insert('restaurants', $data);
        return $this->db->insert_id();
    }

    public function add_dish($restaurant_id, $name, $category, $price, $description, $img_path=null) {
        $data = array(
            'restaurant_id' => $restaurant_id,
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'price' => $price,
            'img_path' => $img_path
        );
        $this->db->insert('dishes', $data);
        return $this->db->insert_id();
    }

    public function get_all_restaurants() {
        $query = $this->db->get('restaurants');
        return $query->result_array();
    }

    public function get_all_dishes() {
        $query = $this->db->get('dishes');
        return $query->result_array();
    }

    public function get_restaurant_menu($restaurant_id) {
        $this->db->where('restaurant_id', $restaurant_id);
        $query = $this->db->get('dishes');
        return $query->result_array();
    }

    public function get_restaurant($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('restaurants');
        return $query->row_array();
    }

    public function similar_restaurants($name) {
        $this->db->like('name', $name, 'both');
        $query = $this->db->get('restaurants');
        return $query->result_array();
    }

    public function similar_dishes($name) {
        $this->db->like('name', $name, 'both');
        $query = $this->db->get('dishes');
        return $query->result_array();
    }

    public function fetch_all_dishes() {
        $this->db->select('dishes.id AS "dish_id", dishes.name as "dish_name", restaurants.name as "restaurant_name", price, category, dishes.img_path AS "dish_img"');
        $this->db->join('restaurants', 'restaurants.id = dishes.restaurant_id');
        $query = $this->db->get('dishes');
        return $query->result_array();
    }

    public function remove_dish($id) {
        $this->db->where('id', $id);
        $this->db->delete('dishes');
    }

}