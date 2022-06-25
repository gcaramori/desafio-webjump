<?php 
    namespace Api;

    use Pecee\SimpleRouter\SimpleRouter;
    use Api\Controllers\ProductController;
    use Api\Controllers\CategoryController;

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
    SimpleRouter::post('/products/add', [ProductController::class, 'add']);
    SimpleRouter::post('/products/find', [ProductController::class, 'find']);

    SimpleRouter::post('/categories/add', [CategoryController::class, 'add']);
    SimpleRouter::post('/categories/find', [CategoryController::class, 'find']);

    SimpleRouter::start();
?>