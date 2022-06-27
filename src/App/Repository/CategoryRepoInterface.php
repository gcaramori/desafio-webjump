<?php 
    namespace Repository;

    use \Entities\Category;

    interface CategoryRepoInterface {
        public function add(Category $category):void;
        public function find(string $code):Category;
    }
?>