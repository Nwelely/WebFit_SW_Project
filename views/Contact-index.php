<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../public/css/Contact-style.css">
</head>

<body>
  <?php include('partials/Navigation-Index.php'); ?> <!-- Replaced EJS include with PHP include -->

  <section class="cards contact" id="contact">
    <h2 class="title">CONTACT US</h2>
    <div class="content">
      <div class="card">
        <div class="icon">
          <i class="fa-solid fa-phone"></i>
        </div>
        <div class="info">
          <h3>CALL US</h3>
          <p>0111123456789</p>
        </div>
      </div>
      <div class="card" id="mailcard">
        <div class="icon">
          <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="info">
          <h3>MAIL</h3>
          <p>webfit@gmail.com</p>
        </div>
      </div>
    </div>
  </section>
  
  <script src="../public/js/Contact-JavaScript.js"></script>
</body>

</html>