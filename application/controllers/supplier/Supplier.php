<?php
class Supplier extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['suppliers'] = readTable('suppliers', ['trash'=>0]);
        
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/supplier/all', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function add()
    {
        if($_POST){
            $data = $_POST;
            $data['initial_balance'] = ($_POST['type']=="payable"? $_POST['initial_balance'] : (0-$_POST['initial_balance']));
            $data['date'] = date('Y-m-d');
            save('suppliers', $data);
            set_msg('success', 'Supplier Data Successfully Saved');
            redirect('supplier/supplier?system_id=NjRfMTI0', 'refresh');
        }
        
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/supplier/add', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function edit($id)
    {
        $this->data['edit'] = readTable('suppliers', ['id'=>$id])[0];
        if($_POST){
            $data = $_POST;
            $data['initial_balance'] = ($_POST['type']=="payable"? $_POST['initial_balance'] : (0-$_POST['initial_balance']));
            update('suppliers', $data, ['id'=>$id]);
            set_msg('success', 'Supplier Data Successfully Saved');
            redirect('supplier/supplier?system_id=NjRfMTI0', 'refresh');
        }
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/supplier/edit', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

}
