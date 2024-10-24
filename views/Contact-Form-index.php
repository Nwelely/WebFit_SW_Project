<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Send your message</title>
  <link rel="stylesheet" href="../public/css/Contact-Form-Style.css" />
</head>

<body>
  <?php include('partials/Navigation-Index.php'); ?> 

  <div class="container">
    <div class="item">
      <div class="contactform">
        <div class="text1">Let's Stay In Touch</div>
        <img src="../public/images/Contact-Form-Img.jpg" alt="" class="contactimage" />
      </div>
      <div class="submit-form">
        <h4 class="text3">Contact Us</h4>
        <form action="process-form.php" method="post"> 
          <div class="inputbox">
            <textarea name="message" class="input" required id="message" cols="30" rows="10"></textarea>
            <label for="message">Write your message here</label> 
          </div>
          <input type="submit" class="mesgbtn" value="Send" />
        </form>
      </div>
    </div>
  </div>

  <script src="../public/js/Contact-Form-JavaScript.js"></script>

</body>

</html>