<?php 
    namespace Adapters;

    use Repository\CategoryRepoInterface;
    use Entities\Category;

    class CategoryRepository implements CategoryRepoInterface {
        private $db;

        public function __construct(getConnection $db) {
            $this->db = $db;
        } 

        public function add(Product $product):void {
            $query = 'INSERT INTO categories code = :code, name = :name';
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':code', $product->getCode());
            $stmt->bindParam(':name', $product->getName());

            $stmt->execute();
        }

        public function find(string $code):Category {
            $query = 'SELECT code, name FROM categories';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            foreach($stmt as $item) {
                return new Product($item['code'],$item['name']);
            }
        }
    }
?>