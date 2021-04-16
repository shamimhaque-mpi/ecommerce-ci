<?php
    class Profile extends Admin_Controller{
        public function __construct(){
            parent::__construct();
        }
        
        
        public function index(){
            $this->data['meta_keyword'] = '';
            $this->data['meta_title'] = '';
            $this->data['meta_description'] = '';
            
            
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/profile/add', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
        
        
        public function all_view(){
            $this->data['meta_keyword'] = '';
            $this->data['meta_title'] = '';
            $this->data['meta_description'] = '';
            
            $this->data['profile'] = read('profiles');
            
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/profile/list', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
        
        
        public function add_process(){
            $data = [
                'name' => str_secure($this->input->post('name')),
                'description' => str_secure($this->input->post('description'))
            ];
            
            //image upload start
            //---------------------------------------------
            $types = array('jpg','JPG','png','PNG','gif','GIF');
            $path  = "backend/images/profile/";
            $name  = 'gallery'.(strtotime(date('Y-m-d h:i:s'))*10);
            $size  = '1024';
    
            if($path = upload_img("img", $types, $size, $path, $name)){
                $data['path'] = $path;
            }
            
            // check existance
            if(exist('profiles', str_secure(['title'=>$this->input->post('name')]))==false){
                if(save('profiles', $data)){
                    set_msg('success', 'success', 'profile Successfully Created !');
                }else{
                    set_msg('warning', 'warning', 'profile Not Created !');
                }
            }else{
                set_msg('warning', 'warning', 'profile Already Exists !');
            }
            redirect_back();
        }
        
        
        public function edit($id=null){
            $this->data['meta_keyword'] = '';
            $this->data['meta_title'] = '';
            $this->data['meta_description'] = '';
            
            $this->data['profile'] = read('profiles', ['id'=>$id]);
            
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/profile/edit', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
        
        
        public function edit_process($id=null){
            $data = [
                'name' => str_secure($this->input->post('name')),
                'description' => str_secure($this->input->post('description'))
            ];
            
            
            // check existance
            /*if(exist('profiles', ['id !='=>$id,'title'=>str_secure($this->input->post('name'))])){
                set_msg('warning', 'warning', 'This profile Already Exists !');
                redirect_back();
            }*/
            
            if(!empty($_FILES['img']['name'])){
                //image upload start
                //---------------------------------------------
                $types = array('jpg','JPG','png','PNG','gif','GIF');
                $path  = "backend/images/profile/";
                $name  = 'gallery'.(strtotime(date('Y-m-d h:i:s'))*10);
                $size  = '1024';
        
                if($path = upload_img("img", $types, $size, $path, $name)){
                    $data['path'] = $path;
                }
                
                // delete old image
                if(file_exists($this->input->post('old_img'))){
                    unlink($this->input->post('old_img'));
                }
            }
            
            
            if(update('profiles', $data, ['id'=>$id])){
                set_msg('success', 'success', 'profile Successfully Update !');
            }else{
                set_msg('warning', 'warning', 'profile Not Update !');
            }
            redirect_back();
        }
        
        
        /*public function trash($id=null){
            if(update('categories', ['status'=>0], ['id'=>$id])){
                set_msg('success', 'success', 'Category Successfully Deleted !');
            }else{
                set_msg('warning', 'warning', 'Category Not Deleted !');
            }
            redirect_back();
        }
        
        
        public function trash_list(){
            $this->data['meta_keyword'] = '';
            $this->data['meta_title'] = '';
            $this->data['meta_description'] = '';
            
            $this->data['category'] = read('categories', ['status'=>0]);
            
            $this->load->view('admin/includes/header', $this->data);
            $this->load->view('admin/includes/aside', $this->data);
            $this->load->view('admin/includes/headermenu', $this->data);
            $this->load->view('admin/includes/nav', $this->data);
            $this->load->view('components/category/trash_list', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }
        
        
        public function restore($id=null){
            if(update('categories', ['status'=>1], ['id'=>$id])){
                set_msg('success', 'success', 'Category Successfully Restored !');
            }else{
                set_msg('warning', 'warning', 'Category Not Restored !');
            }
            redirect_back();
        }
        */
        
        public function delete($id=null){

            // delete old image
                if(file_exists($this->input->post('old_img'))){
                    unlink($this->input->post('old_img'));
                }

            if(delete('profiles', ['id'=>$id])){
                set_msg('success', 'success', 'profile Permanently Deleted !');
            }else{
                set_msg('warning', 'warning', 'profile Not Deleted !');
            }
            redirect_back();
        }
        
        public function alignByAjax(){
            
        }
        
    }
?>