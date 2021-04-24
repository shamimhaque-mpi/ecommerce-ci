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

        return view('frontend.pages.upanel.dashboard');
    }
}
