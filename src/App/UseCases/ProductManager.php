<?php 
    namespace UseCases;

    use \Entities\Product;

    class ProductManager {
        private $productRepository;

        public function __construct() {
            $this->productRepository = new \Adapters\ProductRepository;
        }

        public function add(Product $product):void {
            $this->productRepository->add($product);
        }
        
        public function find(string $sku):Product {
            $this->productRepository->find($sku);
        }
    }
?>