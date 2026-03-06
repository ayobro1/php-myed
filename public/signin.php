<?php
// signin.php - Simulates a login and logs all signins
$logFile = __DIR__ . '/signin.log';
$date = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$user = $_POST['username'] ?? 'guest';
file_put_contents($logFile, "$date | $ip | $user\n", FILE_APPEND);
?><!DOCTYPE html>
<html>
<head>
    <title>Sign In - myED</title>
    <style>
        body { background: #f0f; color: #0ff; font-family: Impact, fantasy; }
        .box { margin: 100px auto; width: 400px; padding: 30px; border: 7px dotted #ff0; background: #fff; }
        h2 { text-align: center; color: #f00; }
        label { font-size: 1.5em; }
        input[type=text], input[type=password] { width: 100%; padding: 10px; margin: 10px 0; border: 3px solid #0f0; background: #ff0; color: #f00; }
        input[type=submit] { background: #0ff; color: #f0f; font-size: 1.5em; border: 5px solid #f00; width: 100%; }
        .msg { color: #00f; font-size: 1.2em; text-align: center; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Sign In</h2>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo '<div class="msg">Sign in logged! Welcome, ' . htmlspecialchars($user) . '.</div>';
            echo '<a href="index.php">Go to Dashboard</a>';
        } else { ?>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Sign In">
        </form>
        <?php } ?>
    </div>
</body>
</html>
