<?php 
    namespace Adapters;

    use \Repository\CategoryRepoInterface;
    use \Entities\Category;

    class CategoryRepository implements CategoryRepoInterface {
        private $db;

        public function __construct() {
            $this->db = new \Dependencies\Database;
            $this->db = $this->db->connect();
        } 

        public function add(Category $category) {
            try {
                $query = 'INSERT INTO categories (code, name) VALUES (:code, :name)';
                $stmt = $this->db->prepare($query);

                $stmt->bindValue(':code', $category->getCode());
                $stmt->bindValue(':name', $category->getName());
                
                return $stmt->execute();
            }
            catch(Exception $e) {
                return $e;
            }
        }

        public function find(string $code) {
            $query = 'SELECT * FROM categories WHERE code=:code';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':code', $code);
            $stmt->execute();
            
            $category = $stmt->fetch(\PDO::FETCH_ASSOC);

            return new Category($category['code'], $category['name']);
        }

        public function findAll() {
            $query = 'SELECT * FROM categories';
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $categories = array();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);

                array_push($categories, [
                    'code' => $code,
                    'name' => $name
                ]);
            }

            return $categories;
        }

        public function update(Category $category) {
            try {
                $query = 'UPDATE categories SET name=:name WHERE code=:code';
                $stmt = $this->db->prepare($query);

                $stmt->bindValue(':code', $category->getCode());
                $stmt->bindValue(':name', $category->getName());
                
                return $stmt->execute();
            }
            catch(Exception $e) {
                return $e;
            }
        }

        public function delete(string $code) {
            try {
                $query = 'DELETE FROM categories WHERE code=:code';
                $stmt = $this->db->prepare($query);

                $stmt->bindValue(':code', $code);
                
                return $stmt->execute();
            }
            catch(Exception $e) {
                return $e;
            }
        }
    }
?>