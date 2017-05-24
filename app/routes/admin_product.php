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
        print_r($id);
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
    if (!$_SESSION['eshopuser']) {
        $app->render('forbidden.html.twig');
        return;
    }

    $title = $app->request()->post('title');
    $name = $app->request()->post('name');
    $catID = $app->request()->post('catID');
    $modelName = $app->request()->post('modelName');
    $modelNo = $app->request()->post('modelNo');
    $desc1 = $app->request()->post('desc1');
    $desc2 = $app->request()->post('desc2');
    $code = $app->request()->post('code');
    //$desc3 = $app->request()->post('desc3');
    $price = $app->request()->post('price');
    $stock = $app->request()->post('stock');
    $discount = $app->request()->post('discount');
    $today = date("Y-m-d");
    $postDate = $today;
    $image = isset($_FILES['image']) ? $_FILES['image'] : array();
    $errorList = array();
    
    if (strlen($name) < 2 || strlen($name) > 100) {
      array_push($errorList, "Name must be 2-100 characters long");
    }

    if (empty($price) || $price < 0 || $price > 99999999) {
        array_push($errorList, "Price must be between 0 and 99999999");
    }
    if ($image) {
        $imageInfo = getimagesize($image["tmp_name"]);
        if (!$imageInfo) {
            array_push($errorList, "File does not look like an valid image");
        } else {
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            if ($width > 2000 || $height > 2000) {
                array_push($errorList, "Image must at most 2000 by 2000 pixels");
            }
        }
    }

    $valueList = array('title' => $title);

    if (strlen($title) < 2 || strlen($title) > 200) {
        array_push($errorList, "Task name must be 2-100 characters long");
    } else {
        $productList = DB::queryFirstRow("SELECT * FROM products WHERE title=%s", $title);
        if ($productList) {
            array_push($errorList, "Product title already in use");
        }
    }

//    print_r($_SESSION['todouser']);
    if ($errorList) {
        $app->render("admin_product_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
        $imageBinaryData = file_get_contents($image['tmp_name']);
        $mimeType = mime_content_type($image['tmp_name']);
        if ($op == 'edit') {
            // unlink('') OLD file - requires select
            print_r($op);
            $oldImagePath = DB::queryFirstField(
                            'SELECT imagePath FROM products WHERE id=%i', $id);
            if (($oldImagePath) && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            DB::update('products', array(
            "title" => $title,
            "catID" => $catID,
            "name" => $name,
            "modelName" => $modelName,
            "modelNo" => $modelNo,
            "desc1" => $desc1,
            "desc2" => $desc2,
            "price" => $price,
            "stock" => $stock,
            "code" => $code,
            "discount" => $discount,
            "postDate" => $today,
            'imageData1' => $imageBinaryData,
            'imageMimeType1' => $mimeType
            ), "id=%i", $id);
        } else {
            DB::insert('products', array(
            "title" => $title,
            "catID" => $catID,
            "name" => $name,
            "modelName" => $modelName,
            "modelNo" => $modelNo,
            "desc1" => $desc1,
            "desc2" => $desc2,
            "price" => $price,
            "stock" => $stock,
            "code" => $code,
            "discount" => $discount,
            "postDate" => $today,
            'imageData1' => $imageBinaryData,
            'imageMimeType1' => $mimeType
        ));
        }
        $app->render("admin_product_success.html.twig", array(
            "title" => $title,
            "catID" => $catID,
            "modelName" => $modelName,
            "price" => $price,
            "stock" => $stock
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
    print_r($id);
    DB::delete('products', 'id=%i', $id);
    $app->render('admin_product_delete_success.html.twig');
});

$app->get('/product', function() use ($app) {
    $app->render('product.html.twig',array(
        "eshopuser" => $_SESSION['eshopuser']
    ));          
});

//for image view

$app->get('/imageview/:id(/:operation)', function($id, $operation = '') use ($app) {

    $product = DB::queryFirstRow("SELECT imageData1,imageMimeType1 FROM products "
            . " WHERE ID=%i",$id);
    if (!$product) {
        $app->response()->status(404);
        echo "404 - not found";
    } else {
        if ($operation == 'download') {
            $app->response->headers->set('Content-Disposition',
                    'attachment; somefile.jpg');
        }
        $app->response->headers->set('Content-Type', $product['imageMimeType1']);
        echo $product['imageData1'];
    }
})->conditions(array('operation' => 'download'));

$app->get('/imageview/:id', function($id) use ($app) {

    $product = DB::queryFirstRow("SELECT imageData1,imageMimeType1 FROM products "
            . " WHERE ID=%i",$id);
    if (!$product) {
        $app->response()->status(404);
        echo "404 - not found";
    } else {
        if ($operation == 'download') {
            $app->response->headers->set('Content-Disposition',
                    'attachment; somefile.jpg');
        }
        $app->response->headers->set('Content-Type', $product['imageMimeType1']);
        echo $product['imageData1'];
    }
});



