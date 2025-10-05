
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../user/css/account.css">
    <link rel="stylesheet" href="../public/css/form.css">
    <link rel="stylesheet" href="../public/css/submit-button.css">
</head>
<body>
    <header>
        <h1>Smart Service Allocation System</h1>
    </header>
    <main class="create-form">
        <form action="../../src/Controllers/UserController.php" method="post">
            <table>
                <tr>
                    <th colspan="2">Create Account</th>
                </tr>      
                <tr>
                    <td><label for="user-name">Name:</label></td>
                    <td><input type="text" name="user-name" id="user-name" placeholder="john" required></td>
                </tr>
                <tr>
                    <td><label for="user-email">Email ID:</label></td>
                    <td><input type="email" name="user-email" id="user-email" placeholder="john@gmail.com" required></td>
                </tr>
                <tr>
                    <td><label for="user-phone">Phone no:</label></td>
                    <td><input type="tel" name="user-phone" id="user-phone" placeholder="123-456-7890" pattern="[0-9]{10}" required></td>
                </tr>
                <tr>
                    <td rowspan="4"><label for="user-location">Location:</label></td>
                    <td><input type="text" name="house" id="house" placeholder="House no and house name" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="street" id="street" placeholder="Street name" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="city" id="city" placeholder="City name" required></td>
                </tr>
                <tr>
                    <td><input type="number" name="pincode" id="pincode" placeholder="Postal code" required></td>
                </tr>

                <tr>
                    <td><label for="user-password">Password:</label></td>
                    <td><input type="password" name="user-password" id="user-password" placeholder="create a strong password" required></td>
                </tr>
                <tr>
                    <td><label for="confirm-password">Confirm Password:</label></td>
                    <td><input type="password" name="confirm-password" id="confirm-password" placeholder="Enter password again" required></td>
                </tr>
                <tr>
                    <td colspan="2"><center><input type="submit" value="Create account" id="submit" name="submit"></center></td>
                </tr>
                <tr>
            <td colspan="2">
                <center><button onclick="history.back()" class="backbutton" name="backbutton" >
        back
        </button></center>
            </td>
            </tr>
                <tr>
                    <td colspan="2">Have an account already? <a href="../user/user-signin.php">Login</a></td>
                </tr>
            </table>
        </form>
    </main>
</body>
</html>