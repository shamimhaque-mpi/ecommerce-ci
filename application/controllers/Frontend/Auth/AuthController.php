<?php class AuthController extends UserController {

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
    public function login()
    {
        $this->data['title'] = 'Login';



        return view('frontend.auth.login');
    }

    /* 
     * *************************
     *  Below Code Load The 
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function registration()
    {
        if($_POST){
            $data = $_POST;
            $data['username'] = $_POST['mobile'];
            $data['password'] = hash('md5', $_POST['password'].config_item('encryption_key'));
            unset($data['confirm_password']);
            save('subscribers', $data);
            set_msg('success', 'Registration is successfull'); 
            redirect('login', 'refresh');
        }
        return view('frontend.auth.registration');
    }

}
