<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign In</title>
    <link rel="stylesheet" href="css/signin.css?v=2.0">
</head>
<body>
    <div class="container">
        <main>
            <form action="../../src/Controllers/AuthController.php" method="post" id="signin-form">
                <input type="hidden" name="role" value="user">
                <input type="hidden" name="action" value="signin">
                
                <h2>User Sign In</h2>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required aria-required="true">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required aria-required="true">
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-primary" id="submit" name="submit">Sign In</button>
                    <button type="button" class="btn-secondary" onclick="window.location.href='../../public/index.php'">Back</button>
                </div>
                
                <div class="form-links">
                    <a href="../user/user-verify.php">Forgot your password?</a>
                    <a href="../user/create-account.php">Don't have an account? Sign up</a>
                </div>
            </form>
        </main>
    </div>
    
    <script>
        // Add loading state on form submission
        document.getElementById('signin-form').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submit');
            submitBtn.textContent = 'Signing in...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>