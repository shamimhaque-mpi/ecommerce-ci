<?php
class Stock extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->data['allProducts'] = get_join('stock', 'products', 'stock.product_id=products.id', [], 'products.title, products.id');

        $where = [];
        if(!empty($_POST['search'])){
            foreach ($_POST['search'] as $key => $value) {
                if($value!=''){
                    $where['products.'.$key] = $value;
                }
            }

        }

        /*//*/
        $this->data['brands']        = readTable('brands', ['trash'=>0]);
        $this->data['categories']    = readTable('categories', ['trash'=>0]);
        $this->data['subcategories'] = readTable('subcategories', ['trash'=>0]);
        /*//*/

        $tableTo  = ['products', 'brands', 'categories', 'subcategories'];

        $join_cod = ['stock.product_id=products.id', 'products.brand_id=brands.id', 'products.cat_id=categories.id', 'products.sub_cat_id=subcategories.id'];

        $select   = ['stock.*', 'products.title', 'brands.brand', 'categories.category', 'subcategories.subcategory'];

        $this->data['stock'] = get_left_join('stock', $tableTo, $join_cod, $where, $select);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/stock/stock', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

}
