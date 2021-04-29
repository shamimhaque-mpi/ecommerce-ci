<?php class HomeController extends Frontend_Controller {

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
    	$this->data['title']        = "Home";
    	$this->data['slider']       = readTable("sliders", ['status'=>1, 'is_offer'=>0]);
    	$this->data['slider_offer'] = readTable("sliders", ['status'=>1, 'is_offer'=>1]);
        $this->data['categories']   = readTable("categories", ['trash'=>0], ['orderBy'=>['id', 'DESC']]);

        $this->data['feature_products'] = getProducts(['products.feature_product'=>'yes'], ['limit'=>6]);
        $this->data['category_wise']    = get_join('categories', 'products', 'categories.id=products.cat_id', ['categories.trash'=>0], 'categories.*', 'categories.id', 'categories.id', 'DESC', 4);

        return view('frontend.pages.index');
    }

    /*
     * *************************
     *  Below Code Process
     *  Contact Page
     *  @param NULL
     * *********************
    */
    public function contact() {
        $this->data['title'] = "Contact";

        return view('frontend.pages.contact');
    }

    /*
     * *****************************
     *  Category Page Controller
     *  @param NULL
     * *************************
    */
    public function category() {
        $this->data['title'] = "Category";

        return view('frontend.pages.category');
    }

    /* Checkout Page Controller */
    public function checkout() {
        $this->data['title'] = "Checkout";

        return view('frontend.pages.checkout');
    }

    /* Details Page Controller */
    public function details($btoa) {
        $this->data['title'] = "Details";

        $product_id = base64_decode($btoa);
        $product    = getProducts(['products.id'=>$product_id]);
        //
        $this->data['product'] = $product = ($product ? $product[0] : false);
        /*
         * ***********************
         *  Featch Similar 
         *  Products
         * *****************
        */
        $where_semilar = ($product ? ['products.cat_id'=>$product->cat_id]:[]);
        $this->data['similar_products'] = getProducts($where_semilar, ['limit'=>4]);

        return view('frontend.pages.details');
    }

    /* ViewCart Page Controller */
    public function view_cart() {
        $this->data['title'] = "ViewCart";

        return view('frontend.pages.view_cart');
    }


    /*
     * *****************************
     *  Show The About Page
     *  @param NULL
     * *************************
    */
    public function about_us() {
        $this->data['title'] = "About Us";

        return view('frontend.pages.about_us');
    }


    public function shop($slug=null) {
        $this->data['title'] = "Shop";

        $where = [ 'products.feature_product'=>'no'];

        if(json_decode(base64_decode($slug), true)){
            $slug  = json_decode(base64_decode($slug), true);
            if(is_array($slug)) {
                foreach ($slug as $key => $value) {
                    if($value!='')
                        $where[$key] = $value;
                }
            }
        }
        $this->data['products'] = getProducts($where);

        return view('frontend.pages.shop');
    }




    public function get_products(){
        if($_POST){

            $condition = "";
            foreach ($_POST as $key => $value) {
                if($value!='' && $key=='key'){
                    $condition .= " AND products.title LIKE '%".$value."%'";
                }
                else {
                    $condition .= " AND {$key}={$value}";
                }
            }

            if($condition){
                $result = $this->db->query("
                    SELECT 
                        products.*,
                        stock.*,
                        brands.brand,
                        categories.category,
                        subcategories.subcategory,
                        products.id,
                        (SELECT medium FROM product_images WHERE product_id=products.id AND type='general_photo' ORDER BY id DESC LIMIT 1) AS general_photo,
                        (SELECT medium FROM product_images WHERE product_id=products.id AND type='feature_photo' LIMIT 1) AS feature_photo
                    FROM 
                        products  
                    LEFT JOIN
                        stock ON stock.product_id=products.id
                    LEFT JOIN 
                        brands ON brands.id=products.brand_id
                    LEFT JOIN 
                        categories ON categories.id=products.cat_id
                    LEFT JOIN 
                        subcategories ON subcategories.id=products.sub_cat_id
                    WHERE 
                        products.status='available'
                    AND 
                        products.trash=0
                        $condition
                    GROUP BY
                        products.id
                    LIMIT 8

                ")->result();
                echo json_encode($result);            
            }

        }
    }
}
