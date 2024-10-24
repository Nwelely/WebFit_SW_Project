<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Plan</title>
  <link rel="stylesheet" href="../public/css/Meals-Style.css">
</head>

<body>
  <?php include('partials/Navigation-Index.php'); ?>
  
  <h2 class="title">Meal Plan & Recipes</h2>

  <div id="mealPlanContainer" class="container">
    <?php if (count($meals) > 0): ?>
      <?php foreach ($meals as $meal): ?>
        <div class="card">
          <div class="card-content">
            <h2><?php echo $meal['mealname']; ?></h2>
            <p><?php echo $meal['mealdescription']; ?></p>
            <ul>
              <?php foreach ($meal['ingredients'] as $ingredient): ?>
                <li><?php echo $ingredient['name']; ?>: <?php echo $ingredient['quantity']; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No meals available.</p>
    <?php endif; ?>
  </div>

  <script src="../public/js/Meal-JavaScript.js"></script>
</body>

</html>
