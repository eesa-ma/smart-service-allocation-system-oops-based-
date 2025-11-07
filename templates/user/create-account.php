<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Account — Smart Service Allocation System</title>

  <!-- keep your global styles -->
  <link rel="stylesheet" href="../../public/css/global.css">
  <link rel="stylesheet" href="../../public/css/form.css">
  <link rel="stylesheet" href="../../public/css/submit-button.css">

  <!-- page-specific CSS -->
  <link rel="stylesheet" href="../user/css/account.css?v=<?php echo filemtime(__DIR__.'/css/account.css'); ?>">

  <!-- fonts & icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/781c7c7d6c.js" crossorigin="anonymous"></script>
</head>
<body>
  <main class="page">

    <section class="card-wrap" aria-labelledby="create-account-title">
      <div class="card" role="region" aria-label="Create account form">
        <header class="card-header">
          <div class="avatar"><i class="fa-solid fa-user-gear"></i></div>
          <h2 id="create-account-title">Create Account</h2>
          <p class="lead">Add a new user to the system</p>
        </header>

        <form action="../../src/Controllers/UserController.php" method="post" class="register-form" id="createForm" novalidate>
          <input type="hidden" name="action" value="register">

          <div class="row">
            <div class="col">
              <label for="user-name">Name <span class="req">*</span></label>
              <div class="input with-icon">
                <input type="text" id="user-name" name="user-name" placeholder="John" required>
              </div>
            </div>
            <div class="col">
              <label for="user-email">Email <span class="req">*</span></label>
              <div class="input with-icon">
                <input type="email" id="user-email" name="user-email" placeholder="john@gmail.com" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="user-phone">Phone <span class="req">*</span></label>
              <div class="input with-icon">
                <input type="tel" id="user-phone" name="user-phone" placeholder="1234567890" pattern="[0-9]{10}" required>
              </div>
            </div>
            <div class="col">
              <label for="pincode">Postal code <span class="req">*</span></label>
              <div class="input with-icon">
                <input type="number" id="pincode" name="pincode" placeholder="Postal code" required>
              </div>
            </div>
          </div>

          <fieldset class="location" aria-label="Location details">
            <legend>Location</legend>
            <label class="sr-only" for="house">House</label>
            <div class="input"><input type="text" name="house" id="house" placeholder="House no. and name" required></div>
            <div class="input"><input type="text" name="street" id="street" placeholder="Street name" required></div>
            <div class="input"><input type="text" name="city" id="city" placeholder="City name" required></div>
          </fieldset>

          <div class="row">
            <div class="col">
              <label for="user-password">Password <span class="req">*</span></label>
              <div class="input with-icon">
                <input type="password" id="user-password" name="user-password" placeholder="Create a strong password" required>
                <button class="toggle-pass" type="button" aria-label="Show password" data-target="user-password"></i></button>
              </div>
            </div>
            <div class="col">
              <label for="confirm-password">Confirm <span class="req">*</span></label>
              <div class="input with-icon">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Enter password again" required>
                <button class="toggle-pass" type="button" aria-label="Show password" data-target="confirm-password"></button>
              </div>
              <p class="hint" id="matchHint"></p>
            </div>
          </div>

          <div class="actions">
            <button type="submit" class="btn-primary" id="submit" name="submit">
              <span>Create account</span>
              <span class="loading" aria-hidden="true" style="display:none"><i class="fa-solid fa-circle-notch fa-spin"></i></span>
            </button>
            <a class="btn-ghost" href="../user/user-signin.php">Have an account already? Login</a>
            <button type="button" class="btn-back" onclick="history.back()">← Back</button>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>
</html>