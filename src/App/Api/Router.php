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
        $categoryController = new CategoryController();
        $categories = $categoryController->findAll();
        
        include_once __DIR__.'/../../public/views/addProduct.php';
    });

    SimpleRouter::get('/products_edit/{id}', function($sku) {
        $productController = new ProductController();
        $product = json_decode($productController->find($sku), true);

        include_once __DIR__.'/../../public/views/addProduct.php';
    });

    SimpleRouter::get('/categories', function() {
        $categoryController = new CategoryController();
        $categories = $categoryController->findAll();

        include_once __DIR__.'/../../public/views/categories.php';
    });

    SimpleRouter::get('/categories_add', function() {
        include_once __DIR__.'/../../public/views/addCategory.php';
    });
    
    SimpleRouter::get('/categories_edit/{id}', function($code) {
        $categoryController = new CategoryController();
        $category = json_decode($categoryController->find($code), true);

        include_once __DIR__.'/../../public/views/addCategory.php';
    });

    //API
    SimpleRouter::post('/products/add', [ProductController::class, 'add'])->setName('addProduct');
    SimpleRouter::get('/products/find/{id}', [ProductController::class, 'find'])->setName('findProduct');
    SimpleRouter::post('/products/update/{id}', [ProductController::class, 'update'])->setName('updateProduct');
    SimpleRouter::get('/products/delete/{id}', [ProductController::class, 'delete'])->setName('deleteProduct');

    SimpleRouter::post('/categories/add', [CategoryController::class, 'add'])->setName('addCategory');
    SimpleRouter::get('/categories/find/{id}', [CategoryController::class, 'find'])->setName('findCategory');
    SimpleRouter::post('/categories/update/{id}', [CategoryController::class, 'update'])->setName('updateCategory');
    SimpleRouter::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->setName('deleteCategory');

    SimpleRouter::start();
?>