<?php class About_controller extends Admin_Controller{
        public function __construct(){
            parent::__construct();
        }

        public function add() {
            $this->data['meta_keyword'] = '';
            $this->data['meta_title'] = '';
            $this->data['meta_description'] = '';

            $this->data['about_us'] = read('about', ['status'=>1]);

            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/about_us/add', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }

        public function add_process() {
            $old_image = read('about');
            if($old_image != null){
                if(file_exists($old_image[0]->path)){
                    unlink($old_image[0]->path);
                }
                delete('about', ['id >'=>0]);
            }

            $data = [
                'title' => $_POST['name'],
                'description' => ($this->input->post('description'))
            ];


            $types = array('jpg','JPG','png','PNG','gif','GIF');
            $path  = "backend/images/about_us/";
            $name  = 'about_us'.(strtotime(date('Y-m-d h:i:s'))*10);
            $size  = '1024';

            if($path = upload_img("img", $types, $size, $path, $name)){
                $data['path'] = $path;
            }


            if(exist('about', (['title'=>$this->input->post('name')]))==false){
                if(save('about', $data)){
                    set_msg('success', 'success', 'About Us  Successfully Created !');
                }else{
                    set_msg('warning', 'warning', 'About Us  Not Created !');
                }
            }else{
                set_msg('warning', 'warning', 'About Us  Already Exists !');
            }
            redirect_back();
        }
    }
?>
