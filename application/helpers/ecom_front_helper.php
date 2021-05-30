<?php

// Get All Colors Id As Array
if (!function_exists('getProducts')) {
    function getProducts($condition=[], $niddle=[])
    {	
    	$where  = "products.trash=0 AND products.status='available'";
        $limit  = null;
        $offset = null;
    	if(is_array($condition)){
    		foreach ($condition as $key => $value) {
    			if($value!='' && $key!='limit' && $key!='offset' && $key!='product_ratings.rate'){
    				$where .= " AND {$key}='{$value}'";
    			}
                else if($value!='' && $key=='product_ratings.rate'){
                    $where .= " AND {$key} <= '{$value}'";
                }
                else if($value!='' && $key=='limit'){
                    $limit = " LIMIT {$value}";
                }
                else if($value!='' && $key=='offset'){
                    $offset = " OFFSET {$value}";
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
                (SELECT AVG(rate) FROM product_ratings WHERE product_id=products.id ORDER BY product_id LIMIT 1) AS rating,
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
            LEFT JOIN 
                product_ratings ON product_ratings.product_id=products.id
    		WHERE 
    			{$where}
    		GROUP BY
    			products.id
    	"
        .($niddle_cond ? $niddle_cond : 'ORDER BY product_ratings.rate DESC')
        .($limit  ? $limit  : '')
        .($offset ? $offset : '')
        )->result();
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
        $group_by    = "order_items.product_id";
        if(is_array($niddle)){
            if(isset($niddle['limit'])) {
                $niddle_cond .= " LIMIT {$niddle['limit']}";
            }
            if(isset($niddle['groupBy'])) {
                $group_by = $niddle['groupBy'];
            }
        }


        $CI  = & get_instance();
        $ids = $CI->db->query("
            SELECT 
                AVG(quantity) AS avg_qty,
                product_id
            FROM 
                order_items
            LEFT JOIN
                products ON products.id = order_items.product_id
            GROUP BY 
                {$group_by}
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
        JOIN 
            product_colors ON products.id=product_colors.product_id
        JOIN 
            colors ON colors.id=product_colors.color_id
        WHERE
            products.id={$product_id}
        GROUP BY
            colors.id
    ")->result();
}

function getProductSizes($product_id){
    $ci =& get_instance();
    $sizes = $ci->db->query("
        SELECT 
        sizes.*
        FROM 
            products
        JOIN 
            product_sizes ON products.id=product_sizes.product_id
        JOIN 
            sizes ON sizes.id=product_sizes.size_id
        WHERE
            products.id={$product_id}
        GROUP BY
            sizes.id
    ")->result();

    return ($sizes ? $sizes : []);
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

// Get All images Id As Array
if (!function_exists('slug')) {
    function slug($title){   
        //
        return str_replace(' ', '-', str_replace('/', '-', $title));
    }
}

// Get All images Id As Array
if (!function_exists('showRating')) {
    function showRating($rate=null){
        switch (round($rate)) {
            case 1:
                echo "
                    <div class='raring'>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                    </div>
                ";
                break;
            
            case 2:
                echo "
                    <div class='raring'>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                    </div>
                ";
                break;
            
            case 3:
                echo "
                    <div class='raring'>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                    </div>
                ";
                break;
            
            case 4:
                echo "
                    <div class='raring'>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star-outline'></i>
                    </div>
                ";
                break;
            
            case 5:
                echo "
                    <div class='raring'>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                        <i class='icon ion-md-star'></i>
                    </div>
                ";
                break;
            
            default:
                echo "
                    <div class='raring'>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                        <i class='icon ion-md-star-outline'></i>
                    </div>
                ";
                break;
        }
    }
}





