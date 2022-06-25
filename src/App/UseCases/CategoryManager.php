<?php 
    namespace App\UseCases;

    use App\Entities\Category;
    use App\Repository\CategoryRepoInterface;

    class ProductManager {
        private $categoryRepository;

        public function __construct(CategoryRepoInterface $categoryRepository) {
            $this->categoryRepository = $categoryRepository;
        }

        public function add(Category $category):void {
            $this->categoryRepository->add($category);
        }
        
        public function find(string $code):Category {
            $this->categoryRepository->find($code);
        }
    }
?>