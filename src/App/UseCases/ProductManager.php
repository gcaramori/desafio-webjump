<?php 
    namespace App\UseCases;

    use App\Entities\Product;
    use App\Repository\ProductRepoInterface;

    class ProductManager {
        private $productRepository;

        public function __construct(ProductRepoInterface $productRepository) {
            $this->productRepository = $productRepository;
        }

        public function add(Product $product):void {
            $this->productRepository->add($product);
        }
        
        public function find(string $sku):Product {
            $this->productRepository->find($sku);
        }
    }
?>