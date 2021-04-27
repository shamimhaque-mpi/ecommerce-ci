<?php class AuthController extends UserController {

    function __construct() {
        parent::__construct();

        if($this->User_m->isLogin() && uri_string()!='logout'){
            redirect('user-panel/dashboard', 'refresh');
        }
        // $this->load->model("User_m");
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function login() {
        $this->data['title'] = 'Login';

        if($_POST){
            $this->User_m->login();
            redirect('user-panel/dashboard', 'refresh');
        }

        return view('frontend.auth.login');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function logout() {
        $this->data['title'] = 'Login';
        $this->User_m->logout();
        redirect_back();
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function forgot() {
        $this->data['title'] = 'Forgot';

        return view('frontend.auth.forgot');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function registration() {
        $this->data['title'] = 'Registration';

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
