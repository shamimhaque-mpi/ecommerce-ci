<?php class Color extends Admin_controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['meta_keyword'] = '';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';
        
        $this->data['colors'] = readTable('colors', ['trash'=>0]);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/color/all', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function add() {
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';

        if($_POST){
    		save('colors', $_POST);
    		set_msg('success', 'color Successfully Saved');
    		redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/color/add', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function edit($id) {
        $this->data['meta_keyword'] 	= '';
        $this->data['meta_title'] 		= '';
        $this->data['meta_description'] = '';
        $this->data['color'] 		    = readTable('colors', ['id'=>$id])[0];
        
        if($_POST){
    		update('colors', $_POST, ['id'=>$id]);
    		set_msg('success', 'color Successfully Updated');
    		redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/color/edit', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function trash($id){
    	update('colors', ['trash'=>1], ['id'=>$id]);
    	set_msg('success', 'color Successfully Deleted');
    	redirect_back();
    }
}
