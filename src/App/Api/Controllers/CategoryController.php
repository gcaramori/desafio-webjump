<?php 
    namespace Controllers;

    use Pecee\Http\Response;
    use Pecee\Http\Request;
    use Entities\Category;
    use UseCases\CategoryManager;

    class CategoryController {
        private $categoryManager;

        public function __construct(CategoryManager $categoryManager) {
            $this->categoryManager = $categoryManager;
        }

        public function add(Request $request, Response $response) {
            $json = $request->getBody();
            $obj = json_decode($json, true);
            
            $category = new Category($obj->code, $obj->name);
            $this->categoryManager->add($category);
            
            return $response;
        }

        public function find(Response $response, $code) {
            $category = $this->categoryManager->find($code);
            return $response;
        }
    }
?>