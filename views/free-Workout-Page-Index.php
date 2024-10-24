<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Workouts</title>
    <link rel="stylesheet" href="../public/css/free-Workout-Page-Style.css" />
</head>

<body>
    <?php include('partials/Navigation-Index.php'); ?>

    <h1 class="title">My Workouts</h1>

    <section class="workouts">
        <?php foreach ($exercises as $exercise) { ?>
            <div class="card">
                <img src="<?= $exercise['exerciseimage']; ?>" alt="<?= $exercise['exercisename']; ?>" class="workout-image" />
                <div class="workout-details">
                    <h2><?= $exercise['exercisename']; ?></h2>
                    <p><?= $exercise['exercisedescription']; ?></p>
                </div>
            </div>
        <?php } ?>
    </section>

    <script src="../public/js/free-Workout-Page-JavaScript.js"></script>

</body>

</html>