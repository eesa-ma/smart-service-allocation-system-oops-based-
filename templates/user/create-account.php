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
  <link rel="stylesheet" href="../user/css/account.css">

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

        <form action="../../src/Controllers/UserController.php" method="post" class="register-form" novalidate>
          <input type="hidden" name="action" value="register">

          <div class="row">
            <div class="col">
              <label for="user-name">Name</label>
              <input type="text" id="user-name" name="user-name" placeholder="John" required>
            </div>
            <div class="col">
              <label for="user-email">Email</label>
              <input type="email" id="user-email" name="user-email" placeholder="john@gmail.com" required>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="user-phone">Phone</label>
              <input type="tel" id="user-phone" name="user-phone" placeholder="1234567890" pattern="[0-9]{10}" required>
            </div>
            <div class="col">
              <label for="pincode">Postal code</label>
              <input type="number" id="pincode" name="pincode" placeholder="Postal code" required>
            </div>
          </div>

          <fieldset class="location" aria-label="Location details">
            <legend class="sr-only">Location Details</legend>
            <label class="sr-only" for="house">House</label>
            <input type="text" name="house" id="house" placeholder="House no. and name" required>
            <input type="text" name="street" id="street" placeholder="Street name" required>
            <input type="text" name="city" id="city" placeholder="City name" required>
          </fieldset>

          <div class="row">
            <div class="col">
              <label for="user-password">Password</label>
              <input type="password" id="user-password" name="user-password" placeholder="Create a strong password" required>
            </div>
            <div class="col">
              <label for="confirm-password">Confirm</label>
              <input type="password" id="confirm-password" name="confirm-password" placeholder="Enter password again" required>
            </div>
          </div>

          <div class="actions">
            <button type="submit" class="btn-primary" id="submit" name="submit">Create account</button>
            <a class="btn-ghost" href="../user/user-signin.php">Have an account already? Login</a>
            <button type="button" class="btn-back" onclick="history.back()">← Back</button>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>
</html>