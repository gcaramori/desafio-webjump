<?php 
    namespace Api;

    use Pecee\SimpleRouter\SimpleRouter;

    SimpleRouter::get('/', function() {
        include_once __DIR__.'/../../public/views/dashboard.php';
    });
    SimpleRouter::get('/products', function() {
        include_once __DIR__.'/../../public/views/products.php';
    });
    SimpleRouter::get('/products_add', function() {
        include_once __DIR__.'/../../public/views/addProduct.php';
    });
    SimpleRouter::get('/categories', function() {
        include_once __DIR__.'/../../public/views/categories.php';
    });
    SimpleRouter::get('/categories_add', function() {
        include_once __DIR__.'/../../public/views/addCategory.php';
    });

    SimpleRouter::start();
?>