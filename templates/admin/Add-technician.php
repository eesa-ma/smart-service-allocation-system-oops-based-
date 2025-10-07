<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Technician Management</title>
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../admin/css/Add-technician.css">
    <link rel="stylesheet" href="../../public/css/form.css">
    <link rel="stylesheet" href="../../public/css/submit-button.css">
</head>
<body>
    <div class="container">
    <section class="create-tech">
        <form action="" method="post">
            <table>
                <tr>
                    <th colspan="2">Register Technician</th>
                </tr>
                <tr>
                    <td><label for="techname">Technician Name:</label></td>
                    <td><input type="text" name="tech-name" id="tech-name" required></td>
                </tr>
                <tr>
                    <td><label for="skills">Skills:</label></td>
                    <td><input type="text" name="tech-skill" id="tech-skill" required></td>
                </tr>
                <tr>
                    <td rowspan="4"><label for="tech-location">Location:</label></td>
                    <td><input type="text" name="house" id="house" placeholder="house no and house name" required></td>
                </tr>
                <tr>
                    <td><input type="text" id="street" name="street" placeholder="street name" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="city" id="city" placeholder="city name" required></td>
                </tr>
                <tr>
                    <td><input type="number" name="pincode" id="pincode" placeholder="postal code" required></td>
                </tr>
                <tr>
                    <td><label for="techphone">Phone NO:</label></td>
                    <td><input type="text" name="tech-phone" id="tech-phone" required></td>
                </tr>
                <tr>
                    <td><label for="techmail">Email:</label></td>
                    <td><input type="text" name="tech-mail" id="tech-mail" required></td>
                </tr>
                <tr>
                    <td><label for="technician-pass">Password:</label></td>
                    <td><input type="password" name="technicain-password" id="technician-password"  required></td>
                </tr>
                <tr>
                    <td><label for="confirm-password">Confrim-password</label></td>
                <td><input type="password" name="confirm-password" id="confirm-password"  required></td>
                </tr>
                <tr>
                    <td colspan="2"><center><input type="submit" value="CREATE ACCOUNT" id="submit" name="submit"></center></td>
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