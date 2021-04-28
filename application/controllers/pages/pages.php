<?php class Pages extends Admin_Controller{
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
            $this->load->view('components/pages/pages', $this->data);
            $this->load->view('admin/includes/footer', $this->data);
        }

        public function add_process(){
            $data = [
                'date' => date('Y-m-d'),
                'page' => $this->input->post('page'),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description')
            ];

            //image upload start

            if($_FILES['img']['name'] != '')
            {
                $types = array('jpg','JPG','png','PNG','gif','GIF');
                $path  = "backend/images/pages/";
                $name  = 'pages'.(strtotime(date('Y-m-d h:i:s'))*10);
                $size  = '1024';

                if($path = upload_img("img", $types, $size, $path, $name)){
                    $data['img_path'] = $path;
                }
            }else{
                if($this->input->post('id') == 0){
                    $data['img_path'] = 0;
                }else{
                    $img = read('pages', ['id'=>$this->input->post('id')]);
                    $data['img_path'] = $img[0]->img_path;
                }
            }


            //pdf upload start
            if($_FILES['pdf']['name'] != '') {
                $types = array('pdf');
                $path  = "backend/pdf/pages/";
                $name  = 'pages'.(strtotime(date('Y-m-d h:i:s'))*10);
                $size  = '2024';

                if($path = upload_img("pdf", $types, $size, $path, $name)){
                    $data['pdf_path'] = $path;
                }
            }else{

                if($this->input->post('id') == 0){
                    $data['pdf_path'] = 0;
                }else{
                    $pdf = read('pages', ['id'=>$this->input->post('id')]);
                    $data['pdf_path'] = $pdf[0]->pdf_path;
                }
            }


            // check for add or update
            if($this->input->post('id') == 0){
                if(save('pages', $data)){
                    // set_msg('success', 'success', 'pages Successfully Created !');
                    $this->session->set_flashdata('success', 'pages Successfully Created !');
                }else{
                    // set_msg('warning', 'warning', 'pages Not Created !');
                    $this->session->set_flashdata('warning', 'pages Not Created !');
                }
            }else{
                if(update('pages', $data, ['id'=>$this->input->post('id')])){
                    // set_msg('success', 'success', 'pages Successfully Updated !');
                    $this->session->set_flashdata('success', 'pages Successfully Updated !');
                }else{
                    // set_msg('warning', 'warning', 'pages Not Created !');
                    $this->session->set_flashdata('warning', 'pages Not Created !');
                }
            }
            redirect_back();
        }

        public function delete_img($id=null) {
            // delete old image
            $data = read('pages', ['id'=>$id]);

            if(file_exists($data[0]->img_path)){
                unlink($data[0]->img_path);
            }

            $datau = array(
                'img_path' => 0
            );

            if(update('pages', $datau, ['id'=>$id])){
                // set_msg('success', 'success', 'pages image Deleted !');
                $this->session->set_flashdata('success', 'Pages image Deleted !');
            }else{
                // set_msg('warning', 'warning', 'pages image Not Deleted !');
                $this->session->set_flashdata('warning', 'Pages image Not Deleted !');
            }
            redirect_back();
        }

        public function delete_pdf($id=null){

            // delete old pdf
            $data = read('pages', ['id'=>$id]);

            if(file_exists($data[0]->pdf_path)){
                unlink($data[0]->pdf_path);
            }

            $datau = array(
                'pdf_path' => 0
            );

            if(update('pages', $datau, ['id'=>$id])){
                // set_msg('success', 'success', 'pages pdf Deleted !');
                $this->session->set_flashdata('success', 'Pages pdf Deleted !');
            }else{
                // set_msg('warning', 'warning', 'pages pdf Not Deleted !');
                $this->session->set_flashdata('warning', 'Pages pdf Not Deleted !');
            }
            redirect_back();
        }

        public function readData(){
            $page_name=$this->input->post("pageName");
            $data = read('pages', ['page'=>$page_name]);
            $encoded_data=json_encode($data);
            echo $encoded_data;
        }
    }
?>
