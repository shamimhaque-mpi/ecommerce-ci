<?php class Brand extends Admin_controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['meta_keyword'] = '';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';

        $where = ['trash'=>0];
        if($_POST && !empty($_POST['brand_id'])){
            $where['id'] = $_POST['brand_id'];
        }

        $this->data['brands']     = readTable('brands', $where);
        $this->data['all_brands'] = readTable('brands',['trash'=>0]);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/brand/all', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function add() {
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';

        if($_POST){
    		save('brands', $_POST);
    		set_msg('success', 'brand Successfully Saved');
    		redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/brand/add', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function edit($id) {
        $this->data['meta_keyword'] 	= '';
        $this->data['meta_title'] 		= '';
        $this->data['meta_description'] = '';
        $this->data['brand'] 		    = readTable('brands', ['id'=>$id])[0];
        
        if($_POST){
    		update('brands', $_POST, ['id'=>$id]);
    		set_msg('success', 'brand Successfully Updated');
    		redirect_back();
        }

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/brand/edit', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function trash($id){
    	update('brands', ['trash'=>1], ['id'=>$id]);
    	set_msg('success', 'brand Successfully Deleted');
    	redirect_back();
    }
}
