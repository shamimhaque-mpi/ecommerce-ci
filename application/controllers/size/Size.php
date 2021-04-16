<?php class Size extends Admin_controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['meta_keyword'] = '';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';
        
        $this->data['sizes'] = readTable('sizes', ['trash'=>0]);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/size/all', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function add() {
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';

        if($_POST){
    		save('sizes', $_POST);
    		set_msg('success', 'size Successfully Saved');
    		redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/size/add', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function edit($id) {
        $this->data['meta_keyword'] 	= '';
        $this->data['meta_title'] 		= '';
        $this->data['meta_description'] = '';
        $this->data['size'] 		    = readTable('sizes', ['id'=>$id])[0];
        
        if($_POST){
    		update('sizes', $_POST, ['id'=>$id]);
    		set_msg('success', 'size Successfully Updated');
    		redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/size/edit', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function trash($id){
    	update('sizes', ['trash'=>1], ['id'=>$id]);
    	set_msg('success', 'size Successfully Deleted');
    	redirect_back();
    }
}
