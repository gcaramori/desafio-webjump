<?php 
    namespace App\Controllers;

    use Pecee\Http\Response;
    use Pecee\Http\Request;
    use App\Entities\Product;
    use App\UseCases\ProductManager;

    class ProductController {
        private $productManager;

        public function __construct(ProductManager $productManager) {
            $this->productManager = $productManager;
        }

        public function add(Request $request, Response $response) {
            $json = $request->getBody();
            $obj = json_decode($json, true);
            
            $product = new Product($obj->sku, $obj->name, $obj->price, $obj->description, $obj->quantity);
            $this->productManager->add($product);
            
            return $response;
        }

        public function find(Response $response, $sku) {
            $product = $this->productManager->find($sku);
            return $response;
        }
    }
?>