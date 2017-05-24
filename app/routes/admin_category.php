<?php
//$app->get('/admin/product/:op(/:id)', function($op, $id = 0) use ($app) {
//Admin_Panel->Manage Category->Add Category
$app->get('/admin/category/list', function() use ($app) {
    
    $categoryList =  DB::query("SELECT * FROM categories");
    $app->render("admin_category_list.html.twig", array(
        'categoryList' => $categoryList
    ));
});

$app->get('/admin/category/:op(/:id)', function($op, $id = 0) use ($app) {
     print_r($id);
    if ($op == 'edit') {
        $category = DB::queryFirstRow("SELECT * FROM categories WHERE id=%i", $id);
        if (!$category) {
            echo 'category not found';
            return;
        }
        print_r($id);
        $app->render("admin_category_add.html.twig", array(
            'v' => $category, 'operation' => 'Update'
        ));
    } else {
        $app->render("admin_category_add.html.twig",
                array('operation' => 'Add'
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));

//$app->post('/admin_category_add', function() use ($app) {
$app->post('/admin/category/:op(/:id)', function($op, $id = 0) use ($app) {
    print_r($id);
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
    
    if (strlen($name) < 2 || strlen($name) > 100) {
      array_push($errorList, "Name must be 2-100 characters long");
    }
    
    $valueList = array('name' => $name);

    if ($errorList) {
        $app->render("admin_category_add.html.twig", ["errorList" => $errorList,
            'v' => $valueList
        ]);
    } else {
       
        if ($op == 'edit') {
            // unlink('') OLD file - requires select
            print_r($op);
            
            DB::update('categories', array(
            "name" => $name, 
            "parent" => $parent,
            "layer" => $layer,
            "description" => $description,
            "status" => $status,
            "postDate" => $today
            ), "id=%i", $id);
        } else {
            DB::insert('categories', array(
            "name" => $name, 
            "parent" => $parent,
            "layer" => $layer,
            "description" => $description,
            "status" => $status,
            "postDate" => $today
        ));
        }
        $app->render("admin_product_success.html.twig", array(
            "name" => $name
            
        ));
    }
})->conditions(array(
    'op' => '(add|edit)',
    'id' => '[0-9]+'));
