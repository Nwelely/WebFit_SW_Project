<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Workouts</title>
    <link rel="stylesheet" href="../public/css/Push-Workout-Style.css">
</head>

<body>


    <?php include('partials/Navigation-Index.php'); ?>

    <h2 class="title">Push Workouts</h2>
    <section class="workouts">
        <?php foreach ($exercises as $exercise): ?>
            <div class="card">
                <img src="<?= htmlspecialchars($exercise['exerciseimage']); ?>" alt="<?= htmlspecialchars($exercise['exercisename']); ?>" class="workout-image">
                <div class="workout-details">
                    <h2><?= htmlspecialchars($exercise['exercisename']); ?></h2>
                    <p><?= htmlspecialchars($exercise['exercisedescription']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <script src="../public/js/Push-Workout-JavaScript.js"></script>

</body>
</html>
