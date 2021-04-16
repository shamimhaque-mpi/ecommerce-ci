<?php
class Registration extends Frontend_Controller {
    function __construct() {
        parent::__construct();
    }
    

    public function email_douplicate_check() {
        $email = $this->input->post("email");
        if(exist('frontend_users',['email'=>$email])){
            echo true;
        }else{
            echo false;
        }
    }

    public function username_douplicate_check() {
        $username = $this->input->post("username");
        if(exist('frontend_users',['username'=>$username])){
            echo true;
        }else{
            echo false;
        }
    }


    /*front-end registared user data save start*/
    public function index() {
        $password         = $this->input->post('password');
        $confirm_password = htmlentities(trim($this->input->post('confirm_password')));
        $email            = htmlentities(trim($this->input->post('email')));
        $username         = htmlentities(trim($this->input->post('username')));
        $first_name       = htmlentities(trim($this->input->post('first_name')));
        $last_name        = htmlentities(trim($this->input->post('last_name')));

        /*empty check for all field start*/
        if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
            set_msg('danger','danger','Any field must not be empty!');
            redirect_back();
        }
        /*empty check for all field end*/

        // check email existance start
        if(read('frontend_users',["email"=>$email])){
            set_msg('danger','danger','This email already taken, try another!');
            redirect_back();
        }
        // check email existance end
        // check username existance start
        if(read('frontend_users',["username"=>$username])){
            set_msg('danger','danger','This username already taken, try another!');
            redirect_back();
        }
        // check username existance end
        // check pass and confirm pass start
        if($this->input->post('password') !== $confirm_password){
            set_msg('danger','danger','Password and Confirm password not matched!');
            redirect_back();
        }
        // check pass and confirm pass end
        // check password length start
        if(strlen($password)<6){
            set_msg('danger','danger','Password length must be greater than or equal to 6!');
            redirect_back();
        }
        // check password length end


        $data = [
            "username"   => $username,
            "email"      => $email,
            "password"   => md5(config_item('encryption_key').$password.config_item('encryption_key')),
            "accept"     => $this->input->post('accept'),
            "first_name" => $first_name,
            "last_name"  => $last_name,
            "cat_id"     => $this->input->post('category')
        ];

        /*save data into database start*/
        if(save('frontend_users', $data)){
            set_msg('success','success','Registration completed, Please check your email to activate your acount!');
            
            $to = $email;
            $subject = "User Verification.";

            $message =  "<html>
                            <head>
                                <title>User Verification.</title>
                            </head>
                            <body>
                                <p>This email contains HTML Tags!</p>
                            </body>
                        </html>";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <webmaster@example.com>' . "\r\n";
            $headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($to,$subject,$message,$headers);
        }else{
            set_msg('warning','warning','Registration not completed!');
        }
        /*save data into database end*/
        redirect_back();
    }
    /*front-end registared user data save end*/


    /*front-end user's login start*/
    public function frontend_user_login() {
        $username = htmlentities(trim($this->input->post('username')));
        $password = md5(config_item('encryption_key').htmlentities(trim($this->input->post('password'))).config_item('encryption_key'));
        $cond = [
            'username'=>htmlentities(trim($username)),
            'password'=>$password, 
            // 'status'  =>1
        ];
        
        /*check user data existance start*/
        $userInfo = read("frontend_users", $cond);
        print_r($userInfo);
        return;
        if($userInfo && count($userInfo)===0){
            /*destroy old session*/
            $this->session->sess_destroy();
            
            $this->session->set_flashdata("username_id", $userInfo[0]->id);
            $this->session->set_flashdata("username", $userInfo[0]->username);
            $this->session->set_flashdata("email", $userInfo[0]->email);
            $this->session->set_flashdata("loged_in", "true");
        }
        print_r($userInfo);
        // logedIn();
        /*check user data existance end*/
    }
    /*front-end user's login end*/

}