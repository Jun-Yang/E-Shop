<?php

// ADMIN - CRUD for products table
$app->get('/admin/product/:op(/:id)', function($op, $id = 0) use ($app) {
    /* FOR PROJECTS WITH MANY ACCESS LEVELS
    if (($_SESSION['user']) || ($_SESSION['level'] != 'admin')) {
        $app->render('forbidden.html.twig');
        return;
    } */
    if ($op == 'edit') {
        $product = DB::queryFirstRow("SELECT * FROM products WHERE id=%i", $id);
        if (!$product) {
            echo 'Product not found';
            return;
        }
        $app->render("admin_product_add.html.twig", array(
            'v' => $product, 'operation' => 'Update'
        ));
    } else {
        $app->render("admin_product_add.html.twig",
                array('operation' => 'Add'
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));

$app->post('/admin/product/:op(/:id)', function($op, $id = 0) use ($app) {
    $name = $app->request()->post('name');
    $description = $app->request()->post('description');
    $price = $app->request()->post('price');
    $valueList = array(
        'name' => $name,
        'description' => $description,
        'price' => $price);
    // WRONG: $image = isset($_FILES['image']) ? $_FILES['image'] : array();
    $image = $_FILES['image'];
    // print_r($image);
    //    
    $errorList = array();
    if (strlen($name) < 2 || strlen($name) > 100) {
        array_push($errorList, "Name must be 2-100 characters long");
    }
    if (strlen($description) < 2 || strlen($description) > 1000) {
        array_push($errorList, "Description must be 2-1000 characters long");
    }
    if (empty($price) || $price < 0 || $price > 99999999) {
        array_push($errorList, "Price must be between 0 and 99999999");
    }
    if ($image['error'] != 0) {
        array_push($errorList, "Image is required to create a product");
    } else {
        $imageInfo = getimagesize($image["tmp_name"]);
        if (!$imageInfo) {
            array_push($errorList, "File does not look like an valid image");
        } else {
            // FIXME: opened a security hole here! .. must be forbidden
            if (strstr($image["name"], "..")) {
                array_push($errorList, "File name invalid");
            }
            // FIXME: only allow select extensions .jpg .gif .png, never .php
            $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, array('jpg', 'jpeg', 'gif', 'png'))) {
                array_push($errorList, "File name invalid");
            }
            // FIXME: do not allow file to override an previous upload
            if (file_exists('uploads/' . $image['name'])) {
                array_push($errorList, "File name already exists. Will not override.");
            }
        }
    }
    //
    if ($errorList) {
        $app->render("admin_product_add.html.twig", array(
            'v' => $valueList,
            "errorList" => $errorList,
            'operation' => ($op == 'edit' ? 'Edit' : 'Update')
        ));
    } else {
        // DONT GET FIRED OVER THESE!!!
        // FIXME: opened a security hole here! .. must be forbidden
        // FIXME: only allow select extensions .jpg .gif .png, never .php
        // FIXME: do not allow file to override an previous upload
        $imagePath = "uploads/" . $image['name'];
        move_uploaded_file($image["tmp_name"], $imagePath);
        if ($op == 'edit') {
            // unlink('') OLD file - requires select            
            $oldImagePath = DB::queryFirstField(
                            'SELECT imagePath FROM products WHERE id=%i', $id);
            if (($oldImagePath) && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            DB::update('products', array(
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "imagePath" => $imagePath
                    ), "id=%i", $id);
        } else {
            DB::insert('products', array(
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "imagePath" => $imagePath
            ));
        }
        $app->render("admin_product_add_success.html.twig", array(
            "imagePath" => $imagePath
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));

// HOMEWORK: implement a table of existing products with links for editing
$app->get('/admin/product/list', function() use ($app) {
    $productList =  DB::query("SELECT * FROM products");
    $app->render("admin_product_list.html.twig", array(
        'productList' => $productList
    ));
});

$app->get('/admin/product/delete/:id', function($id) use ($app) {
    $product = DB::queryFirstRow('SELECT * FROM products WHERE id=%i', $id);
    $app->render('admin_product_delete.html.twig', array(
        'p' => $product
    ));
});

$app->post('/admin/product/delete/:id', function($id) use ($app) {
    DB::delete('products', 'id=%i', $id);
    $app->render('admin_product_delete_success.html.twig');
});

$app->get('/product', function() use ($app) {
    $app->render('product.html.twig',array(
        "eshopuser" => $_SESSION['eshopuser']
    ));          
});



