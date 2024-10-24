<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Workouts</title>
    <link rel="stylesheet" href="../public/css/Legs-Workout-Style.css">
</head>

<body>
    <?php include('partials/Navigation-Index.php'); ?>

    <h2 class="title">Legs Workouts</h2>
    <section class="workouts">
        <?php foreach ($exercises as $exercise): ?>
            <div class="card">
                <img src="<?php echo $exercise['exerciseimage']; ?>" alt="<?php echo $exercise['exercisename']; ?>" class="workout-image">
                <div class="workout-details">
                    <h2><?php echo $exercise['exercisename']; ?></h2>
                    <p><?php echo $exercise['exercisedescription']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <script src="../public/js/Legs-Workout-JavaScript.js"></script>
</body>

</html>
