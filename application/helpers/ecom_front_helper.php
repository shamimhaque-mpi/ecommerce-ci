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
    			products.*,
    			stock.*,
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
if (!function_exists('getProducts_test')) {
    function getProducts_test($condition=[])
    {	
    	$where="products.trash=0 AND product_images.type='feature_photo'";
    	if(is_array($condition)){
    		foreach ($condition as $key => $value) {
    			if($value!=''){
    				$where .= " AND {$key}='{$value}'";
    			}
    		}
    	}
    	$CI 	= & get_instance();
    	$result = $CI->db->query("
    		SELECT 
    			products.*,
    			stock.*,
    			brands.brand,
    			categories.category,
    			subcategories.subcategory,
    			products.id,
    			product_images.*,
    			(SELECT medium FROM product_images WHERE product_id=products.id AND type='general' LIMIT 1) AS g_img
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
    		LEFT JOIN 
    			product_images ON product_images.product_id=products.id
    		WHERE 
    			{$where}
    		GROUP BY
    			products.id

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





