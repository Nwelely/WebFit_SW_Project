<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Coaches</title>
  <link rel="stylesheet" href="../public/css/Coaches-Page-Style.css" />
</head>

<body>
  <?php include('partials/Navigation-Index.php'); ?>

  <div class="about-section">
    <h1>OUR COACHES</h1>
  </div>

  <div class="row">
    <?php foreach ($coaches as $coach) { ?>
      <div class="column">
        <div class="card">
          <img src="<?= $coach['coachimage']; ?>" alt="<?= $coach['coachname']; ?>" style="width: 100%">
          <div class="container">
            <h2><?= $coach['coachname']; ?></h2>
            <p class="title"><?= $coach['coachdescription']; ?></p>
            <p><a href="../auth/payment" class="contact-button">View Schedule</a></p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <script src="../public/js/Coaches-Page-JavaScript.js"></script>
</body>

</html>