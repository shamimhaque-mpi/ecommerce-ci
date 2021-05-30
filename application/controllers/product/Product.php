<?php class Product extends Admin_controller {

    function __construct() {
        parent::__construct();

        $this->data['brands']     = readTable('brands', ['trash'=>0], ['orderBy'=>['id', 'DESC']]);
        $this->data['colors']     = readTable('colors', ['trash'=>0], ['orderBy'=>['id', 'DESC']]);
        $this->data['sizes']      = readTable('sizes', ['trash'=>0], ['orderBy'=>['id', 'DESC']]);
        $this->data['categories'] = readTable('categories', ['trash'=>0], ['orderBy'=>['id', 'DESC']]);
    }

    public function index(){
        $where = [];
        if($_POST && is_array($_POST['search'])){
           foreach ($_POST['search'] as $key => $value) 
           {
               if($value!='') $where['products.'.$key] = $value;
           }
        }

        $this->data['all_product'] = readTable('products', ['trash'=>0]); 
        $this->data['products']    = getProducts($where);

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/product/all', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function add(){

        if($_POST){
            $data = $_POST;
            unset($data['size_id']);
            unset($data['color_id']);
            $data['date'] = date('Y-m-d');

            $product_id = save('products', $data);
            // Below Code Process The Color
            if(isset($_POST['size_id']) && is_array($_POST['size_id'])){
                foreach($_POST['size_id'] as $key => $size_id) {
                    $size = [
                        'product_id' => $product_id,
                        'size_id'    => $size_id
                    ];
                    save('product_sizes', $size);
                }
            }

            // Below Code Process The Color
            if(isset($_POST['color_id']) && is_array($_POST['color_id'])){
                foreach($_POST['color_id'] as $key => $color_id) {
                    $color = [
                        'product_id' => $product_id,
                        'color_id'   => $color_id
                    ];
                    save('product_colors', $color);
                }
            }

            // Below code process the feature Images
            if(isset($_FILES['feature_photo']) && $_FILES['feature_photo']['name']!=''){
                $image = [
                    'product_id' => $product_id,
                    'large'      => uploadToWebp($_FILES['feature_photo'], 'public/images/product/large/', time(), 690, null, 80),
                    'medium'     => uploadToWebp($_FILES['feature_photo'], 'public/images/product/medium/', time(), 270, null, 80),
                    'small'      => uploadToWebp($_FILES['feature_photo'], 'public/images/product/small/', time(), 115, null, 80),
                    'type'       => 'feature_photo'
                ];
                save('product_images', $image);
            }

            // Below code process the Feature Images
            if(isset($_FILES['photos']) && is_array($_FILES['photos']['name'])){
                foreach ($_FILES['photos']['name'] as $key => $row) {
                    if($_FILES['photos']['name'][$key]!=''){
                        $file = [
                            'tmp_name'  => $_FILES['photos']['tmp_name'][$key],
                            'name'      => $_FILES['photos']['name'][$key],
                        ];
                        $image = [
                            'product_id' => $product_id,
                            'large'      => uploadToWebp($file, 'public/images/product/large/', time()+($key+1), 690, null, 80),
                            'medium'     => uploadToWebp($file, 'public/images/product/medium/', time()+($key+1), 270, null, 80),
                            'small'      => uploadToWebp($file, 'public/images/product/small/', time()+($key+1), 115, null, 80),
                            'type'       => 'general_photo'
                        ];
                        save('product_images', $image);
                    }
                }
            }

            set_msg('success', 'Product Successfully Saved');
            redirect('product/product/?system_id=NjFfMTE4', 'refresh');
        }
        

        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/product/add', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function edit($id) {
        $this->data['meta_keyword'] 	= '';
        $this->data['meta_title'] 		= '';
        $this->data['meta_description'] = '';

        $this->data['edit'] = $edit = read('products', ['id'=>$id])[0];

        if($_POST){
            $data = $_POST;
            unset($data['size_id']);
            unset($data['color_id']);
            $data['date'] = date('Y-m-d');

            // DELETE ALL COLOR AND SIZES
            remove('product_sizes', ['product_id'=>$id]); 
            remove('product_colors', ['product_id'=>$id]); 
            // END DELETE PROCESSING

            update('products', $data, ['id'=>$id]);
            $product_id = $id;
            // Below Code Process The Color
            if(isset($_POST['size_id']) && is_array($_POST['size_id'])){
                foreach($_POST['size_id'] as $key => $size_id) {
                    $size = [
                        'product_id' => $product_id,
                        'size_id'    => $size_id
                    ];
                    save('product_sizes', $size);
                }
            }

            // Below Code Process The Color
            if(isset($_POST['color_id']) && is_array($_POST['color_id'])){
                foreach($_POST['color_id'] as $key => $color_id) {
                    $color = [
                        'product_id' => $product_id,
                        'color_id'   => $color_id
                    ];
                    save('product_colors', $color);
                }
            }

            // Below code process the feature Images
            if(isset($_FILES['feature_photo']) && $_FILES['feature_photo']['name']!=''){
                $f_image = readTable('product_images', ['type'=>'feature_photo', 'product_id'=>$id]);
                           remove('product_images', ['type'=>'feature_photo', 'product_id'=>$id]);
                if($f_image){
                    foreach ($f_image as $key => $row) {
                        if(file_exists($row->large))
                            unlink($row->large);
                        if(file_exists($row->medium))
                            unlink($row->medium);
                        if(file_exists($row->small))
                            unlink($row->small);
                    }
                }

                $image = [
                    'product_id' => $product_id,
                    'large'      => uploadToWebp($_FILES['feature_photo'], 'public/images/product/large/', time(), 690, null, 80),
                    'medium'     => uploadToWebp($_FILES['feature_photo'], 'public/images/product/medium/', time(), 270, null, 80),
                    'small'      => uploadToWebp($_FILES['feature_photo'], 'public/images/product/small/', time(), 115, null, 80),
                    'type'       => 'feature_photo'
                ];
                save('product_images', $image);
            }

            // Below code process the Feature Images
            if(isset($_FILES['photos']) && is_array($_FILES['photos']['name'])){
                foreach ($_FILES['photos']['name'] as $key => $row) {
                    if($_FILES['photos']['name'][$key]!=''){
                        $file = [
                            'tmp_name'  => $_FILES['photos']['tmp_name'][$key],
                            'name'      => $_FILES['photos']['name'][$key],
                        ];
                        $image = [
                            'product_id' => $product_id,
                            'large'      => uploadToWebp($file, 'public/images/product/large/', time()+$key, 690, null, 80),
                            'medium'     => uploadToWebp($file, 'public/images/product/medium/', time()+$key, 270, null, 80),
                            'small'      => uploadToWebp($file, 'public/images/product/small/', time()+$key, 115, null, 80),
                            'type'       => 'general_photo'
                        ];
                        save('product_images', $image);
                    }
                }
            }
            set_msg('success', 'Product Successfully Saved');
            redirect('product/product/?system_id=NjFfMTE4', 'refresh');
        }



        $this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/product/edit', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function view($id){

        $this->data['product'] = getProducts(['products.id'=>$id])[0];

    	$this->load->view('admin/includes/header', $this->data);
        $this->load->view('admin/includes/aside', $this->data);
        $this->load->view('admin/includes/headermenu', $this->data);
        $this->load->view('admin/includes/nav', $this->data);
        $this->load->view('components/product/view', $this->data);
        $this->load->view('admin/includes/footer', $this->data);
    }

    public function trash($id){
        update('products', ['trash'=>1], ['id'=>$id]);
        set_msg('success', 'Product Successfully Saved');
        redirect('product/product/?system_id=NjFfMTE4', 'refresh');
    }

}
