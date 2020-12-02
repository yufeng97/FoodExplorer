<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index($message = null) {
        if (isset($_SESSION["email"])) {
            redirect(base_url() . 'Home');
        }
        if (isset($_COOKIE['email']) && isset($_COOKIE['token'])) {
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];
            $this->auto_login($email, $token);
        }
        $data = array('tab' => 'Login', 'title' => 'Log in', 'message' => $message);
        $this->load->view('header', $data);
        $this->load->view('login');
        $this->load->view('footer');
    }

    public function login_validation() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        if ($this->user_model->check_login($email, $password)) {
            if (isset($remember)) {
                setcookie("email", $email, time() + 60 * 60 * 2, "/");
                $_COOKIE["email"] = $email;
                $token = $this->user_model->get_user_profile['token'];
                setcookie('token', $token, time() + 60 * 60 * 2, '/');
                $_COOKIE['token'] = $token;
            } else {
                setcookie("email", null, -1, "/");
                setcookie('token', null, -1, '/');
            }
            $_SESSION['email'] = $email;
            redirect(base_url() . 'Home');
        } else {
            $this->session->set_flashdata('error', 'Invalid Username and Password');
            redirect(base_url() . 'Login');
        }
    }

    private function auto_login($email, $token) {
        if ($this->user_model->auto_login($email, $token)) {
            $_SESSION['email'] = $email;
            redirect(base_url() . 'Home');
        }
    }

    public function forgot_password() {
        $email = $this->input->post('email');
        $data = array(
            'success' => null,
            'error' => null,
            'tab' => 'Login',
            'title' => 'Forgot Password'
        );
        $this->load->view('header', $data);
        if ($email) {
            if (!$this->user_model->is_email_available($email)) {
                $key = md5(uniqid());
                $this->user_model->update_reset_key($email, $key);
                if ($this->send_reset_message($email, $key)) {
                    $data['success'] = true;
                    $this->load->view('reset_password_email', $data);
                } else {
                    $data['error'] = 'Cannot sent Email to your E-mail address. Please contact admin to get help.';
                    $this->load->view('reset_password_email', $data);
                }
            } else {
                $data['error'] = 'Invalid Email address';
                $this->load->view('reset_password_email', $data);
            }
        } else {
            $this->load->view('reset_password_email');
        }
        $this->load->view('footer');
    }

    private function send_reset_message($email, $reset_key) {
        $subject = 'Reset your password';
        $message = "Hi " . $email . "\r\n\r\n";
        $message .= "Please click the link below to change your password\r\n\r\n";
        $message .= base_url() . 'Login/reset_password/' . $reset_key;
        $message .= "\r\n\r\nThank you.\r\n\r\nFood Explorer";
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,
            'smtp_crypto' => 'tls',
            'mailtype' => 'text',
            'validate' => FALSE,
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'newline' => '\r\n'
        );
        $this->load->library('email', $config);
        $this->email->from('yufeng.liu1@uq.net.au', 'Food Explorer');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    public function reset_password() {
        $reset_key = $this->uri->segment(3);
        if ($this->user_model->verify_reset_key($reset_key)) {
            $data = array('tab' => 'Login', 'title' => 'Reset Password');
            $this->load->view('header', $data);
            $this->load->view('reset_password');
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function change_password() {
        $reset_key = $this->input->post('reset_key');
        $password = $this->input->post('password');
        if ($reset_key && $password) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $this->user_model->change_password($reset_key, $password_hash);
            $message =  'You have reset your password successfully';
            $this->index($message);
        } else {
            show_404();
        }
    }

}