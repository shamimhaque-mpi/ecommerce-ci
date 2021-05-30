<?php class Order extends Admin_controller{
    function __construct() {
        parent::__construct();
    }

    public function all() {
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';

        $this->data['users'] = readTable('subscribers');

        $where = ['orders.status!'=>'shipped'];
        if($_POST){
            foreach ($_POST['search'] as $key => $value) {
                if($value!=''){
                    $where[$key] = $value;
                }
            }
        }

        $this->data['orders'] = $this->allOrders($where);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/order/all_order', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function complete() {
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';
        

        $this->data['users'] = readTable('subscribers');

        $where = ['orders.status'=>'shipped'];
        if($_POST){
            foreach ($_POST['search'] as $key => $value) {
                if($value!=''){
                    $where[$key] = $value;
                }
            }
        }
        
        $this->data['orders'] = $this->allOrders($where);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/order/completed_order', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }


    // VIEW ORDER DATA
    public function view($order_id){
        $this->data['meta_keyword']     = '';
        $this->data['meta_title']       = '';
        $this->data['meta_description'] = '';

        $this->data['order'] = $this->getVoucher(['orders.id'=>$order_id]);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/order/view', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }


    // GET VOUCHER
    private function getVoucher($where=[]){
        $condition = "";
        foreach ($where as $key => $value) {
            if($value!=""){
                $condition .= " AND {$key}={$value}";
            }
        }

        $order_items = $this->db->query("
            SELECT 
                order_items.*
            FROM
                orders
            LEFT JOIN
                order_items ON orders.id = order_items.order_id
            WHERE
                orders.status != ''
                $condition
            GROUP BY
                order_items.id

        ")->result();

        $order = $this->db->query("
            SELECT 
                orders.*
            FROM
                orders
            LEFT JOIN
                order_items ON orders.id = order_items.order_id
            WHERE
                 orders.status != ''
                $condition
            GROUP BY
                orders.id

        ")->result();


        $record                = (array)$order[0];
        $record["order_items"] = $order_items;

        return (Object)$record;
    }


    // GET ALL ORDERS
    protected function allOrders($where=[])
    {
        $condition = "";
        foreach($where as $key=>$value){
            if($value!=''){
                if($key=='from')
                    $condition .= " AND orders.date >= '{$value}'";
                else if($key=='to')
                    $condition .= " AND orders.date <= '{$value}'";
                else
                    $condition .= " AND {$key}='{$value}'";
            }
        }

        return $this->db->query("
             SELECT 
                *,
                (SELECT COUNT(id) FROM order_items WHERE order_id=orders.id GROUP BY order_id) AS items,
                (SELECT SUM((price-((price/100)*discount))*quantity) FROM order_items WHERE order_id=orders.id GROUP BY order_id) AS amount,
                orders.id
            FROM 
                orders
            LEFT JOIN 
                order_items ON orders.id = order_items.order_id
            WHERE 
                orders.status != ''
                {$condition}
            GROUP BY 
                orders.id
            ORDER BY
                orders.id DESC
        ")->result();
    }
}
