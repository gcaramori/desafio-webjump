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

        public function add(Product $product) {
            try {
                $query = 'INSERT INTO products (sku, name, price, description, quantity) VALUES (:sku, :name, :price, :description, :quantity)';
                $stmt = $this->db->prepare($query);

                $stmt->bindValue(':sku', $product->getSku());
                $stmt->bindValue(':name', $product->getName());
                $stmt->bindValue(':price', $product->getPrice());
                $stmt->bindValue(':description', $product->getDescription());
                $stmt->bindValue(':quantity', $product->getQuantity());
                
                return $stmt->execute();
            }
            catch(Exception $e) {
                return $e;
            }
        }

        public function find(string $sku) {
            $query = 'SELECT sku, name, price, description, quantity FROM products WHERE sku=:sku';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':sku', $sku);
            $stmt->execute();
            
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);

            return new Product($product['sku'], $product['name'], $product['price'], $product['description'], $product['quantity']);
        }
    }
?>