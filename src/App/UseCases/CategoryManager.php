<?php 
    namespace UseCases;

    use \Entities\Category;

    class CategoryManager {
        private $categoryRepository;

        public function __construct() {
            $this->categoryRepository = new \Adapters\CategoryRepository;
        }

        public function add(Category $category) {
            return $this->categoryRepository->add($category);
        }
        
        public function find(string $code) {
            return $this->categoryRepository->find($code);
        }

        public function findAll() {
            return $this->categoryRepository->findAll();
        }

        public function update(Category $category) {
            return $this->categoryRepository->update($category);
        }

        public function delete(string $code) {
            return $this->categoryRepository->delete($code);
        }
    }
?>