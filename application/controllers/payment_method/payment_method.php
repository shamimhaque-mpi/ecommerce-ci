<?php class Payment_method extends Admin_controller{
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';

        $this->data['methods'] = readTable('payment_method', ['trash'=>0]);

        if($_POST){
            save('payment_method', $_POST);
            set_msg('success', 'Successfully Saved');
            redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/payment_method/payment_method', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }
}
