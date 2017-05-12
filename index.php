<?php

session_cache_limiter(false);
session_start();

require_once 'vendor/autoload.php';

//DB::$host = '127.0.0.1';
//OldPassword: ya4Ki9TUSaRATOhq  7qJtprZ2wqz5mqxD  L9Ts9LGTKVVJw3z6
DB::$user = 'slimtodo';
DB::$password = '7qJtprZ2wqz5mqxD';
DB::$dbName = 'slimtodo';
DB::$port = 3333;
DB::$encoding = 'utf8';

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

if (!isset($_SESSION['todouser'])) {
    $_SESSION['todouser'] = array();
}

$twig = $app->view()->getEnvironment();
$twig->addGlobal('todouser', $_SESSION['todouser']);

// STATE 1: First show
$app->get('/register', function() use ($app) {
    $app->render('register.html.twig');
});

// Receiving a submission
$app->post('/register', function() use ($app) {
    // extract variables
    $name = $app->request()->post('name');
    $email = $app->request()->post('email');
    $pass1 = $app->request()->post('pass1');
    $pass2 = $app->request()->post('pass2');
    // list of values to retain after a failed submission
    $valueList = array('email' => $email);
    // check for errors and collect error messages
    $errorList = array();
    if(strlen($name) < 3) {
        array_push($errorList, "name too short, must be 3 characters or longer");
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email is invalid");
    } else {
        $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
        if ($user) {
            array_push($errorList, "Email already in use");
        }
    }
    if ($pass1 != $pass2) {
        array_push($errorList, "Passwors do not match");
    } else {
        if (strlen($pass1) < 6) {
            array_push($errorList, "Password too short, must be 6 characters or longer");
        } 
        if (preg_match('/[A-Z]/', $pass1) != 1
         || preg_match('/[a-z]/', $pass1) != 1
         || preg_match('/[0-9]/', $pass1) != 1) {
            array_push($errorList, "Password must contain at least one lowercase, "
                    . "one uppercase letter, and a digit");
        }
    }
    //
    if ($errorList) {
        $app->render('register.html.twig', array(
            'errorList' => $errorList,
            'v' => $valueList
        ));
    } else {
        DB::insert('users', array(
            'name' => $name,
            'email' => $email,
            'password' => $pass1
        ));
        $app->render('register_success.html.twig');
    }
});

// AJAX: Is user with this email already registered?
$app->get('/ajax/emailused/:email', function($email) {
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    //echo json_encode($user, JSON_PRETTY_PRINT);
    echo json_encode($user != null);    
});

// AJAX: Is user with this task name already registered?
$app->get('/ajax/tasknameused/:task', function($task) {
    $todo = DB::queryFirstRow("SELECT * FROM todos WHERE task=%s", $task);
    //echo json_encode($user, JSON_PRETTY_PRINT);
    echo json_encode($todo != null);    
});

$app->get('/', function() use ($app) {
    $app->render('index.html.twig');
});

// HOMEWORK 1: implement login form
$app->get('/login', function() use ($app) {
    $app->render('login.html.twig');
});

$app->post('/login', function() use ($app) {
    print_r($_POST);
    $name = $app->request()->post('name');
    $password = $app->request()->post('password');
    // verification    
    $error = false;
    $user = DB::queryFirstRow("SELECT * FROM users WHERE name=%s", $name);
    if (!$user) {
        $error = true;
    } else {
        if ($user['password'] != $password) {
            $error = true;
        }
    }
    // decide what to render
    if ($error) {
        $app->render('login.html.twig', array("error" => true));
    } else {
        unset($user['password']);
        $_SESSION['todouser'] = $user;
        $app->render('login_success.html.twig');
    }
});

$app->get('/logout', function() use ($app) {
    unset($_SESSION['todouser']);
//    session_destroy();
    $app->render('logout.html.twig');
});

// HOMEWORK 2: find and implement any tutorial about PHP file upload.
// create a new pure-PHP project to do it in


$app->get('/add', function() use ($app) {
    if (!$_SESSION['todouser']) {
        $app->render('forbidden.html.twig');
        return;
    }
    $app->render('add.html.twig');
});

$app->post('/add', function() use ($app) {
    if (!$_SESSION['todouser']) {
        $app->render('forbidden.html.twig');
        return;
    }
//    print_r($_POST);
    $task = $app->request()->post('task');
    $dueDate = $app->request()->post('dueDate');
    $isDone = $app->request()->post('isDone');
    //
    $errorList = array();
    $valueList = array('task' => $task);
    
    if (strlen($task) < 2 || strlen($task) > 100 ) {
        array_push($errorList, "Task name must be 2-100 characters long");        
    }else {
        $todo = DB::queryFirstRow("SELECT * FROM todos WHERE task=%s", $task);
        if ($todo) {
            array_push($errorList, "Task name already in use");
        }
    }
    
    $today = date("Y-m-d");
    if ($dueDate < $today) {
        array_push($errorList, "Due date must be after today");        
    }
//    print_r($_SESSION['todouser']);
    if ($errorList) {
        $app->render("add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
            ]);
    } else {      
        DB::insert('todos', ["ownerId" => $_SESSION['todouser']['id'],
            "task" => $task,
            "dueDate" => $dueDate,
            "isDone" => $isDone
            ]);
        $app->render("add_success.html.twig", array(
            "task" => $task
        ));
    }    
});

