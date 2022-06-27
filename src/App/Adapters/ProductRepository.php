<?php 
    namespace Adapters;

    use \Repository\ProductRepoInterface;
    use \Entities\Product;

    class ProductRepository implements ProductRepoInterface {
        private $db;

        public function __construct() {
            $this->db = new \Dependencies\Database;
            $this->db = $this->db->connect();
        } 

        public function add(Product $product):bool {
            $query = 'INSERT INTO products (sku, name, price, description, quantity) VALUES (:sku, :name, :price, :description, :quantity)';
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':sku', $product->getSku());
            $stmt->bindValue(':name', $product->getName());
            $stmt->bindValue(':price', $product->getPrice());
            $stmt->bindValue(':description', $product->getDescription());
            $stmt->bindValue(':quantity', $product->getQuantity());
            
            return $stmt->execute();
        }

        public function find(string $sku):Product {
            $query = 'SELECT sku, name, price, description, quantity FROM products';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            foreach($stmt as $item) {
                return new Product($item['sku'], $item['name'], $item['price'], $item['description'], $item['quantity']);
            }
        }
    }
?>