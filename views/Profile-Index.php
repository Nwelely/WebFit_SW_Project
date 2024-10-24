<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nutrition, Gym, and Supplements</title>
  <link rel="stylesheet" href="../public/css/Profile-Styles.css" />
</head>
<body>
  <?php include('partials/Navigation-Index.php'); ?>

  <h1 class="profile-heading">My Profile</h1>

  <div class="profile-container" data-user-id="<?php echo htmlspecialchars($user['_id']); ?>">
    <div class="profile-image-container">
      <img src="<?php echo htmlspecialchars($user['img']); ?>" alt="Profile Picture" class="profile-image" id="profileImage" />
    </div>

    <div class="profile-details">
      <p>Name: <span id="userName"><?php echo htmlspecialchars($user['fullname']); ?></span></p>
      <p>Email: <span id="userEmail"><?php echo htmlspecialchars($user['useremail']); ?></span></p>
      <p>Address: <span id="userAddress"><?php echo htmlspecialchars($user['address']); ?></span></p>
      <p>Gender: <span id="userGender"><?php echo htmlspecialchars($user['gender']); ?></span></p>
      <p>Age: <span id="userAge"><?php echo htmlspecialchars($user['age']); ?></span></p>
      <p>Subscription Status: <span id="userSubscriptionStatus"><?php echo htmlspecialchars($user['Subscription']); ?></span></p>
      <p>Phone Number: <span id="userPhoneNumber"><?php echo htmlspecialchars($user['userphone']); ?></span></p>

      <?php if (isset($user['visa']) && count($user['visa']) > 0): ?>
        <h2 style="color: black;">Visa Information</h2>
        <select id="visaSelect" onchange="showVisaDetails()">
          <option value="">Select Visa</option>
          <?php foreach ($user['visa'] as $index => $visa): ?>
            <option value="<?php echo $index; ?>">Visa <?php echo $index + 1; ?></option>
          <?php endforeach; ?>
        </select>
        <?php foreach ($user['visa'] as $index => $visa): ?>
          <div class="visa-details hidden" id="visaDetails<?php echo $index; ?>">
            <p>Cardholder Name: <span id="visaCardholderName<?php echo $index; ?>"><?php echo htmlspecialchars($visa['cardholdername']); ?></span></p>
            <p>Expire Date: <span id="visaExpireDate<?php echo $index; ?>"><?php echo htmlspecialchars($visa['expiredate']); ?></span></p>
            <p>Card Number: ************ <span id="visaLast4Digits"><?php echo htmlspecialchars($visa['last4digits']); ?></span></p>
            <button class="remove-visa-button hidden">Remove Visa</button>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="button-group">
    <button id="workoutsButton">My Workouts</button>
    <button id="mealsButton">My Meals</button>
    <button id="subscriptionButton">Subscription</button>
    <button id="editProfiletoDelete">Delete My Profile</button>
    <button id="deleteAccountButton" class="hidden" style="background-color: red;">Delete Account</button>
  </div>

  <script src="../public/js/Profile-JavaScript.js"></script>
</body>
</html>
