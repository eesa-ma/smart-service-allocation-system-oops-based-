

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/form.css">
    <link rel="stylesheet" href="../public/css/submit-button.css">
    <link rel="stylesheet" href="../user/css/passreset.css">
</head>
<body>
    <div class="div-container">
    <form action="user-passreset.php" method="POST">
        <table>
            <tr>
                <th colspan="2">Reset Password</th>
            </tr>
            <tr>
                <td><label for="new-password">New password: </label></td>
                <td><input type="password" id="new-password" name="new-password"></td>
            </tr>
            <tr>
                <td><label for="confirm-password">Confirm password:</label></td>
                <td><input type="password" id="confirm-password" name="confirm-password"></td>
            </tr>
            <tr>
                <td colspan="2"><center><input type="submit" id="submit" name="submit" value="Reset Password"></center></td>
            </tr>
            <tr>
            <td colspan="2">
                <center><button onclick="history.back()" class="backbutton" name="backbutton" >
        back
        </button></center>
        </table>
    </form>
</div>
</body>
</html>