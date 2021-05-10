<?php
class Cart {
	public $items = [];
	function __construct()
	{
		if(!empty($_SESSION['cart'])){
			$this->items = json_decode($_SESSION['cart'], true);			
		}
		else {
			$this->items = [];
		}
	}

	// 
	static function items()
	{
		$cart = new Cart();
		return $cart->items;

	}

	// 
	static function getItems()
	{
		$cart = new Cart();
		return $cart->items;

	}

	// 
	static function setItem($item)
	{
		$cart = new Cart();
		$code = $cart->key();
		while(array_key_exists($code, $cart->items)) {
			$code = rand(1111,9999);
		}

		if(!$cart->checkUpdate($item)){
			$item['code'] 		= $code;
			$cart->items[$code] = $item;
		}
		
		$_SESSION['cart'] = json_encode($cart->items);
		return $cart->items;
	}

	// Remove Item From Cart
	static function removeItem($code)
	{
		$cart = new Cart();
		if(!empty($cart->items[$code])){
			unset($cart->items[$code]);
			$_SESSION['cart'] = json_encode($cart->items);
		}
		return $cart->items;

	}

	// 
	static function setItemColor($data){
		if(isset($data['code']) && isset($data['color_id'])){
			$color = readTable('colors', ['id'=>$data['color_id']]);
			if($color){
				$cart = new Cart();
				$cart->items[$data['code']]['color_id'] 	= $data['color_id'];
				$cart->items[$data['code']]['color']		= $color[0]->color;
				$cart->items[$data['code']]['color_code']	= $color[0]->color_code;
				$_SESSION['cart'] = json_encode($cart->items);
			}
		}
	}

	// 
	static function setItemSize($data){
		if(isset($data['code']) && isset($data['size_id'])){
			$color = readTable('sizes', ['id'=>$data['size_id']]);
			if($color){
				$cart = new Cart();
				$cart->items[$data['code']]['size_id'] 	= $data['size_id'];
				$cart->items[$data['code']]['size']		= $color[0]->size;
				$_SESSION['cart'] = json_encode($cart->items);
			}
		}
	}


	// Destroy All Cart Data
	static function destroy()
	{
		$_SESSION['cart'] = "";
		return true;

	}

	// 
	static function updateCartQuantity($data)
	{
		$cart = new Cart();
		if(!empty($data['code']) && !empty($data['quantity']) && !empty($cart->items[$data['code']]))
		{
			if($cart->items[$data['code']]['min_qty'] <= $data['quantity'])
			$cart->items[$data['code']]['quantity'] = $data['quantity'];
			$_SESSION['cart'] = json_encode($cart->items);
		}
		return $cart->items;

	}


	// CHECK UPDATE
	public function checkUpdate($item){
		foreach ($this->items as $key => $value) {
			if($value['product_id']==$item['product_id']){
				$this->items[$key]['quantity'] += 1;  
				return true;
			}
		}
		return false;
	}


	// NEW KEY GENERATE
	public function key($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}