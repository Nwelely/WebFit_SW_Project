<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership</title>
    <link rel="stylesheet" href="../public/css/Standard-Plan-Style.css" />
</head>

<body>

    
    <?php include('partials/Navigation-Index.php'); ?>

    <section class="cards membership" id="membership">
        <h2 class="title">Membership</h2>
        <div class="content">
            <div class="card" id="workoutCard" onclick="goToWorkoutPage()">
                <div class="icon">
                    <img src="../public/images/workout2.jpeg" class="workoutimage">
                </div>
                <div class="workoutcard">
                    <h3>Workout</h3>
                    <p>Offers essential advice on setting goals, understanding basic workout principles aimed at empowering individuals to confidently start their fitness journey</p>
                </div>
            </div>
            <div class="card" onclick="goToMealPlanPage()">
                <div class="icon">
                    <img src="../public/images/plan.jpeg" class="planimage">
                </div>
                <div class="info">
                    <h3>Diet Plans/Recipes</h3>
                    <p>Discover a variety of delicious and nutritious meal options designed to support your health goals, simplify your meal planning, and delight your taste buds</p>
                </div>
            </div>
        </div>
    </section>

    <script src="../public/js/Standard-Plan-JavaScript.js"></script>

</body>

</html>
