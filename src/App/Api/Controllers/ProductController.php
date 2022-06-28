<?php 
    namespace Controllers;

    class ProductController {
        private $productManager;

        public function __construct() {
            $this->productManager = new \UseCases\ProductManager;
        }

        public function add() {
            if(input()->exists(['sku', 'name', 'price', 'description', 'category', 'quantity'])) {
                $formData = input()->all([
                    'sku',
                    'name',
                    'price',
                    'description',
                    'category',
                    'quantity'
                ]);

                $product = new \Entities\Product($formData['sku'], $formData['name'], $formData['price'], $formData['description'], $formData['quantity']);
                $result = $this->productManager->add($product);
                
                if($result === true) {
                    echo '
                        <script>
                            alert("Produto inserido com sucesso!");
                            window.location = "/products";
                        </script>
                    ';
                }
                else {
                    echo '
                        <script>
                            alert("Erro ao inserir produto!");
                            window.location = "/products_add";
                        </script>
                    ';
                }
            }
        }

        public function find($sku) {
            $product = $this->productManager->find($sku);
            
            return json_encode([
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'description' => $product->getDescription(),
                'quantity' => $product->getQuantity()
            ]);
        }

        public function findAll() {
            $products = $this->productManager->findAll();

            return $products;
        }

        public function update($sku) {
            $formData = input()->all([
                'name',
                'price',
                'description',
                'category',
                'quantity'
            ]);
            
            $product = new \Entities\Product($sku, $formData['name'], $formData['price'], $formData['description'], $formData['quantity']);
            $result = $this->productManager->update($product);
            
            if($result === true) {
                echo '
                    <script>
                        alert("Produto atualizado com sucesso!");
                        window.location = "/products";
                    </script>
                ';
            }
            else {
                echo '
                    <script>
                        alert("Erro ao atualizar produto!");
                        window.location = "/products";
                    </script>
                ';
            }
        }
        
        public function delete($sku) {
            $result = $this->productManager->delete($sku);

            if($result === true) {
                echo '
                    <script>
                        alert("Produto deletado com sucesso!");
                        window.location = "/products";
                    </script>
                ';
            }
            else {
                echo '
                    <script>
                        alert("Erro ao deletar produto!");
                        window.location = "/products";
                    </script>
                ';
            }
        }
    }
?>