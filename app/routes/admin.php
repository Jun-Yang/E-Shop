<?php

$app->get('/admin_product', function() use ($app) {
    $app->render('admin_panel.html.twig');
});

$app->get('/admin_user', function() use ($app) {
    $userList =  DB::query("SELECT * FROM users");
    $app->render("admin_user.html.twig", array(
        'userList' => $userList
    ));
});

$app->post('/admin_user', function() use ($app) {
    $userList =  DB::query("SELECT * FROM users");
    $app->render("admin_user.html.twig", array(
        'userList' => $userList
    ));
});

$app->get('/admin_category', function() use ($app) {
    $categoryList =  DB::query("SELECT * FROM categories");
    $app->render("admin_category.html.twig", array(
        'categoryList' => $categoryList
    ));
});

$app->get('/admin_order', function() use ($app) {
    $orderList =  DB::query("SELECT * FROM orders");
    $app->render("admin_order.html.twig", array(
        'orderList' => $orderList
    ));
});

