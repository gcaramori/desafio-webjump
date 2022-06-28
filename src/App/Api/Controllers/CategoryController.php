<?php 
    namespace Controllers;

    use \Entities\Category;
    use \UseCases\CategoryManager;

    class CategoryController {
        private $categoryManager;

        public function __construct() {
            $this->categoryManager = new \UseCases\CategoryManager;
        }

        public function add() { 
            $formData = input()->all([
                'category-code',
                'category-name'
            ]);
            
            $category = new \Entities\Category($formData['category-code'], $formData['category-name']);
            $result = $this->categoryManager->add($category);
            
            if($result === true) {
                echo '
                    <script>
                        alert("Categoria inserida com sucesso!");
                        window.location = "/categories";
                    </script>
                ';
            }
            else {
                echo '
                    <script>
                        alert("Erro ao inserir categoria!");
                        window.location = "/categories_add";
                    </script>
                ';
            }   
        }

        public function find($code) {
            $category = $this->categoryManager->find($code);
            
            return json_encode([
                'code' => $category->getCode(),
                'name' => $category->getName()
            ]);
        }

        public function findAll() {
            $categories = $this->categoryManager->findAll();

            return $categories;
        }

        public function update($code) {
            $category = new \Entities\Category($code, input('category-name'));
            $result = $this->categoryManager->update($category);
            
            if($result === true) {
                echo '
                    <script>
                        alert("Categoria atualizada com sucesso!");
                        window.location = "/categories";
                    </script>
                ';
            }
            else {
                echo '
                    <script>
                        alert("Erro ao atualizar categoria!");
                        window.location = "/categories";
                    </script>
                ';
            }
        }
        
        public function delete($code) {
            $result = $this->categoryManager->delete($code);

            if($result === true) {
                echo '
                    <script>
                        alert("Categoria deletada com sucesso!");
                        window.location = "/categories";
                    </script>
                ';
            }
            else {
                echo '
                    <script>
                        alert("Erro ao deletar categoria!");
                        window.location = "/categories";
                    </script>
                ';
            }
        }
    }
?>