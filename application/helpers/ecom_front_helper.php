<?php

// Get All Colors Id As Array
if (!function_exists('getProducts')) {
    function getProducts($condition=[], $niddle=[])
    {	
    	$where="products.trash=0 AND products.status='available'";
    	if(is_array($condition)){
    		foreach ($condition as $key => $value) {
    			if($value!=''){
    				$where .= " AND {$key}='{$value}'";
    			}
    		}
    	}

        $limit = "";
        foreach ($niddle as $key => $value) {
            if($key=='limit')
                $limit = " LIMIT {$value}";
        }

    	$CI 	= & get_instance();
    	$result = $CI->db->query("
    		SELECT 
    			stock.*,
    			products.*,
                products.id AS product_id,
    			brands.brand,
    			categories.category,
    			subcategories.subcategory,
    			products.id,
    			(SELECT medium FROM product_images WHERE product_id=products.id AND type='general_photo' ORDER BY id DESC LIMIT 1) AS general_photo,
                (SELECT medium FROM product_images WHERE product_id=products.id AND type='feature_photo' LIMIT 1) AS feature_photo
    		FROM 
    			products  
    		LEFT JOIN
    			stock ON stock.product_id=products.id
    		LEFT JOIN 
    			brands ON brands.id=products.brand_id
    		LEFT JOIN 
    			categories ON categories.id=products.cat_id
    		LEFT JOIN 
    			subcategories ON subcategories.id=products.sub_cat_id
    		WHERE 
    			{$where}
    		GROUP BY
    			products.id
            {$limit}

    	")->result();
    	return $result;
    }
}


// Get All Colors Id As Array
if (!function_exists('toSlug')) {
    function toSlug($text){   
        return str_replace(' ', '-', $text);
    }
}

// Get All Colors Id As Array
if (!function_exists('toBase64')) {
    function toBase64($text){   
        if(gettype($text)=='array'){
            return base64_encode(json_encode($text));
        }
        else{return base64_encode($text);}
    }
}

function user(){
    $CI = & get_instance();

    if($CI->session->userdata('subscriber'))
    {
        $user = readTable('subscribers', ['id'=>$CI->session->userdata('subscriber_id')]);
        return ($user ? $user[0] : false);
    }
    else{
        return false;
    }
    
}


function getProductColors($product_id){
    $ci =& get_instance();

    return $ci->db->query("
        SELECT 
        colors.*
        FROM 
            products
        LEFT JOIN 
            product_colors ON products.id=product_colors.product_id
        LEFT JOIN 
            colors ON colors.id=product_colors.color_id
        WHERE
            products.id={$product_id}
        GROUP BY
            colors.id
    ")->result();
}



// Get All Colors Id As Array
if (!function_exists('getColorIds')) {
    function getColorIds($product_id)
    {   
        $ids  = [];
        $data = readTable('product_colors', ['product_id'=>$product_id]);
        foreach ($data as $key => $row) {
            $ids[] = $row->color_id;
        }
        return $ids;
    }
}

// Get All Size Id As Array
if (!function_exists('getSizeIds')) {
    function getSizeIds($product_id)
    {   
        $ids  = [];
        $data = readTable('product_sizes', ['product_id'=>$product_id]);
        foreach ($data as $key => $row) {
            $ids[] = $row->size_id;
        }
        return $ids;
    }
}

// Get All images Id As Array
if (!function_exists('getImages')) {
    function getImages($product_id)
    {   
        return readTable('product_images', ['product_id'=>$product_id]);
    }
}







