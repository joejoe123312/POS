<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    function index()
    {
        //form validation
        $postForm['username'] = "Username";
        $postForm['password'] = "Password";
        $postForm['fullname'] = "Full Name";
        $postForm['email'] = "Email";
        $postForm['mobileNumber'] = "Mobile Number";
        if ($this->Main_model->formValidation($postForm)) {

            //insert into credentials
            $cred['username'] = $this->input->post('username');
            $cred['password'] = $this->Main_model->passwordEncryptor($this->input->post('password'));
            $cred['user_type'] = 1;
            $credentialsId = $this->Main_model->_insert('credentials', $cred);

            //insert into users
            $users['fullname'] = $this->input->post('fullname');
            $users['mobile_number'] = $this->input->post('mobileNumber');
            $users['email'] = $this->input->post('email');
            $users['credentials_id'] = $credentialsId;
            $this->Main_model->_insert('users', $users);

            //notify and redirect
            $this->Main_model->notifyAndRedirect('registerSuccess', 'Login');
        }
        $this->load->view('authentication/auth_header');
        $this->load->view('authentication/register');
        $this->load->view('authentication/auth_footer');
    }
}
