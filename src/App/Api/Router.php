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
        $productController = new ProductController();
        $products = $productController->findAll();

        include_once __DIR__.'/../../public/views/products.php';
    });
    SimpleRouter::get('/products_add', function() {
        include_once __DIR__.'/../../public/views/addProduct.php';
    });
    SimpleRouter::get('/products_edit/{id}', function($sku) {
        $productController = new ProductController();
        $product = json_decode($productController->find($sku), true);

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
    SimpleRouter::post('/products/update/{id}', [ProductController::class, 'update'])->setName('update');
    SimpleRouter::get('/products/delete/{id}', [ProductController::class, 'delete'])->setName('delete');

    SimpleRouter::start();
?>