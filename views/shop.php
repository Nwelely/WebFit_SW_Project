<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WEB-FIT Shop</title>
  <link rel="stylesheet" href="../public/css/Shop-Style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
  <header>
    <h1>WEB-FIT</h1>
    <div class="cart-info">
      <span class="cart-count">0</span> items
      <div id="cart-Btn"><i class="fas fa-shopping-cart"></i></div>
    </div>
  </header>
 
  <main>


    <section id="products">
      <h2>Our Products</h2>
      <div class="product-list">

      </div>
    </section>

    </section>

    <div class="cart-overlay" id="cart-overlay">
      <div class="cart-container">
        <div class="cart-header">
          <h2>Your Cart</h2>
          <span class="cart-close" id="cart-close">&times;</span>
        </div>
        <div class="cart-items" id="cart-items">

        </div>
        <div class="cart-total" id="cart-total">Total: $0.00</div>
        <button id="checkout-btn-cart" class="checkout-btn">Checkout</button>
      </div>
    </div>

  </main>

  <footer>
    <p>&copy; 2024 Web Shop. All rights reserved.</p>
  </footer>
  <script src="../public/js/Shop-JavaScript.js"></script>
</body>