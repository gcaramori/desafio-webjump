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
            $query = 'SELECT * FROM products WHERE sku=:sku';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':sku', $sku);
            $stmt->execute();
            
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);

            return new Product($product['sku'], $product['name'], $product['price'], $product['description'], $product['quantity']);
        }

        public function findAll() {
            $query = 'SELECT * FROM products';
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $products = array();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);

                array_push($products, [
                    'sku' => $sku,
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'quantity' => $quantity
                ]);
            }

            return $products;
        }

        public function update(Product $product) {
            try {
                $query = 'UPDATE products SET name=:name, price=:price, description=:description, quantity=:quantity WHERE sku=:sku';
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

        public function delete(string $sku) {
            try {
                $query = 'DELETE FROM products WHERE sku=:sku';
                $stmt = $this->db->prepare($query);

                $stmt->bindValue(':sku', $sku);
                
                return $stmt->execute();
            }
            catch(Exception $e) {
                return $e;
            }
        }
    }
?>