<?php

class User_model extends CI_Model {

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        // SELECT * FROM users WHERE email = '$email';
        if ($query->num_rows() > 0) {
            $password_hash = $query->row_array()['password'];
            if (password_verify($password, $password_hash)) {
                return true;
            }
        }
        return false;
    }

    public function auto_login($email, $token) {
        $this->db->where('email', $email);
        $this->db->where('token', $token);
        $query = $this->db->get('users');
        // SELECT * FROM users
        // WHERE email = '$email'
        // AND token = '$token'
        if ($query->num_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function create_account($email, $username, $password, $token, $verification_key) {
        $data = array(
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'token' => $token,
            'verificationKey' => $verification_key
        );
        $this->db->insert('users', $data);
        // INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')
        return $this->db->insert_id();
    }

    public function is_email_available($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function is_username_available($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function update_username($email, $username) {
        $data = array('username' => $username);
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        // UPDATE mytable
        // SET username = '$username'
        // WHERE email = $email
    }

    public function update_profile($email, $fullname, $mobile_phone, $position, $address) {
        $data = array(
            'fullname' => $fullname,
            'mobile_phone' => $mobile_phone,
            'position' => $position,
            'address' => $address
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        // UPDATE mytable
        // SET fullname = '$fullname', mobile_phone = '$mobile_phone', position = '$position'
        // WHERE email = $email
    }

    public function get_user_profile($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function verify_email($key) {
        $this->db->where('verificationKey', $key);
        $this->db->where('is_email_verified', '0');
        $query = $this->db->get('users');
        if ($query->num_rows()) {
            $data = array('is_email_verified' => '1');
            $this->db->where('verificationKey', $key);
            $this->db->update('users', $data);
            return true;
        } else {
            return false;
        }
    }

    public function upload_image($imgPath) {
        $this->db->where('email', $_SESSION['email']);
        $data = array('imgPath' => $imgPath);
        $this->db->update('users', $data);
    }

    public function update_reset_key($email, $key) {
        $this->db->set('reset_key', $key);
        $this->db->set('is_reset_key_used', null);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function verify_reset_key($key) {
        $this->db->where('reset_key', $key);
        $this->db->where('is_reset_key_used', '0');
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function change_password($reset_key, $password) {
        $this->db->set('password', $password);
        $this->db->set('is_reset_key_used', '1');
        $this->db->where('reset_key', $reset_key);
        $this->db->update('users');
    }
}
