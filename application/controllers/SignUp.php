<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {
        if (isset($_SESSION["email"])) {
            redirect(base_url() . 'Home');
        }
        $data = array('tab' => 'SignUp', 'title' => 'Sign Up');
        $this->load->view('header', $data);
        $this->load->view('signup');
        $this->load->view('footer');
    }

    public function register() {
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $verification_key = md5(rand());
        $token = uniqid();
        $this->user_model->create_account($email, $username, $password_hash, $token, $verification_key);
        $this->send_verification_message($email, $verification_key);
        $_SESSION['email'] = $email;
        redirect(base_url() . 'Home');
    }

    public function check_ID_availability() {
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        if (isset($email)) {
            if ($this->user_model->is_email_available($email)) {
                echo TRUE;
            } else {
                echo FALSE;
            }
        } elseif (isset($username)) {
            if ($this->user_model->is_username_available($username)) {
                echo TRUE;
            } else {
                echo FALSE;
            }
        }
    }

    private function send_verification_message($email, $verification_key) {
        $subject = 'Please verify email for login';
        $message = "Hi " . $email . "\r\n\r\n";
        $message .= "This is email verification mail from Food Explorer. For completing registration process and starting your journey.\r\n";
        $message .= "First you need to verify your email by click link bellow.\r\n";
        $message .= base_url() . "SignUp/verify_email/" . $verification_key . "\r\n\r\n";
        $message .= "Once you click this link your email will be verified and you can enjoy your food adventure.\r\n\r\n";
        $message .= "Thank you.\r\n\r\nFood Explorer";
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
        $this->email->send();
        // $this->email->print_debugger();
    }

    public function verify_email() {
        if ($this->uri->segment(3)) {
            $verification_key = $this->uri->segment(3);
            if ($this->user_model->verify_email($verification_key)) {
                $data['message'] = "Your Email has been successfully verified, now you can back to Food Explorer from <a href='" . base_url() . "Home'>here</a>";
            } else {
                $data['message'] = "Invalid Link";
            }
            $this->load->view('email_verification', $data);
        }
    }

}