<?php 
    namespace Repository;

    use \Entities\Category;

    interface CategoryRepoInterface {
        public function add(Category $category);
        public function find(string $code);
        public function findAll();
        public function update(Category $category);
        public function delete(string $code);
    }
?>