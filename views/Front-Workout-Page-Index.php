<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Push Pull Legs</title>
    <link rel="stylesheet" href="../public/css/Front-Workout-Page-Style.css" />
  </head>
  <body>
    <?php include('partials/Navigation-Index.php'); ?>

    <h2 class="title">Workout Plan</h2>
    <div class="container">
      <div class="card" id="push">
        <div class="card-header">
          <h2>Push Day</h2>
        </div>
        <div class="card-body">
          <p>
            Push exercises include movements like push-ups, bench press,
            shoulder press, and dips.
          </p>
        </div>
      </div>
      <div class="card" id="pull">
        <div class="card-header">
          <h2>Pull Day</h2>
        </div>
        <div class="card-body">
          <p>
            Pull exercises target muscles involved in pulling movements, such as
            pull-ups, rows, and curls.
          </p>
        </div>
      </div>
      <div class="card" id="legs">
        <div class="card-header">
          <h2>Leg Day</h2>
        </div>
        <div class="card-body">
          <p>
            Leg exercises focus on lower body muscles and include squats,
            lunges, deadlifts, and calf raises.
          </p>
        </div>
      </div>
      <div class="card" id="rest">
        <div class="card-header">
          <h2>Rest Day</h2>
        </div>
        <div class="card-body">
          <p>
            Rest days are crucial for muscles to heal and grow effectively.
          </p>
        </div>
      </div>
    </div>

    <script src="../public/js/Front-Workout-Page-JavaScript.js"></script>

  </body>
</html>
