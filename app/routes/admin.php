<?php

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/../cache'
);

$app->get('/admin_panel', function() use ($app) {
    $app->render('admin_panel.html.twig', array(
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->get('/admin_product', function() use ($app) {
    $productList = DB::query("SELECT * FROM products");
    $app->render('admin_product.html.twig', array(
        'productList' => $productList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->map('/admin_user', function() use ($app) {
    $userList = DB::query("SELECT * FROM users");
    $app->render("admin_user.html.twig", array(
        'userList' => $userList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
})->via('GET', 'POST');


$app->get('/admin_category', function() use ($app) {
    $categoryList = DB::query("SELECT * FROM categories");
    $app->render("admin_category.html.twig", array(
        'categoryList' => $categoryList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->get('/admin_order', function() use ($app) {
    $orderList = DB::query("SELECT * FROM orders");
    $app->render("admin_order.html.twig", array(
        'orderList' => $orderList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->get('/admin_product_add', function() use ($app) {
    $app->render("admin_product_add.html.twig", array(
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->post('/admin_product_add', function() use ($app) {
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
    //$image2 = isset($_FILES['image']) ? $_FILES['image'] : array();
    $errorList = array();
    /* if (strlen($name) < 2 || strlen($name) > 100) {
      array_push($errorList, "Name must be 2-100 characters long");
      } */

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

        DB::insert('products', array(
            "title" => $title,
            "catID" => $catID,
            "name" => $name,
            "modelName" => $modelName,
            "modelNo" => $modelNo,
            "desc1" => $desc1,
            "price" => $price,
            "stock" => $stock,
            "code" => $code,
            "discount" => $discount,
            "postDate" => $today,
            'imageData1' => $imageBinaryData,
            'imageMimeType1' => $mimeType
        ));
        $app->render("add_success.html.twig", array(
            "title" => $title,
            "catID" => $catID,
            "modelName" => $modelName,
            "price" => $price,
            "stock" => $stock
        ));
    }
});

//Admin_Panel->Manage Users->Add users

$app->get('/admin_user_add', function() use ($app) {
    $app->render("admin_user_add.html.twig", array(
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->post('/admin_user_add', function() use ($app) {
    if (!$_SESSION['eshopuser']) {
        $app->render('forbidden.html.twig');
        return;
    }
    $name = $app->request()->post('name');
    $fname = $app->request()->post('fname');
    $lname = $app->request()->post('lname');
    $email = $app->request()->post('email');
    $phone = $app->request()->post('phone');
    $city = $app->request()->post('city');
    $addressLine1 = $app->request()->post('addressLine1');
    $addressLine2 = $app->request()->post('addressLine2');
    $code = $app->request()->post('code');
    $state = $app->request()->post('state');
    $code = $app->request()->post('code');
    $role = $app->request()->post('role');
    $pass1 = $app->request->post('pass1');
    $today = date("Y-m-d");
    //$last_login = $today;
    $errorList = array();
    $valueList = array('name' => $name);
    if (strlen($name) < 2 || strlen($name) > 200) {
        array_push($errorList, "Username name must be 2-100 characters long");
    } else {
        $userList = DB::queryFirstRow("SELECT * FROM users WHERE name=%s", $name);
        if ($userList) {
            array_push($errorList, "Username already in use");
        }
    }

    if ($errorList) {
        $app->render("admin_user_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
        DB::insert('users', array(
            'name' => $name, 
            "fname" => $fname,
            "lname" => $lname,
            "email" => $email,
            "phone" => $phone,
            'password' => password_hash($pass1, CRYPT_BLOWFISH),
            "city" => $city,
            "addressLine1" => $addressLine1,
            "addressLine2" => $addressLine2,
            "code" => $code,
            "state" => $state,
            
        ));
        $id = DB::insertId();
        //$log->debug(sprintf("User %s created", $id));
        $app->render("admin_user_add_success.html.twig", array(
            "name" => $name,
            "fname" => $fname,
            "lname" => $lname,
            "email" => $email,
            "phone" => $phone
        ));
        
    }
});


//Admin_Panel->Manage Category->Add Category
$app->get('/admin_category_add', function() use ($app) {
    $app->render("admin_category_add.html.twig", array(
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->post('/admin_category_add', function() use ($app) {
    if (!$_SESSION['eshopuser']) {
        $app->render('forbidden.html.twig');
        return;
    }
    $name = $app->request()->post('name');
    $parent = $app->request()->post('parent');
    $layer = $app->request()->post('layer');
    $description = $app->request()->post('description');
    $status = $app->request()->post('status');
    $today = date("Y-m-d");
    $postDate = $today;
    
    $errorList = array();
    $valueList = array('name' => $name);
    if (strlen($name) < 2 || strlen($name) > 200) {
        array_push($errorList, "Username name must be 2-100 characters long");
    } else {
        $userList = DB::queryFirstRow("SELECT * FROM categories WHERE name=%s", $name);
        if ($userList) {
            array_push($errorList, "categories name already in use");
        }
    }

    if ($errorList) {
        $app->render("admin_category_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
        print_r($name . $layer);
        DB::insert('categories', array(
            "name" => $name, 
            "parent" => $parent,
            "layer" => $layer,
            "description" => $description,
            "status" => $status,
            "postDate" => $today
        ));
        $id = DB::insertId();
        //$log->debug(sprintf("User %s created", $id));
        $app->render("admin_category_add_success.html.twig", array(
            "name" => $name,
            "layer" => $layer
        ));
    }
});

//Admin_Panel->Manage Order->Add Order
$app->get('/admin_order_add', function() use ($app) {
    $app->render("admin_order_add.html.twig", array(
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->post('/admin_order_add', function() use ($app) {
    if (!$_SESSION['eshopuser']) {
        $app->render('forbidden.html.twig');
        return;
    }
    $name = $app->request()->post('name');
    $userID = $app->request()->post('userID');
    $address = $app->request()->post('address');
    $postalCode = $app->request()->post('postalCode');
    $email = $app->request()->post('email');
    $phoneNumber = $app->request()->post('phoneNumber');
    $totalBeforeTax = $app->request()->post('totalBeforeTax');
    $shippingBeforeTax = $app->request()->post('shippingBeforeTax');
    $taxes = $app->request()->post('taxes');
    $totalWithShippingAndTaxes = $app->request()->post('totalWithShippingAndTaxes');
    $dateTimePlaced = $app->request()->post('dateTimePlaced');
    $dateTimeShipped = $app->request()->post('dateTimeShipped');
    $status = $app->request()->post('status');
    $today = date("Y-m-d");
    $postDate = $today;
    
    $errorList = array();
    $valueList = array('name' => $name);
    if (strlen($name) < 2 || strlen($name) > 200) {
        array_push($errorList, "name name must be 2-100 characters long");
    } /*else {
        $userList = DB::queryFirstRow("SELECT * FROM orders WHERE name=%s", $name);
        if ($userList) {
            array_push($errorList, "orderID name already in use");
        }
    }*/

    if ($errorList) {
        $app->render("admin_order_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
        DB::insert('orders', array(
            "name" => $name, 
            "userID" => $userID, 
            "address" => $address, 
            "postalCode" => $postalCode, 
            "email" => $email, 
            "phoneNumber" => $phoneNumber, 
            "totalBeforeTax" => $totalBeforeTax, 
            "shippingBeforeTax" => $shippingBeforeTax, 
            "taxes" => $taxes, 
            "totalWithShippingAndTaxes" => $totalWithShippingAndTaxes, 
            "dateTimePlaced" => $dateTimePlaced, 
            "dateTimeShipped" => $dateTimeShipped, 
            "status" => $status
        ));
        $id = DB::insertId();
        //$log->debug(sprintf("User %s created", $id));
        $app->render("admin_order_add_success.html.twig", array(
            "name" => $name,
            "userID" => $userID
        ));
        
    }
});


//list message
/*
$app->get('/admin_message', function() use ($app) {
    echo "admin admin admin";
    $messageList = DB::query("SELECT * FROM messages");
    //print_r($messageList);
    $app->render('admin_message.html.twig', array(
        'messageList' => $messageList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});*/

$app->get('/admin_message', function() use ($app) {
    $mList = DB::query("SELECT * FROM messages");
    $app->render("admin_message.html.twig", array(
        'mList' => $mList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->get('/admin_news_add', function() use ($app) {
    $mList = DB::query("SELECT * FROM news");
    $app->render("admin_news_add.html.twig", array(
        'mList' => $mList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->post('/admin_news_add', function() use ($app) {
    if (!$_SESSION['eshopuser']) {
        $app->render('forbidden.html.twig');
        return;
    }
    $subject = $app->request()->post('subject');
    $content = $app->request()->post('content');
    $status = "published";
    $today = date("Y-m-d");
    $postDate = $today;
    
    $errorList = array();
    $valueList = array('subject' => $subject);
    if (strlen($content) < 2 || strlen($content) > 200) {
        array_push($errorList, "Username name must be 2-100 characters long");
    }
    if ($errorList) {
        $app->render("admin_news_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
        DB::insert('news', array(
            "subject" => $subject,
            "content" => $content,
            "status" => $status,
            "postDate" => $today
        ));
        $id = DB::insertId();
        //$log->debug(sprintf("User %s created", $id));
        $app->render("index.html.twig", array(
            "subject" => $subject,
            "content" => $content
        ));
    }
});


$app->get('/admin_report', function() use ($app) {
    $mList = DB::query("SELECT * FROM orders");
    $app->render("admin_report.html.twig", array(
        'mList' => $mList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

//User Edit
$app->get('/admin_product_edit/:id', function($op, $id = 0) use ($app) {
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
        $app->render("admin_product_edit.html.twig", array(
            'p' => $product, 'operation' => 'Update'
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

//User Delete
$app->get('/admin_product_delete/:id', function($id) use ($app) {
    $product = DB::queryFirstRow('SELECT * FROM products WHERE id=%i', $id);
    $app->render('admin_product_delete.html.twig', array(
        'p' => $product
    ));
});

$app->post('/admin_product_delete/:id', function($id) use ($app) {
    DB::delete('products', 'id=%i', $id);
    $app->render('admin_product_delete_success.html.twig');
});
