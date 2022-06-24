<?php 
    namespace App\Repository;

    use App\Entities\Product;

    interface ProductRepoInterface {
        public function add(Product $product):void;
        public function find(string $sku):Product;
    }
?>