<?php class Dashboard extends Admin_controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['meta_title'] = 'dashboard';
        $this->data['active'] = 'data-target="dashboard"';
        $this->data['subMenu'] = 'data-target=""';
        
        $this->data['total_user'] = count(readTable('subscribers'));
        // 
        $this->data['total_feature_product'] = count(readTable('products', ['feature_product'=>'yes']));
        // 
        $this->data['total_product']  = count(readTable('products'));
        // 
        $this->data['total_sold_out'] = count(readTable('stock', ['quantity <= '=>0]));
        //
        $this->data['total_order'] = count(readTable('orders'));
        //
        $this->data['today_total_order'] = count(readTable('orders', ['date'=>date('Y-m-d')]));
        //
        $this->data['total_pending_order'] = count(readTable('orders', ['status'=>'pending']));
        //
        $this->data['total_delivered_order'] = count(readTable('orders', ['status'=>'shipped']));
        // Fetcing Today's Sale Amount
        $total_sale = $this->db->query("
            SELECT 
                SUM(
                    (order_items.price * order_items.quantity) - ((order_items.price * order_items.quantity)/100)*order_items.discount

                ) as total_sale
            FROM
                order_items
            JOIN 
                orders ON orders.id=order_items.order_id

        ")->result();

        $this->data['total_sale'] = ($total_sale ? $total_sale[0]->total_sale : 0);
        
        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/dashboard', $this->data);
        $this->load->view('admin/includes/footer');
    }
}
