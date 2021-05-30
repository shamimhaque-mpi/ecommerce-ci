<?php class UpanelController extends UserController {

    function __construct() {
        parent::__construct();
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function index() {
        $this->data['title'] = "Dashboard";

        return view('frontend.pages.upanel.dashboard');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function profile() {
        $this->data['title'] = "Profile";

        if($_POST){
            update('subscribers', $_POST, ['id'=>$_POST['id']]);
            set_msg('success', 'Profile Successfully Updated');
            redirect_back();
        }




        return view('frontend.pages.upanel.profile');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function settings() {
        $this->data['title'] = "Settings";

        return view('frontend.pages.upanel.settings');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function order() {
        $this->data['title'] = "Order";

        $user_id = $this->session->userdata('subscriber_id');

        $this->data['order_list'] = $this->db->query("
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
                orders.user_id = {$user_id}
            GROUP BY
                orders.id
            ORDER BY
                orders.id DESC
        ")->result();

        return view('frontend.pages.upanel.order');
    }


	/*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function order_view($order_id) {
        $this->data['title'] = "Order View";
        $this->data['order'] = $this->getOrders(['orders.id'=>$order_id]);

        return view('frontend.pages.upanel.order_view');
    }


    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function wishlist() {
        $this->data['title'] = "Wishlist";

        $user_id = $this->session->userdata('subscriber_id');

        $this->data['wishlist'] = $wishlist = $this->db->query("
            SELECT 
                stock.*,
                products.title,
                products.id,
                (SELECT small FROM product_images WHERE product_id=products.id AND type='general_photo' ORDER BY id DESC LIMIT 1) AS general_photo,
                (SELECT small FROM product_images WHERE product_id=products.id AND type='feature_photo' LIMIT 1) AS feature_photo
            FROM 
                wish_list
            LEFT JOIN
                products ON wish_list.product_id=products.id
            LEFT JOIN
                stock ON stock.product_id=products.id
            WHERE 
                wish_list.user_id={$user_id}
        ")->result();

        /*dd($wishlist);
        die;*/

        return view('frontend.pages.upanel.wishlist');
    }

    /*
     * *************************
     *  Below Code Remove item
     *  From Wish List 
     *  @param product id
     * *********************
    */
    public function removeFromwishlist($id)
    {
        $user_id = $this->session->userdata('subscriber_id');

        $where = [
            'product_id' => $id,
            'user_id'    => $user_id
        ];
        remove('wish_list', $where);
        set_msg('success', 'Successfully Deleted item From Wish List');
        redirect_back();
    }


    /*
     * *************************
     *  Below Code Fetch The
     *  Order And Order
     *  Items
     *  @param Order Id
     * *********************
    */
    private function getOrders($where=[]){
        // set user id
        $user_id = $this->session->userdata('subscriber_id');

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
                user_id = {$user_id}
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
                user_id = {$user_id}
            $condition
            GROUP BY
                orders.id

        ")->result();


        $record                = (array)$order[0];
        $record["order_items"] = $order_items;

        return (Object)$record;
    }




    public function order_cancelation($order_id){
        $order = readTable('orders', ['id'=>$order_id, 'status'=>'pending']); 

        if($order)
        {
            update('orders', ['status'=>'cancel'], ['id'=>$order_id]);
            set_msg('success', 'Canceling process is successful');
        }
        else{
            set_msg('warning', 'Something is wrong! Please Try Again');
        }
        redirect_back();
    }
}
