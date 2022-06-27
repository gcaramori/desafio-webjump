<?php
    use Pecee\SimpleRouter\SimpleRouter;
    use Controllers\ProductController;
    use Controllers\CategoryController;

    require_once 'helpers.php';

    //Render Routes
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

    //API
    SimpleRouter::post('/products/add', [ProductController::class, 'add'])->setName('add');
    SimpleRouter::get('/products/find/{id}', [ProductController::class, 'find'])->setName('find');

    SimpleRouter::start();
?>