<?php 
    namespace App\Entities;

    class Product {
        public function __construct(
            protected string $sku,
            protected string $name,
            protected float $price,
            protected string $description,
            protected int $quantity
        ) {}

        public function getSku() {
            return $this->sku;
        }
        
        public function getName() {
            return $this->name;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getQuantity() {
            return $this->quantity;
        }
    }
?>