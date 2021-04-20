<?php
class Stock extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->data['allProducts'] = get_join('stock', 'products', 'stock.product_id=products.id', [], 'products.title, products.id');

        $where = [];
        if(!empty($_POST['product_id'])){
            $where['stock.product_id'] = $_POST['product_id'];

        }

        $this->data['stock'] = get_join('stock', 'products', 'stock.product_id=products.id', $where, 'stock.*, products.title');

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/stock/stock', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

}
