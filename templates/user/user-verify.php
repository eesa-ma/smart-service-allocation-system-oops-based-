<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Verify user</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/781c7c7d6c.js" crossorigin="anonymous"></script>

  <!-- External stylesheet (separate file) -->
  <link rel="stylesheet" href="../user/css/verify.css">
</head>
<body>
  <main class="bg">
    <div class="center-wrap">
      <div class="card">
        <header class="card-header">
          <div class="avatar">
            <i class="fa-solid fa-user-lock"></i>
          </div>
          <h1>Verify Account</h1>
          <p class="lead">Enter your email to receive a verification link</p>
        </header>

        <section class="card-body">
          <form action="user-verify.php" method="POST" novalidate>
            <label class="field-label" for="user-email">
              <i class="fa-solid fa-envelope"></i>
              Email Address
            </label>
            <input id="user-email" name="user-email" type="email" placeholder="Enter your email" required>

            <div class="actions">
              <button type="submit" name="submit" class="btn-primary">Verify</button>
              <a class="btn-secondary" href="/" title="Back to home">
                <i class="fa-solid fa-arrow-left"></i> Back to Home
              </a>
            </div>
          </form>

          <hr class="divider">

          <p class="small muted">Don't have an account? <a href="../user/create-account.php">Sign up</a></p>
        </section>
      </div>
    </div>
  </main>
</body>
</html>