$app->get('/delete/:id', function($id) use ($app) {
    if (!$_SESSION['todouser']) {
        $app->render('login.html.twig');
        return;
    }
    $todo = DB::queryFirstRow("SELECT * FROM todos where id = %i", $id);
    $app->render('delete.html.twig', ["todo" => $todo]);
});

$app->post('/delete/:id', function($id) use ($app) {
   if (!$_SESSION['todouser']) {
        $app->render('forbidden.html.twig');
        return;
    }
//    print_r($_POST);
    DB::delete('todos',"id=%i", $id);
    $app->render("delete_success.html.twig", array(
        "id" => $id
    ));
});

// HOMEWORK: implement a table of existing todos with links for editing
$app->get('/list', function() use ($app) {
    if (!$_SESSION['todouser']) {
        $app->render('login.html.twig');
        return;
    }
    $todos = DB::query("SELECT * FROM todos where ownerId = %i", $_SESSION['todouser']['id']);
//    print_r($todos);
    $app->render("list.html.twig", ["todos" => $todos]);    
});

// HOMEWORK: implement UPDATE/edit of an existing todo
$app->get('/edit/:id', function($id) use ($app) {
    if (!$_SESSION['todouser']) {
        $app->render('login.html.twig');
        return;
    }
    $todo = DB::queryFirstRow("SELECT * FROM todos where id = %i", $id);
    $app->render('edit.html.twig', ["todo" => $todo]);
});

// NOTE: allow user NOT to replace image with a new one
// in other words if no image is uploaded you keep the existing one
$app->post('/edit/:id', function($id) use ($app) {
    if (!$_SESSION['todouser']) {
        $app->render('login.html.twig');
        return;
    }
//    print_r($_POST);
    $task = $app->request()->post('task');
    $dueDate = $app->request()->post('dueDate');
    $isDone = $app->request()->post('isDone');
    //
    $errorList = array();
    $todo = array('task' => $task,
                  "dueDate" => $dueDate,
                  "isDone" => $isDone);
    
    if (strlen($task) < 2 || strlen($task) > 100 ) {
        array_push($errorList, "Task name must be 2-100 characters long");        
    }else {
        $todo = DB::queryFirstRow("SELECT * FROM todos WHERE task=%s", $task);
        if ($todo) {
            array_push($errorList, "Task name already in use");
        }
    }
    
    $today = date("Y-m-d");
    if ($dueDate < $today) {
        array_push($errorList, "Due date must be after today");        
    }
//    print_r($_SESSION['todouser']);
    if ($errorList) {
        $app->render("edit.html.twig", ["errorList" => $errorList,
            "todo" => $todo]);
    } else {      
        DB::update('todos', ["ownerId" => $_SESSION['todouser']['id'],
            "task" => $task,
            "dueDate" => $dueDate,
            "isDone" => $isDone
            ],"id=%i", $id);
        $app->render("edit_success.html.twig", array(
            "task" => $task
        ));
    }
});

$app->get('/admin/product/add', function() use ($app) {
    $app->render("admin_product_add.html.twig");    
});

$app->post('/admin/product/add', function() use ($app) {
    $name = $app->request()->post('name');
    $description = $app->request()->post('description');
    $image = isset($_FILES['image']) ? $_FILES['image'] : array();
    //
    $errorList = array();
    if (strlen($name) < 2 || strlen($name) > 100 ) {
        array_push($errorList, "Name must be 2-100 characters long");        
    }
    if (strlen($description) < 2 || strlen($description) > 1000 ) {
        array_push($errorList, "Description must be 2-1000 characters long");        
    }
    if (!$image) {
        array_push($errorList, "Image is required to create a todo");
    } else {
        $imageInfo = getimagesize($image["tmp_name"]);
        if (!$imageInfo) {
            array_push($errorList, "File does not look like an valid image");
        }
    }
    //
    if ($errorList) {
        $app->render("admin_todo_add.html.twig", array(
            "errorList" => $errorList
        ));
    } else {      
        // FIXME: opened a security hole here! ..
        $imagePath = "uploads/" . $image['name'];
        move_uploaded_file($image["tmp_name"], $imagePath);
        DB::insert('products', array(
            "name" => $name,
            "description" => $description,
            "imagePath" => $imagePath
        ));
        $app->render("admin_product_add_success.html.twig", array(
            "imagePath" => $imagePath
        ));
    }    
});


$app->run();
