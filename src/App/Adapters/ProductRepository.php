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
                
                if($stmt->execute()) {
                    $categories = explode(',', $product->getCategories());

                    foreach($categories as $category) {
                        $query = 'INSERT INTO products_categories (product_id, category_id) VALUES (:product_id, :category_id)';
                        $stmt = $this->db->prepare($query);

                        $stmt->bindValue(':product_id', $product->getSku());
                        $stmt->bindValue(':category_id', $category);
                    }

                    return $stmt->execute();
                }
            }
            catch(Exception $e) {
                return $e;
            }
        }

        public function find(string $sku) {
            $query = '
                SELECT p.*, c.code AS category_id FROM products AS p
                INNER JOIN products_categories AS pc 
                INNER JOIN categories AS c 
                ON p.sku = pc.product_id 
                AND c.code = pc.category_id
                WHERE p.sku=:sku
            ';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':sku', $sku);
            $stmt->execute();
            
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);

            return new Product($product['sku'], $product['name'], $product['price'], $product['category_id'], $product['description'], $product['quantity']);
        }

        public function findAll() {
            $query = '
                SELECT p.*, c.name AS category_name FROM products AS p
                INNER JOIN products_categories AS pc 
                INNER JOIN categories AS c 
                ON p.sku = pc.product_id 
                AND c.code = pc.category_id
            ';
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $products = array();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);

                array_push($products, [
                    'sku' => $sku,
                    'name' => $name,
                    'price' => $price,
                    'category' => $category_name,
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