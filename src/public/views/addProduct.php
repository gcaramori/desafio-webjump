<?php
  $title = ($_SERVER['REQUEST_URI'] === '/products_add') ? 'New Product' : 'Update Product';
  $btnText = ($_SERVER['REQUEST_URI'] === '/products_add') ? 'Save Product' : 'Update Product';
  $skuInputDisabled = ($_SERVER['REQUEST_URI'] === '/products_add') ? '' : 'readOnly';
  $productSku = (isset($product) && $product['sku'] !== '') ? $product['sku'] : '';
  $productName = (isset($product) && $product['name'] !== '') ? $product['name'] : '';
  $productPrice = (isset($product) && $product['price'] !== '') ? $product['price'] : '';
  $productDescription = (isset($product) && $product['description'] !== '') ? $product['description'] : '';
  $productQuantity = (isset($product) && $product['quantity'] !== '') ? $product['quantity'] : '';
  $formRoute = ($_SERVER['REQUEST_URI'] === '/products_add') ? '/products/add' : '/products/update/'.$productSku;
?>

<!doctype html>
<html ⚡>
<head>
  <title>Webjump | Backend Test | Add Product</title>
  <meta charset="utf-8">

<link  rel="stylesheet" type="text/css"  media="all" href="../assets/css/style.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
<meta name="viewport" content="width=device-width,minimum-scale=1">
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script></head>
  <!-- Header -->
<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
  <div class="close-menu">
    <a on="tap:sidebar.toggle">
      <img src="../assets/images/bt-close.png" alt="Close Menu" width="24" height="24" />
    </a>
  </div>
  <a href="/"><img src="../assets/images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
  <div>
    <ul>
      <li><a href="/categories" class="link-menu">Categorias</a></li>
      <li><a href="/products" class="link-menu">Produtos</a></li>
    </ul>
  </div>
</amp-sidebar>
<header>
  <div class="go-menu">
    <a on="tap:sidebar.toggle">☰</a>
    <a href="/" class="link-logo"><img src="../assets/images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
  </div>
  <div class="right-box">
    <span class="go-title">Administration Panel</span>
  </div>    
</header>  
<!-- Header -->
  <!-- Main Content -->
  <main class="content">
    <h1 class="title new-item"><?= $title ?></h1>
    
    <form id="productForm" method="POST" action="<?= $formRoute ?>">
      <div class="input-field">
        <label for="sku" class="label">Product SKU</label>
        <input type="text" value="<?= $productSku ?>" name="sku" id="sku" class="input-text" required <?= $skuInputDisabled ?>/> 
      </div>
      <div class="input-field">
        <label for="name" class="label">Product Name</label>
        <input type="text" value="<?= $productName ?>" name="name" id="name" class="input-text" required /> 
      </div>
      <div class="input-field">
        <label for="price" class="label">Price</label>
        <input type="text" value="<?= $productPrice ?>" name="price" id="price" class="input-text" required /> 
      </div>
      <div class="input-field">
        <label for="quantity" class="label">Quantity</label>
        <input type="text" value="<?= $productQuantity ?>" name="quantity" id="quantity" class="input-text" required /> 
      </div>
      <div class="input-field">
        <label for="category" class="label">Categories</label>
        <select multiple name="category[]" id="category" class="input-text" required>
          <?php 
            if(isset($categories) && count($categories) > 0) {
              if($_SERVER['REQUEST_URI'] === '/products_add') {
                foreach($categories as $category) {
                  echo '
                    <option value="'.$category['code'].'">'.$category['name'].'</option>
                  ';
                }
              }
              else {
                foreach($categories as $value) {
                  echo '
                    <option value="'.$category['code'].'">'.$category['name'].'</option>
                  ';
                }
              }
            } 
          ?>
        </select>
      </div>
      <div class="input-field">
        <label for="description" class="label">Description</label>
        <textarea id="description" name="description" class="input-text" required>
          <?= $productDescription ?>
        </textarea>
      </div>
      <div class="actions-form">
        <a href="/products" class="action back">Back</a>
        <input class="btn-submit btn-action" type="submit" value="<?= $btnText ?>" />
      </div>
    </form>
  </main>
  <!-- Main Content -->

  <!-- Footer -->
<footer>
	<div class="footer-image">
	  <img src="../assets/images/go-jumpers.png" width="119" height="26" alt="Go Jumpers" />
	</div>
	<div class="email-content">
	  <span>go@jumpers.com.br</span>
	</div>
</footer>
 <!-- Footer --></body>
</html>