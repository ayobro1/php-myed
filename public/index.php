<?php
// index.php - The main entry point for the horrible PHP UI
?><!DOCTYPE html>
<html>
<head>
    <title>myED - The Worst UI</title>
    <style>
        body { background: #ff0; color: #f00; font-family: Comic Sans MS, cursive, sans-serif; }
        .container { margin: 10px; padding: 5px; border: 5px dashed #00f; background: #0ff; }
        h1 { font-size: 3em; text-align: center; text-shadow: 2px 2px #fff; }
        table { border-collapse: collapse; width: 80%; margin: 10px auto; background: #fff; }
        th, td { border: 3px double #f0f; padding: 10px; text-align: left; }
        th { background: #0f0; color: #00f; }
        td { background: #f0f; color: #0f0; }
        .nav { background: #f00; color: #fff; padding: 10px; text-align: center; }
        .nav a { color: #0ff; margin: 0 20px; font-size: 2em; text-decoration: underline wavy #00f; }
        .footer { background: #00f; color: #ff0; text-align: center; padding: 20px; font-size: 1.5em; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="?page=dashboard">Dashboard</a>
        <a href="?page=classes">Classes</a>
        <a href="?page=attendance">Attendance</a>
        <a href="?page=calendar">Calendar</a>
        <a href="?page=logout">Logout</a>
        <a href="signin.php">Sign In (log test)</a>
    </div>
    <div class="container">
        <?php
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':
                echo '<h1>Dashboard</h1><p>Welcome to the worst dashboard ever.</p>';
                break;
            case 'classes':
                echo '<h1>Classes</h1>';
                echo '<table><tr><th>Class</th><th>Teacher</th><th>Room</th></tr>';
                echo '<tr><td>Math</td><td>Mr. Smith</td><td>101</td></tr>';
                echo '<tr><td>English</td><td>Ms. Johnson</td><td>102</td></tr>';
                echo '<tr><td>Science</td><td>Dr. Brown</td><td>103</td></tr>';
                echo '</table>';
                break;
            case 'attendance':
                echo '<h1>Attendance</h1>';
                echo '<p>Present: <span style="color: #0f0; font-size: 2em;">✔</span></p>';
                echo '<p>Absent: <span style="color: #f00; font-size: 2em;">✘</span></p>';
                break;
            case 'calendar':
                echo '<h1>Calendar</h1>';
                echo '<ul>';
                echo '<li>March 6: Test</li>';
                echo '<li>March 10: Assignment Due</li>';
                echo '<li>March 15: Field Trip</li>';
                echo '</ul>';
                break;
            case 'logout':
                echo '<h1>Logout</h1><p>You are now logged out. (Not really.)</p>';
                break;
            default:
                echo '<h1>404</h1><p>Page not found. Try harder.</p>';
        }
        ?>
    </div>
    <div class="footer">myED &copy; 2026 - All rights reserved (unfortunately)</div>
</body>
</html>
