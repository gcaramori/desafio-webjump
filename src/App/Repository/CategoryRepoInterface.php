<?php 
    namespace App\Repository;

    use App\Entities\Category;

    interface CategoryRepoInterface {
        public function add(Category $category):void;
        public function find(string $code):Category;
    }
?>