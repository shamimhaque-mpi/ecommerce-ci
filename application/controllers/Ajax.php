<?php

class Ajax extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    // Read Table
    function read(){
        if($_POST){
            if(!empty($_POST['table']) && $_POST['table']!=''){
                $where = $niddle = [];
                if(!empty($_POST['where']))
                    $where = json_decode($_POST['where'], true);
                if(!empty($_POST['niddle']))
                    $niddle = json_decode($_POST['niddle'], true);

                $result = readTable($_POST['table'], $where, $niddle);
                echo json_encode($result);
            }
        }
    }

}
