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

        $niddle_cond = "";
        if(is_array($niddle)){
            if(isset($niddle['orderBy']) && is_array($niddle['orderBy']) && count($niddle['orderBy'])>1)
            {
                $niddle_cond .= " ORDER BY {$niddle['orderBy'][0]} {$niddle['orderBy'][1]}";
            }
            if(isset($niddle['limit'])) {
                $niddle_cond .= " LIMIT {$niddle['limit']}";
            }
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
            {$niddle_cond}

    	")->result();
    	return $result;
    }
}

// Get All Colors Id As Array
if (!function_exists('getBestSaleProducts')) {
    function getBestSaleProducts($condition=[], $niddle=[])
    {   
        $where="products.trash=0 AND products.status='available'";
        if(is_array($condition)){
            foreach ($condition as $key => $value) {
                if($value!=''){
                    $where .= " AND {$key}='{$value}'";
                }
            }
        }

        $niddle_cond = "";
        if(is_array($niddle)){
            if(isset($niddle['limit'])) {
                $niddle_cond .= " LIMIT {$niddle['limit']}";
            }
        }


        $CI  = & get_instance();
        $ids = $CI->db->query("
            SELECT 
                AVG(quantity) AS avg_qty,
                product_id
            FROM 
                order_items 
            GROUP BY 
                order_items.product_id 
            ORDER BY avg_qty DESC

            {$niddle_cond}
        ")->result();

        $items = [];
        if($ids){
            foreach ($ids as $row) {
                $result = $CI->db->query("
                    SELECT 
                        stock.*,
                        products.*,
                        products.id AS product_id,
                        brands.brand,
                        categories.category,
                        subcategories.subcategory,
                        products.id,
                        SUM(order_items.quantity) AS total_item,
                        (SELECT medium FROM product_images WHERE product_id=products.id AND type='general_photo' ORDER BY id DESC LIMIT 1) AS general_photo,
                        (SELECT medium FROM product_images WHERE product_id=products.id AND type='feature_photo' LIMIT 1) AS feature_photo
                    FROM 
                        products
                    JOIN 
                        order_items ON order_items.product_id=products.id
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
                    AND 
                        products.id = {$row->product_id}
                    GROUP BY
                        products.id
                ")->result();

                if($result){
                    $items[] = $result[0];
                }
            }
        }
        return (Object)$items;
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

function getProductSizes($product_id){
    $ci =& get_instance();

    return $ci->db->query("
        SELECT 
        sizes.*
        FROM 
            products
        LEFT JOIN 
            product_sizes ON products.id=product_sizes.product_id
        LEFT JOIN 
            sizes ON sizes.id=product_sizes.size_id
        WHERE
            products.id={$product_id}
        GROUP BY
            sizes.id
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







