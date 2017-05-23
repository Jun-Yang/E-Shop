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

$app->get('/admin/order', function() use ($app) {
    $orderList = DB::query("SELECT * FROM orders");
    $app->render("admin_order.html.twig", array(
        'orderList' => $orderList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

$app->get('/admin/user/add', function() use ($app) {
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


// ADMIN - CRUD for orders table
$app->get('/admin/order/:op(/:id)', function($op, $id = 0) use ($app) {
    
    // FOR PROJECTS WITH MANY ACCESS LEVELS
//    if (($_SESSION['eshopuser']) || ($_SESSION['role'] != 'admin')) {
//       $app->render('forbidden.html.twig');
//       return;
//    } 
    
    if ($op == 'edit') {
        $order = DB::queryFirstRow("SELECT * FROM orders WHERE id=%i", $id);
        if (!$order) {
            echo 'Order not found';
            return;
        }
        $app->render("admin_order_add.html.twig", array(
            'v' => $order, 'operation' => 'Update',
            "eshopuser" => $_SESSION['eshopuser']
        ));
    } else {
        $app->render("admin_order_add.html.twig", array(
            'operation' => 'Add',
            "eshopuser" => $_SESSION['eshopuser']
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));

$app->post('/admin/order/:op(/:id)', function($op, $id = 0) use ($app) {
    if (!$_SESSION['eshopuser']) {
        $app->render('forbidden.html.twig');
        return;
    }

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
    } /* else {
      $userList = DB::queryFirstRow("SELECT * FROM orders WHERE name=%s", $name);
      if ($userList) {
      array_push($errorList, "orderID name already in use");
      }
      } */

    if ($errorList) {
        $app->render("admin_order_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
        if ($op == 'edit') {
            // unlink('') OLD file - requires select
            $oldImagePath = DB::queryFirstField(
                            'SELECT imagePath FROM orders WHERE id=%i', $id);
            if (($oldImagePath) && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            DB::update('orders', array(
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
                    ), "id=%i", $id);
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
        }
        $app->render("add_success.html.twig", array(
            "name" => $name,
            "userID" => $userID,
            "address" => $address,
            "postalCode" => $postalCode,
            "email" => $email,
            "eshopuser" => $_SESSION['eshopuser']
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));

// HOMEWORK: implement a table of existing orders with links for editing
$app->get('/admin/order/list', function() use ($app) {
    $orderList = DB::query("SELECT * FROM orders");
    $app->render("admin_order_list.html.twig", array(
        'orderList' => $orderList,
        "eshopuser" => $_SESSION['eshopuser']    
    ));
});

$app->get('/admin/order/delete/:id', function($id) use ($app) {
    $order = DB::queryFirstRow('SELECT * FROM orders WHERE id=%i', $id);
    $app->render('admin_order_delete.html.twig', array(
        'o' => $order,
        "eshopuser" => $_SESSION['eshopuser']
    ));
})->VIA('GET', 'POST');


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