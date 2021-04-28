<?php
require_once('./application/helpers/Cart.php');

/**
 * 
 */
class Api extends Frontend_Controller{

	// Load Parent 
    function __construct() {
        parent::__construct();
    }


    // SET CART ITEM
    function setCartItem()
    {
        if($_POST && !empty($_POST['product_id']))
        {
            $item = readTable("products", ['id'=>$_POST['product_id']])[0];
            $img  = readTable("product_images", ['product_id'=>$_POST['product_id'], 'type'=>'feature_photo']);
            $data = [
                'product_id' => $item->id,
                'color_id'   => (!empty($item->color_id)?$item->color_id : null),
                'size_id'    => (!empty($item->size_id)?$item->size_id : null),
                'title'      => $item->title,
                'price'      => ($item->price ? $item->price : 0),
                'quantity'   => $item->min_qty,
                'min_qty'    => $item->min_qty,
                'image'      => ($img ? $img[0]->small : ''),
            ];
            echo json_encode(Cart::setItem($data));            
        }
        else{
            echo 0;
        }
    }

    function cartItems()
    {
        echo json_encode(Cart::getItems());
    }

    function removeCartItem()
    {   
        if(!empty($_POST['code']) && $_POST['code']!=''){
            echo json_encode(Cart::removeItem($_POST['code']));
        }
        else
            echo json_encode(Cart::getItems());
    }

    function updateCartQuantity()
    {   
        echo json_encode(Cart::updateCartQuantity($_POST));
    }
}