<?php 
    namespace App\Adapters;

    use App\Repository\ProductRepoInterface;
    use App\Entities\Product;

    class ProductRepository implements ProductRepoInterface {
        private $db;

        public function __construct(getConnection $db) {
            $this->db = $db;
        } 

        public function add(Product $product):void {
            $query = 'INSERT INTO products sku = :sku, name = :name, price = :price, description = :description, quantity = :quantity';
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':sku', $product->getSku());
            $stmt->bindParam(':name', $product->getName());
            $stmt->bindParam(':price', $product->getPrice());
            $stmt->bindParam(':description', $product->getDescription());
            $stmt->bindParam(':quantity', $product->getQuantity());

            $stmt->execute();
        }

        public function find(string $sku):Product {
            $query = 'SELECT sku, name, price, description, quantity FROM products';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            foreach($stmt as $item) {
                return new Product($item['sku'],$item['name'],$item['pric'],$item['email']);
            }
        }
    }
?>