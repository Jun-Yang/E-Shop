<?php
session_cache_limiter(false);
session_start();

// enable on-demand class loader
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    DB::$dbName = 'eshop';
    DB::$user = 'eshop';
    DB::$password = 'FvUVdCWTv8GuWshh';
    DB::$host = '127.0.0.1';   // sometimes needed on Mac OSX
    DB::$port = 3333;
} else { // hosted on external server
    DB::$dbName = 'cp4724_slimshop';
    DB::$user = 'cp4724_slimshop';
    DB::$password = 'FvUVdCWTv8GuWshh';
    DB::$port = 3306;
}
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query broke
}

// instantiate Slim - router in front controller (this file)
// Slim creation and setup
$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
        ));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');


if (!isset($_SESSION['eshopuser'])) {
    $_SESSION['eshopuser'] = array();
}

$twig = $app->view()->getEnvironment();
$twig->addGlobal('sessionUser', $_SESSION['eshopuser']);

$app->get('/', function() use ($app) {
    $app->render('index.html.twig');
});

// State 1: first show
$app->get('/register', function() use ($app, $log) {
    $app->render('register.html.twig');
});
// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $valueList = array('name' => $name, 'email' => $email);
    // submission received - verify
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
        unset($valueList['name']);
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    } else {
        $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);
        if ($user) {
            array_push($errorList, "Email already registered");
            unset($valueList['email']);
        }
    }
    // ALTERNATIVE: if (($msg = verifyPassword($pass1)) !== TRUE) {
    $msg = verifyPassword($pass1);
    if ($msg !== TRUE) {
        array_push($errorList, $msg);
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    //
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('register.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('users', array(
            'name' => $name, 
            'email' => $email,
            'password' => password_hash($pass1, CRYPT_BLOWFISH)
                // 'password' => hash('sha256', $pass1)
        ));
        $id = DB::insertId();
        $log->debug(sprintf("User %s created", $id));
        $app->render('eshop.html.twig');
    }
});

$app->get('/login', function() use ($app, $log) {
    $app->render('login.html.twig');
});

