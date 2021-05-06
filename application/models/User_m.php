<?php

class User_m extends Lab_Model {
    
    protected $_table_name = 'users';
    protected $_order_by = 'name';
    protected $_limit = '1';
            
    function __construct() {
        parent::__construct();
    }

    public function login() {
    	$holder    = config_item('privilege');
        $developer = config_item('developer');

        $where = [
            'username' => input_data('mobile'),
            'password' => $this->hash(input_data('password'))
        ];
        
		$userInfo = readTable('subscribers', $where);
        
        if(!empty($userInfo)) {
            // log in user
            $data = array(
                'subscriber_id' => $userInfo[0]->id,
                'login_period'  => date('Y-m-d H:i:s a'),
                'name'          => $userInfo[0]->name,
                'email'         => $userInfo[0]->email,
                'username'      => $userInfo[0]->username,
                'mobile'        => $userInfo[0]->mobile,
                'image'         => $userInfo[0]->image,
                'subscriber'    => TRUE
            );

            $this->session->set_userdata($data);
            // store access info
            $info = array(
                'user_id'       => $userInfo[0]->id,
                'login_period'  => $this->session->userdata('login_period')
            );
            save("access_info", $info);
            return true;
        }
    }
    
    public function logout() {
        // updates access info
        $where = array(
            'user_id'       =>$this->session->userdata('user_id'),
            'login_period'  => $this->session->userdata('login_period')
        );

        $data = array('logout_period' => date('Y-m-d H:i:s a'));
        update("access_info", $data, $where);
        $this->session->sess_destroy();
    }
    
    public function isLogin() {
        return (bool) $this->session->userdata('subscriber');
    }
    
    public function hash($string) {
        return hash('md5', $string . config_item('encryption_key'));
    }
}

