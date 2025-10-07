
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECHNICIAN LOGIN</title>
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../technician/css/signin.css">
    <link rel="stylesheet" href="../../public/css/form.css">
    <link rel="stylesheet" href="../../public/css/submit-button.css">
</head>
<body>
    <div class="container">
    <h1>TECHNICIAN LOGIN</h1>
    <form action="../../src/Controllers/AuthController.php" method="post">
        <input type="hidden" name="role" value="technician">
        <input type="hidden" name="action" value="signin">
        <table>
            <tr>
                <th colspan="2">SIGN IN</th>
            </tr>
            <tr>
                <td><label for="email">Email id:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password"></td>
            </tr>
            <tr>
            </tr>
            <tr>
            <td colspan="2">
                <center><input type="submit" value="Sign In" id="submit" name="submit"></center>
            </td>
            <tr>
            <td colspan="2">
                <center><button onclick="history.back()" class="backbutton" name="backbutton" >
        back
        </button></center>
            </td>
            </tr>
            </tr>
            <tr>
               <td colspan="2"><center><a href="../technician/verify-technician.php" >Forgotten your password?</a></center></td> 
            </tr>
        </table>
    </form>
    </div>
</body>
</html>
