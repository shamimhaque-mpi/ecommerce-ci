<?php defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] 	= "Home";
$route['admin']  				= "access/users/login";
$route['user']   				= "access/subscriber/login";
$route['contact']   			= "Frontend/HomeController/contact";
$route['category']   			= "Frontend/HomeController/category";
$route['checkout']   			= "Frontend/HomeController/checkout";
$route['view_cart']   			= "Frontend/HomeController/view_cart";
$route['about']   			    = "Frontend/HomeController/about_us";

$route['shop']   				= "Frontend/HomeController/shop";
$route['shop/(:any)/(:any)']   	= "Frontend/HomeController/shop/$1/$2";
$route['products/(:any)/(:any)']= "Frontend/HomeController/details/$1/$2";


// User Authentication
$route['login']   			    = "Frontend/Auth/AuthController/login";
$route['logout']   			    = "Frontend/Auth/AuthController/logout";
$route['forgot']   			    = "Frontend/Auth/AuthController/forgot";
$route['registration']   		= "Frontend/Auth/AuthController/registration";


$route['user-panel/dashboard']  		= "Frontend/Upanel/UpanelController";
$route['user-panel/profile']    		= "Frontend/Upanel/UpanelController/profile";
$route['user-panel/settings']   		= "Frontend/Upanel/UpanelController/settings";
$route['user-panel/order']      		= "Frontend/Upanel/UpanelController/order";
$route['user-panel/order_view/(:any)']  = "Frontend/Upanel/UpanelController/order_view/$1";
$route['user-panel/wishlist']   		= "Frontend/Upanel/UpanelController/wishlist";

$route['404_override'] = '';
