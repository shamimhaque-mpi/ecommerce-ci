<?php
    class Purchase extends Admin_Controller{
        public function __construct(){
            parent::__construct();
            $this->data['suppliers'] = readTable('suppliers', ['trash'=>0]);
        }
 
        public function index()
        {

            $where = ['sap_record.trash'=>0];
            if(!empty($_POST['search']) && is_array($_POST['search'])){
                foreach ($_POST['search'] as $key => $value) {
                    if($value!=''){
                        if($key=='from')
                            $where['sap_record.date >= '] = $value;
                        else if($key=='to')
                            $where['sap_record.date <= '] = $value;
                        else
                            $where['sap_record.'.$key]    = $value;
                    }
                }
            }

            $this->data['records'] = get_left_join('sap_record', 'suppliers', 'sap_record.supplier_id=suppliers.id', $where, 'sap_record.*, suppliers.name', null, 'sap_record.id', 'DESC');

            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/purchase/all', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
 
        public function add(){


            $this->data['products']  = getProducts();

            if($_POST){
                $sap_record_id = $this->manageRecord();
                $this->manageSapItems($sap_record_id);
                $this->manageTrx($sap_record_id);
                $this->stockManage();
                set_msg('success', 'Successfully Submited');
                redirect("purchase/purchase/view/{$sap_record_id}?system_id=NjVfMTI2", 'refresh');
            }


            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/purchase/add', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }


        public function view($record_id){

            $where  = ['sap_record.id'=>$record_id];

            $record = get_left_join('sap_record', 'suppliers', 'sap_record.supplier_id=suppliers.id', $where, 'sap_record.*, suppliers.name, suppliers.mobile, suppliers.address');

            $this->data['record'] = $record = ($record ? $record[0] : null);

            if($record){
                $this->data['items'] = get_left_join('sap_items', 'products', 'sap_items.product_id=products.id', ['sap_items.sap_record_id'=>$record_id], 'sap_items.*, products.title');
            }


            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/purchase/view', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
        public function Edit($id){
            $this->data['products']      = getProducts();
            $this->data['sap_record_id'] = $id;

            if($_POST && !empty($_POST['quantity']))
            {
                remove('supplier_transaction', ['sap_record_id'=>$id]);
                $this->deleteItem($id);
                $update = [
                    'grand_total'   => $_POST['grand_total'],
                    'discount'      => $_POST['discount'],
                    'sub_total'     => $_POST['sub_total'],
                    'paid'          => $_POST['paid'],
                    'total_qty'     => $_POST['total_qty'],
                ];
                update('sap_record', $update, ['id'=>$id]);
                $sap_record = read('sap_record', ['id'=>$id]);

                $this->manageSapItems($id, $sap_record[0]->date);
                $this->manageTrx($id, $sap_record[0]->date);
                $this->stockManage();
                set_msg('success', 'Invoice Successfully Update');
                redirect("purchase/purchase/edit/{$id}?system_id=NjVfMTI2", 'refresh');
            }


            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/purchase/edit', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
        public function delete($id){

            $records = get_join('sap_record', 'sap_items', 'sap_record.id=sap_items.sap_record_id', ['sap_record.id'=>$id]);

            foreach ($records as $key => $item) {
                $stock = readTable('stock', ['product_id'=>$item->product_id]);
                if($stock){
                    $data = [ 
                        'quantity' => ($stock[0]->quantity + $item->quantity)
                    ];
                    update('stock', $data, ['product_id'=>$item->product_id]);
                }else{
                    $data = [ 
                        'quantity'       => $item->quantity,
                        'purchase_price' => $item->purchase_price,
                        'sale_price'     => $item->sale_price
                    ];
                    save('stock', $data);
                }
            }
            update('supplier_transaction', ['trash'=>1], ['sap_record_id'=>$id]);
            update('sap_record', ['trash'=>1], ['id'=>$id]);

            set_msg('success', 'Purchase Successfully Deleted');
            redirect('purchase/purchase?system_id=NjVfMTI2', 'refresh');
        }


        private function deleteItem($record_id)
        {
            $items = readTable('sap_items', ['sap_record_id'=>$record_id]);
            foreach ($items as $key => $item) {
                $stock = readTable('stock', ['product_id'=>$item->product_id]);
                if($stock){
                    $data = [ 
                        'quantity' => ($stock[0]->quantity + $item->quantity)
                    ];
                    update('stock', $data, ['product_id'=>$item->product_id]);
                }else{
                    $data = [ 
                        'quantity'       => $item->quantity,
                        'purchase_price' => $item->purchase_price,
                        'sale_price'     => $item->sale_price
                    ];
                    save('stock', $data);
                }
            }
            remove('sap_items', ['sap_record_id'=>$record_id]);
        }


        private function manageRecord()
        {
            $data['supplier_id']    = $_POST['supplier_id'];
            $data['discount']       = $_POST['discount'];
            $data['paid']           = $_POST['paid'];
            $data['grand_total']    = $_POST['grand_total'];
            $data['sub_total']      = $_POST['sub_total'];
            $data['total_qty']      = $_POST['total_qty'];
            $data['supplier_name']  = $_POST['supplier_name'];
            $data['date']           = date('Y-m-d');
            return save('sap_record', $data);
        }


        private function manageSapItems($sap_record_id, $date=null)
        {
            foreach ($_POST['product_id'] as $key => $value) 
            {
                $data['product_id']     = $_POST['product_id'][$key];
                $data['purchase_price'] = $_POST['purchase_price'][$key];
                $data['sale_price']     = $_POST['sale_price'][$key];
                $data['quantity']       = $_POST['quantity'][$key];
                $data['total']          = $_POST['total'][$key];
                $data['sap_record_id']  = $sap_record_id;
                $data['date']           = ($date ? $date : date('Y-m-d'));
                save('sap_items', $data);
            }
        }


        private function stockManage()
        {
            foreach ($_POST['product_id'] as $key => $value) 
            {
                $stock = readTable('stock', ['product_id'=>$_POST['product_id'][$key]]);

                $data['product_id']     = $_POST['product_id'][$key];
                $data['purchase_price'] = $_POST['purchase_price'][$key];
                $data['sale_price']     = $_POST['sale_price'][$key];
                $data['quantity']       = $_POST['quantity'][$key] + ($stock ? $stock[0]->quantity : 0);
                
                if($stock)
                    update('stock', $data, ['product_id'=>$_POST['product_id'][$key]]);
                else 
                    save('stock', $data);
                // Update Product Status
                update('products', ['feature_product'=>'no'], ['id'=>$_POST['product_id'][$key]]);
            }
        }

        private function manageTrx($sap_record_id, $date=null)
        {
            $data['sap_record_id']  = $sap_record_id;
            $data['amount']         = $_POST['paid'];
            $data['supplier_type']  = ($_POST['supplier_id']!=''?'party':'cash');
            $data['supplier_type']  = ($_POST['supplier_id']!=''?'party':'cash');
            $data['supplier_name']  = $_POST['supplier_name'];
            $data['supplier_id']    = $_POST['supplier_id'];
            $data['trx_type']       = "paid";
            $data['date']           = ($date ? $date : date('Y-m-d'));
            save('supplier_transaction', $data);
        }



    }
?>