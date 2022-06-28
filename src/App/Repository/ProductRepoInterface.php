<?php 
    namespace Repository;

    use \Entities\Product;

    interface ProductRepoInterface {
        public function add(Product $product);
        public function find(string $sku);
        public function findAll();
        public function update(Product $product);
        public function delete(string $sku);
    }
?>