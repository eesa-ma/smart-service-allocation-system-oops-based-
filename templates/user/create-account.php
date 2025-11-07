<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <!-- keep your global styles -->
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../../public/css/form.css">
    <link rel="stylesheet" href="../../public/css/submit-button.css">

    <!-- page-specific styles (separate file) -->
    <link rel="stylesheet" href="../user/css/account.css">
</head>
<body>
    <header>
        <h1>Smart Service Allocation System</h1>
    </header>

    <main class="create-form">
        <div class="card">
            <div class="card-header">
                <h2>Create Account</h2>
                <p class="lead">Register to access your service dashboard</p>
            </div>

            <div class="card-body">
                <form action="../../src/Controllers/UserController.php" method="post" class="register-form" novalidate>
                    <input type="hidden" name="action" value="register">

                    <label for="user-name">Name</label>
                    <input type="text" name="user-name" id="user-name" placeholder="john" required>

                    <label for="user-email">Email ID</label>
                    <input type="email" name="user-email" id="user-email" placeholder="john@gmail.com" required>

                    <label for="user-phone">Phone no</label>
                    <input type="tel" name="user-phone" id="user-phone" placeholder="1234567890" pattern="[0-9]{10}" required>

                    <fieldset class="location">
                        <legend>Location</legend>
                        <input type="text" name="house" id="house" placeholder="House no and house name" required>
                        <input type="text" name="street" id="street" placeholder="Street name" required>
                        <input type="text" name="city" id="city" placeholder="City name" required>
                        <input type="number" name="pincode" id="pincode" placeholder="Postal code" required>
                    </fieldset>

                    <label for="user-password">Password</label>
                    <input type="password" name="user-password" id="user-password" placeholder="create a strong password" required>

                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Enter password again" required>

                    <div class="actions">
                        <button type="submit" id="submit" name="submit" class="btn-primary">Create account</button>
                        <a class="btn-secondary" href="../user/user-signin.php">Have an account already? Login</a>
                        <button type="button" class="backbutton" onclick="history.back()">← Back</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>