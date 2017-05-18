<?php

$app->get('/category', function() use ($app) {
    $categoryList =  DB::query("SELECT * FROM categories");
    $categoryFirst =  DB::queryFirstRow("SELECT * FROM categories");
    $productList =  DB::query("SELECT * FROM products WHERE catId=%s",$categoryFirst['ID']);
    $app->render('category.html.twig', array(
        'categoryList' => $categoryList, 
        'productList' => $productList,
        "eshopuser" => $_SESSION['eshopuser']
    ));
});

