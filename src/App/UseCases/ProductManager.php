<?php 
    namespace UseCases;

    use \Entities\Product;

    class ProductManager {
        private $productRepository;

        public function __construct() {
            $this->productRepository = new \Adapters\ProductRepository;
        }

        public function add(Product $product) {
            return $this->productRepository->add($product);
        }
        
        public function find(string $sku) {
            return $this->productRepository->find($sku);
        }
    }
?>