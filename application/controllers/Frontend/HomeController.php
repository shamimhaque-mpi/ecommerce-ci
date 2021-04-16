<?php class HomeController extends UserController {

    function __construct() {
        parent::__construct();
    }

    public function index() 
    {
    	$this->data['title']        = "Home";
    	$this->data['slider']       = readTable("sliders", ['status'=>1, 'is_offer'=>0]);
    	$this->data['slider_offer'] = readTable("sliders", ['status'=>1, 'is_offer'=>1]);
        $this->data['categories']   = readTable("categories", ['trash'=>0], ['orderBy'=>['id', 'DESC']]);


        view('frontend.pages.index');
    }
}
