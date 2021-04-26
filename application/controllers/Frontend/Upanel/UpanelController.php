<?php class UpanelController extends UserController {

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
    public function index(){
        $this->data['title'] = "Dashboard";

        return view('frontend.pages.upanel.dashboard');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function profile(){
        $this->data['title'] = "Profile";

        return view('frontend.pages.upanel.profile');
    }

    /*
     * *************************
     *  Below Code Load The
     *  Home Page First
     *  @param NULL
     * *********************
    */
    public function settings(){
        $this->data['title'] = "Settings";

        return view('frontend.pages.upanel.settings');
    }
}
