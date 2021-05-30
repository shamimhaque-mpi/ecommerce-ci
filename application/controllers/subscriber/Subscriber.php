<?php class Subscriber extends Admin_controller{
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['meta_keyword'] = '';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';

        $where = [];
        if($_POST && is_array($_POST['search'])){
            foreach ($_POST['search'] as $key => $value) {
                if($value!=''){
                	if($key=='from')
	                    $where['date >= '] = $value;
                	else if($key=='to')
	                    $where['date <= '] = $value;
                	else
	                    $where[$key] = $value;
                }
            }
        }

        $this->data['subscriber'] = readTable('subscriber', $where);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/subscriber/subscriber', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    // Subscriber Deactive
    public function delete($id)
    {
        remove('subscriber', ['id'=>$id]);
        set_msg('success', 'Subscriber Successfully Deleted');
        redirect_back();
    }
}
