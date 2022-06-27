<?php 
    namespace Controllers;

    class ProductController {
        private $productManager;

        public function __construct() {
            $this->productManager = new \UseCases\ProductManager;
        }

        public function add() {
            if(input()->exists(['sku', 'name', 'price', 'description', 'category', 'quantity'])) {
                $formData = input()->all([
                    'sku',
                    'name',
                    'price',
                    'description',
                    'category',
                    'quantity'
                ]);     

                $product = new \Entities\Product($formData['sku'], $formData['name'], $formData['price'], $formData['description'], $formData['quantity']);
                $this->productManager->add($product);
                
                print_r(response());    
            }
        }

        public function find($sku) {
            $product = $this->productManager->find($sku);
            return $response;
        }
    }
?>