$app->post('/login', function() use ($app, $log) {
    $name = $app->request->post('name');
    $pass = $app->request->post('pass');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE name=%s", $name);
//    print_r($user);
    if (!$user) {
        $log->debug(sprintf("User failed for username %s from IP %s", $name, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        if(crypt($pass, $user['password']) == $user['password']) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['eshopuser'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
            if($user['role'] === 'admin') {
               $app->render('admin_user.html.twig',array(
                            "eshopuser" => $_SESSION['eshopuser']
                )); 
            }else {
                $app->render('eshop.html.twig',array(
                            "eshopuser" => $_SESSION['eshopuser']
                ));
            }
            
        } else {
            $log->debug(sprintf("User failed for username %s from IP %s", $name, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['eshopuser'] = array();
    $app->render('eshop.html.twig');
});

$app->get('/cart', function() use ($app) {
    $cartitemList = DB::query(
                    "SELECT cartitems.ID as ID, productID, quantity,"
                    . " name, description, imagePath, price "
                    . " FROM cartitems, products "
                    . " WHERE cartitems.productID = products.ID AND sessionID=%s", session_id());
    $app->render('cart.html.twig', array(
        'cartitemList' => $cartitemList
    ));
});

$app->post('/cart', function() use ($app) {
    $productID = $app->request()->post('productID');
    $quantity = $app->request()->post('quantity');
    // FIXME: make sure the item is not in the cart yet
    $item = DB::queryFirstRow("SELECT * FROM cartitems WHERE productID=%d AND sessionID=%s", $productID, session_id());
    if ($item) {
        DB::update('cartitems', array(
            'sessionID' => session_id(),
            'productID' => $productID,
            'quantity' => $item['quantity'] + $quantity
                ), "productID=%d AND sessionID=%s", $productID, session_id());
    } else {
        DB::insert('cartitems', array(
            'sessionID' => session_id(),
            'productID' => $productID,
            'quantity' => $quantity
        ));
    }
    // show current contents of the cart
    $cartitemList = DB::query(
                    "SELECT cartitems.ID as ID, productID, quantity,"
                    . " name, description, imagePath, price "
                    . " FROM cartitems, products "
                    . " WHERE cartitems.productID = products.ID AND sessionID=%s", session_id());
    $app->render('cart.html.twig', array(
        'cartitemList' => $cartitemList
    ));
});

// AJAX call, not used directy by eshopuser
$app->get('/cart/update/:cartitemID/:quantity', function($cartitemID, $quantity) use ($app) {
    if ($quantity == 0) {
        DB::delete('cartitems', 'cartitems.ID=%d AND cartitems.sessionID=%s', $cartitemID, session_id());
    } else {
        DB::update('cartitems', array('quantity' => $quantity), 'cartitems.ID=%d AND cartitems.sessionID=%s', $cartitemID, session_id());
    }
    echo json_encode(DB::affectedRows() == 1);
});

// order handling
$app->map('/order', function () use ($app) {
    $totalBeforeTax = DB::queryFirstField(
                    "SELECT SUM(products.price * cartitems.quantity) "
                    . " FROM cartitems, products "
                    . " WHERE cartitems.sessionID=%s AND cartitems.productID=products.ID", session_id());
    // TODO: properly compute taxes, shipping, ...
    $shippingBeforeTax = 15.00;
    $taxes = ($totalBeforeTax + $shippingBeforeTax) * 0.15;
    $totalWithShippingAndTaxes = $totalBeforeTax + $shippingBeforeTax + $taxes;

    if ($app->request->isGet()) {
        $app->render('order.html.twig', array(
            'totalBeforeTax' => number_format($totalBeforeTax, 2),
            'shippingBeforeTax' => number_format($shippingBeforeTax, 2),
            'taxes' => number_format($taxes, 2),
            'totalWithShippingAndTaxes' => number_format($totalWithShippingAndTaxes, 2)
        ));
    } else {
        $name = $app->request->post('name');
        $email = $app->request->post('email');
        $address = $app->request->post('address');
        $postalCode = $app->request->post('postalCode');
        $phoneNumber = $app->request->post('phoneNumber');
        $valueList = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'postalCode' => $postalCode,
            'phoneNumber' => $phoneNumber
        );
        // FIXME: verify inputs - MUST DO IT IN A REAL SYSTEM
        $errorList = array();
        //
        if ($errorList) {
            $app->render('order.html.twig', array(
                'totalBeforeTax' => number_format($totalBeforeTax, 2),
                'shippingBeforeTax' => number_format($shippingBeforeTax, 2),
                'taxes' => number_format($taxes, 2),
                'totalWithShippingAndTaxes' => number_format($totalWithShippingAndTaxes, 2),
                'v' => $valueList
            ));
        } else { // SUCCESSFUL SUBMISSION
            DB::$error_handler = FALSE;
            DB::$throw_exception_on_error = TRUE;
            // PLACE THE ORDER
            try {
                DB::startTransaction();
                // 1. create summary record in 'orders' table (insert)
                DB::insert('orders', array(
                    'userID' => $_SESSION['eshopuser'] ? $_SESSION['eshopuser']['ID'] : NULL,
                    'name' => $name,
                    'address' => $address,
                    'postalCode' => $postalCode,
                    'email' => $email,
                    'phoneNumber' => $phoneNumber,
                    'totalBeforeTax' => $totalBeforeTax,
                    'shippingBeforeTax' => $shippingBeforeTax,
                    'taxes' => $taxes,
                    'totalWithShippingAndTaxes' => $totalWithShippingAndTaxes,
                    'dateTimePlaced' => date('Y-m-d H:i:s')
                ));
                $orderID = DB::insertId();
                // 2. copy all records from cartitems to 'orderitems' (select & insert)
                $cartitemList = DB::query(
                                "SELECT productID as origProductID, quantity, price"
                                . " FROM cartitems, products "
                                . " WHERE cartitems.productID = products.ID AND sessionID=%s", session_id());
                // add orderID to every sub-array (element) in $cartitemList
                array_walk($cartitemList, function(&$item, $key) use ($orderID) {
                    $item['orderID'] = $orderID;
                });
                /* This is the same as the following foreach loop:
                  foreach ($cartitemList as &$item) {
                  $item['orderID'] = $orderID;
                  } */
                DB::insert('orderitems', $cartitemList);
                // 3. delete cartitems for this user's session (delete)
                DB::delete('cartitems', "sessionID=%s", session_id());
                DB::commit();
                // TODO: send a confirmation email
                /*
                  $emailHtml = $app->view()->getEnvironment()->render('email_order.html.twig');
                  $headers = "MIME-Version: 1.0\r\n";
                  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                  mail($email, "Order " .$orderID . " placed ", $emailHtml, $headers);
                 */
                //
                $app->render('order_success.html.twig');
            } catch (MeekroDBException $e) {
                DB::rollback();
                sql_error_handler(array(
                    'error' => $e->getMessage(),
                    'query' => $e->getQuery()
                ));
            }
        }
    }
})->via('GET', 'POST');

// PASSWOR RESET

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$app->map('/passreset', function () use ($app, $log) {
    // Alternative to cron-scheduled cleanup
    if (rand(1,1000) == 111) {
        // TODO: do the cleanup 1 in 1000 accessed to /passreset URL
    }
    if ($app->request()->isGet()) {
        $app->render('passreset.html.twig');
    } else {
        $email = $app->request()->post('email');
        $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
        if ($user) {
            $app->render('passreset_success.html.twig');
            $secretToken = generateRandomString(50);
            // VERSION 1: delete and insert
            /*
              DB::delete('passresets', 'userID=%d', $user['ID']);
              DB::insert('passresets', array(
              'userID' => $user['ID'],
              'secretToken' => $secretToken,
              'expiryDateTime' => date("Y-m-d H:i:s", strtotime("+5 hours"))
              )); */
            // VERSION 2: insert-update TODO
            DB::insertUpdate('passresets', array(
                'userID' => $user['ID'],
                'secretToken' => $secretToken,
                'expiryDateTime' => date("Y-m-d H:i:s", strtotime("+5 minutes"))
            ));
            // email user
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/passreset/' . $secretToken;
            $html = $app->view()->render('email_passreset.html.twig', array(
                'name' => $user['name'],
                'url' => $url
            ));
            $headers = "MIME-Version: 1.0\r\n";
            $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers.= "From: Noreply <noreply@ipd8.info>\r\n";
            $headers.= "To: " . htmlentities($user['name']) . " <" . $email . ">\r\n";

            mail($email, "Password reset from SlimShop", $html, $headers);
        } else {
            $app->render('passreset.html.twig', array('error' => TRUE));
        }
    }
})->via('GET', 'POST');

$app->get('/scheduled/daily', function() use ($app, $log) {
    DB::$error_handler = FALSE;
    DB::$throw_exception_on_error = TRUE;
            // PLACE THE ORDER
    $log->debug("Daily scheduler run started");
    // 1. clean up old password reset requests
    try {
        DB::delete('passresets', "expiryDateTime < NOW()");    
        $log->debug("Password resets clean up, removed " . DB::affectedRows());
    } catch (MeekroDBException $e) {
        sql_error_handler(array(
                    'error' => $e->getMessage(),
                    'query' => $e->getQuery()
                ));
    }
    // 2. clean up old cart items (normally we never do!)
    try {
        DB::delete('cartitems', "createdTS < DATE(DATE_ADD(NOW(), INTERVAL -1 DAY))");
    } catch (MeekroDBException $e) {
        sql_error_handler(array(
                    'error' => $e->getMessage(),
                    'query' => $e->getQuery()
                ));
    }
    $log->debug("Cart items clean up, removed " . DB::affectedRows());
    $log->debug("Daily scheduler run completed");
    echo "Completed";
});

$app->map('/passreset/:secretToken', function($secretToken) use ($app) {
    $row = DB::queryFirstRow("SELECT * FROM passresets WHERE secretToken=%s", $secretToken);
    if (!$row) {
        $app->render('passreset_notfound_expired.html.twig');
        return;
    }
    if (strtotime($row['expiryDateTime']) < time()) {
        $app->render('passreset_notfound_expired.html.twig');
        return;
    }
    //
    if ($app->request()->isGet()) {
        $app->render('passreset_form.html.twig');
    } else {
        $pass1 = $app->request()->post('pass1');
        $pass2 = $app->request()->post('pass2');
        // TODO: verify password quality and that pass1 matches pass2
        $errorList = array();
        $msg = verifyPassword($pass1);
        if ($msg !== TRUE) {
            array_push($errorList, $msg);
        } else if ($pass1 != $pass2) {
            array_push($errorList, "Passwords don't match");
        }
        //
        if ($errorList) {
            $app->render('passreset_form.html.twig', array(
                'errorList' => $errorList
            ));
        } else {
            // success - reset the password
            DB::update('users', array(
                'password' => password_hash($pass1, CRYPT_BLOWFISH)
                    ), "ID=%d", $row['userID']);
            DB::delete('passresets','secretToken=%s', $secretToken);
            $app->render('passreset_form_success.html.twig');
        }
    }
})->via('GET', 'POST');


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

/*
  // ALTERNATIVE: provide product/quantitiy in URL
  $app->get('/cart/add/:productID/:quantity', function() use ($app) {
  }); */


$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if ($user) {
        echo "Email already registered";
    }
});

// returns TRUE if password is strong enough,
// otherwise returns string describing the problem
function verifyPassword($pass1) {
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        return "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character";
    }
    return TRUE;
}

$app->get('/index', function() use ($app) {
    $app->render('index.html.twig');
});

$app->get('/category', function() use ($app) {
    $app->render('category.html.twig');
});

$app->get('/product', function() use ($app) {
    $app->render('product.html.twig');
});

$app->get('/contact', function() use ($app) {
    $app->render('contact.html.twig');
});

$app->get('/eshop', function() use ($app) {
    $app->render('eshop.html.twig');
});

$app->get('/about', function() use ($app) {
    $app->render('about.html.twig');
});

$app->get('/services', function() use ($app) {
    $app->render('services.html.twig');
});

$app->get('/register', function() use ($app) {
    $app->render('register.html.twig');
});

$app->get('/admin', function() use ($app) {
    $app->render('admin_panel.html.twig');
});

$app->get('/admin_user', function() use ($app) {
    $app->render('admin_user.html.twig');
    
});$app->get('/admin_category', function() use ($app) {
    $app->render('admin_category.html.twig');
    
});$app->get('/admin_order', function() use ($app) {
    $app->render('admin_order.html.twig');
});

$app->run();
