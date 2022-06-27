<?php 
    namespace Repository;

    use \Entities\Product;

    interface ProductRepoInterface {
        public function add(Product $product):void;
        public function find(string $sku):Product;
    }
?>