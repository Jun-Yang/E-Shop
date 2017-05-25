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
//      echo '<img src ="data:image/jpeg;base64,'.base64_encode($product['imageData1']).'")/>';
        $image1 = base64_encode($product['imageData1']);
        $image2 = base64_encode($product['imageData2']);
        $app->render("admin_product_add.html.twig", array(
            'v' => $product, 'operation' => 'Update',
            'image1' => $image1,
            'image2' => $image2,
            'eshopuser' => $_SESSION['eshopuser']    
        ));
    } else {
        $app->render("admin_product_add.html.twig",
                array('operation' => 'Add',
                      'eshopuser' => $_SESSION['eshopuser']
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
    $price = $app->request()->post('price');
    $stock = $app->request()->post('stock');
    $discount = $app->request()->post('discount');
    $today = date("Y-m-d");
    $image = isset($_FILES['image']) ? $_FILES['image'] : array();
    $errorList = array();
    
    if (strlen($name) < 2 || strlen($name) > 100) {
      array_push($errorList, "Name must be 2-100 characters long");
    }
    
    if (empty($catID)) {
      array_push($errorList, "Category ID cannot be empty");
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
            if ($width > 800 || $height > 800) {
                array_push($errorList, "Image must at most 800 by 800 pixels");
            }
        }
    }

    $valueList = array('title' => $title);

    if (strlen($title) < 2 || strlen($title) > 200) {
        array_push($errorList, "Task name must be 2-100 characters long");
    } else {
        $productList = DB::queryFirstRow("SELECT * FROM products WHERE title=%s AND ID!=%i", $title, $id);
        if ($productList ) {
            array_push($errorList, "Product title already in use");
        }
    }

    if ($errorList) {
        $app->render("admin_product_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList,
            'eshopuser' => $_SESSION['eshopuser']
        ]);
    } else {
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        
        if ($op == 'edit') {
            if ($image) {
                $imageData1 = file_get_contents($image['tmp_name']);
                $imageMimeType1 = mime_content_type($image['tmp_name']);
            } else {
                $imageData1 = DB::queryFirstField(
                            'SELECT imageData1 FROM products WHERE id=%i', $id);
                $imageMimeType1 = DB::queryFirstField(
                            'SELECT imageMimeType1 FROM products WHERE id=%i', $id);
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
            'imageData1' => $imageData1,
            'imageMimeType1' => $imageMimeType1
            ), "id=%i", $id);
            $msg->success('Edit successfully');
            
        } else {
            $imageData1 = file_get_contents($image['tmp_name']);
            $imageMimeType1 = mime_content_type($image['tmp_name']);
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
            'imageData1' => $imageData1,
            'imageMimeType1' => $imageMimeType1
        ));
            $msg->success('Add successfully');
        }
        $msg->display();
        
        $productList =  DB::query("SELECT * FROM products");
        $app->render("admin_product_list.html.twig", array(
            'productList' => $productList,
            'eshopuser' => $_SESSION['eshopuser']    
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));

// HOMEWORK: implement a table of existing products with links for editing
$app->get('/admin/product/list', function() use ($app) {
    $productList =  DB::query("SELECT * FROM products");
    $app->render("admin_product_list.html.twig", array(
        'productList' => $productList,
        'eshopuser' => $_SESSION['eshopuser']    
    ));
});

$app->get('/admin/product/delete/:id', function($id) use ($app) {
    $product = DB::queryFirstRow('SELECT * FROM products WHERE id=%i', $id);
    $app->render('admin_product_delete.html.twig', array(
        'p' => $product,
        'eshopuser' => $_SESSION['eshopuser']
    ));
});

$app->post('/admin/product/delete/:id', function($id) use ($app) {
    DB::delete('products', 'id=%i', $id);
    $productList = DB::query("SELECT * FROM products");
    
    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
    $msg->success('Delete successfully');
    $msg->display();
    
    $app->render('admin_product_list.html.twig', array(
         'productList' => $productList,
        "eshopuser" => $_SESSION['eshopuser']    
    ));
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

// AJAX: query products with name
$app->get('/admin/product/search', function() use ($app) {
    $str = $_POST['searchinput']  . "%"; 
    $productList = DB::query("SELECT * FROM products WHERE name LIKE %s", $str);
    $app->render("admin_product_list.html.twig", array(
        'productList' => $productList,
        'str' =>$_POST['searchinput'],
        "eshopuser" => $_SESSION['eshopuser']    
    ));
})->VIA('GET', 'POST');

