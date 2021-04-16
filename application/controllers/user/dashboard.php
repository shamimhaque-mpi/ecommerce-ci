<?php
class Dashboard extends Admin_controller{

    function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'dashboard';
        $this->data['active'] = 'data-target="dashboard"';
        $this->data['subMenu'] = 'data-target=""';

        $this->load->view('user/includes/header', $this->data);
        $this->load->view('user/includes/aside', $this->data);
        $this->load->view('user/includes/headermenu', $this->data);
        $this->load->view('user/dashboard', $this->data);
        $this->load->view('user/includes/footer');
    }

    private function holder(){
        if($this->uri->segment(1) != $this->session->userdata('holder')){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
