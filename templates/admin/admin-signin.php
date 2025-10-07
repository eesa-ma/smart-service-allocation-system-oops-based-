
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN</title>
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../admin/css/signin.css">
    <link rel="stylesheet" href="../../public/css/form.css">
    <link rel="stylesheet" href="../../public/css/submit-button.css">
</head>
<body>
    <div class="container">
        <h1><center>ADMIN LOGIN</center></h1>
        <section class="log-sec">
            <form action="../../src/Controllers/AdminController.php" method="post">
                <input type="hidden" name="action" value="signin">
                <table>
                    <tr>
                        <th colspan="2">ADMIN LOGIN</th>
                    </tr>
                    <tr>
                        <td><label for="admin-id">ADMIN ID:</label></td>
                        <td><input type="number" name="admin-id" id="admin-id" required></td>
                    </tr>
                    <tr>
                        <td><label for="admin-pass">Password:</label></td>
                        <td><input type="password" name="admin-pass" id="admin-pass" required></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"><center><a href="../admin/verify-admin.php">Forgotten your password?</a></center></td>
                    </tr>
                    <tr>
                        <td colspan="2"><center><input type="submit" value="LOGIN" id="submit" name="submit"></center></td>
                    </tr>
                    <tr>
            <td colspan="2">
                <center><button onclick="history.back()" class="backbutton" name="backbutton" >
        back
        </button></center>
            </td>
            </tr>
                </table>   
            </form>
        </section>
    </div>
</body>

</html>