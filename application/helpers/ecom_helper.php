<?php

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


// FEATCH ALL PRODUCT
function getProducts($where=[]){
    $ci =& get_instance();

    $condition = "";
    foreach ($where as $key => $value) {
        $condition .= " AND {$key}='{$value}'";
    }
    return $ci->db->query("
        SELECT 
            *,
            products.id,
            products.purchase_price as d_purchase_price,
            categories.category,
            subcategories.subcategory,
            brands.brand,
            stock.sale_price,
            stock.purchase_price,
            stock.quantity,
            (SELECT small FROM product_images WHERE product_id=products.id AND type='feature_photo' limit 1) AS feature_photo
        FROM 
            products
        LEFT JOIN
            categories ON products.cat_id=categories.id
        LEFT JOIN
            subcategories ON products.sub_cat_id=subcategories.id
        LEFT JOIN
            brands ON products.brand_id=brands.id
        LEFT JOIN 
            stock ON stock.product_id = products.id
        WHERE
            products.trash=0
        $condition
        GROUP BY 
            products.id
        ORDER BY 
            products.id DESC
    ")->result();
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


function getSupplierInfo($supplier_id){
    $ci = &get_instance();

    $supplier = $ci->db->query("
        SELECT 
            suppliers.*,
            SUM(supplier_transaction.amount) AS total_paid
        FROM
            suppliers
        LEFT JOIN
            supplier_transaction ON suppliers.id=supplier_transaction.supplier_id
        WHERE 
            suppliers.id = {$supplier_id}
        AND 
            supplier_transaction.trash = 0
        GROUP BY
            suppliers.id
    ")->result();


    $bill = $ci->db->query("
        SELECT
            SUM(grand_total) AS grand_total
        FROM
            sap_record
        WHERE
            supplier_id={$supplier_id}
        AND 
            trash=0
        GROUP BY
            supplier_id

    ")->result();

    $balance = 0;
    if($supplier){
        $balance = ($supplier[0]->initial_balance - $supplier[0]->total_paid);
    }
    if($bill){
        $balance += $bill[0]->grand_total;
    }

    if($supplier){
        $info = (array)$supplier[0];
        $info['balance'] = $balance;
        return [(Object)$info];
    }
}


function purchaseInvoice($record_id=null){
    $ci = &get_instance();
    // 
    $result = null;

    if($record_id)
    {
        $record = $ci->db->query("
            SELECT 
                *
            FROM
                sap_record
            WHERE
                id={$record_id}
        ")->result();

        $paid = $ci->db->query("
            SELECT 
                SUM(supplier_transaction.amount) as paid
            FROM
                supplier_transaction
            WHERE
                supplier_transaction.sap_record_id={$record_id}
            GROUP BY
                supplier_transaction.sap_record_id
        ")->result();


        $items = $ci->db->query("
            SELECT 
                sap_items.*,
                products.title,
                products.id
            FROM
                sap_items
            LEFT JOIN
                products ON products.id=sap_items.product_id
            WHERE
                sap_record_id={$record_id}
        ")->result();


        $record_info = (array)$record[0];
        $record_info['paid'] = ($paid ? $paid[0]->paid : $record[0]->paid);


        $result['record'] = (Object)$record_info;
        $result['items']  = $items;


        if($result['record']->supplier_id!=''){
            $result['supplier'] = getSupplierInfo($result['record']->supplier_id)[0];
        }

    }
    return $result;
}
