<?php 
    namespace Entities;

    class Category {
        public function __construct(
            protected string $code,
            protected string $name
        ) {}

        public function getCode() {
            return $this->code;
        }

        public function getName() {
            return $this->name;
        }
    }
?>