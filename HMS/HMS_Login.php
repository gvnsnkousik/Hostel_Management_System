<?php
$host = 'localhost';
$db   = 'hostel';
$user = 'root';
$db_pass = '';
$charset = 'utf8mb4';
$userName = "";
$passwordErr = "";
$showError = false;

$conn = new mysqli($host, $user, $db_pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit']))
{
    $name = $_POST['AdminId'];
    $user_pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin_details WHERE Admin_id=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        $data = $result->fetch_assoc();
        if($data['password'] == $user_pass)
        {
            header('Location: HMS_Main.html');
            exit();
        }
        else
        {
            $showError = true;
            $passwordErr = "Invalid password";
        }
    }
    else
    {
        $showError = true;
        $userName = "Invalid AdminId";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="HMS_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<div class="login-container">
    <h2>Login</h2>
    <form method="post">
        <div class="input-group">
            <input type="text" name="AdminId" required onkeyup="this.setAttribute('value', this.value);" value="">
            <i class='bx bxs-user'></i>
            <label>Admin-ID</label>
        </div>
        <div class="input-group">
            <input type="password" name="password" required value=""
                   onkeyup="this.setAttribute('value', this.value);">
            <i class='bx bxs-lock'></i> <!-- Example icon for password -->
            <label>Password</label>
        </div>
        <button type="submit" name="submit">Login</button>
        <?php if($showError): ?>
            <p><?php echo $userName; ?></p>
            <p><?php echo $passwordErr; ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>