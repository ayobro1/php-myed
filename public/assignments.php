<?php
// assignments.php - Fetch and display assignments from MyEd (demo)
require_once 'myed_parse.php';

// --- CONFIG ---
$myed_url = 'https://myeducation.gov.bc.ca/aspen/portalAssignmentList.do?navkey=academics.classes.list.gcd';
$cookie = isset($_POST['cookie']) ? $_POST['cookie'] : '';
$error = '';
$assignments = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $cookie) {
    // Fetch the HTML from MyEd using cURL
    $ch = curl_init($myed_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Cookie: $cookie"]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    if ($html === false) {
        $error = 'Failed to fetch MyEd page: ' . curl_error($ch);
    } else {
        $assignments = parse_assignments($html);
        if (empty($assignments)) {
            $error = 'No assignments found or parsing failed.';
        }
    }
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignments - myED (Bad UI)</title>
    <style>
        body { background: #ff0; color: #f00; font-family: Comic Sans MS, cursive, sans-serif; }
        .container { margin: 10px; padding: 5px; border: 5px dashed #00f; background: #0ff; }
        table { border-collapse: collapse; width: 90%; margin: 10px auto; background: #fff; }
        th, td { border: 3px double #f0f; padding: 10px; text-align: left; }
        th { background: #0f0; color: #00f; }
        td { background: #f0f; color: #0f0; }
        .error { color: #f00; font-weight: bold; text-align: center; }
        .footer { background: #00f; color: #ff0; text-align: center; padding: 20px; font-size: 1.5em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assignments (Demo)</h1>
        <form method="post">
            <label>Paste your MyEd session cookie here:</label><br>
            <input type="text" name="cookie" value="<?php echo htmlspecialchars($cookie); ?>" style="width:80%"><br>
            <input type="submit" value="Fetch Assignments">
        </form>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($assignments): ?>
            <table>
                <tr><th>Name</th><th>Due</th><th>%</th><th>Score</th><th>Feedback</th></tr>
                <?php foreach ($assignments as $a): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($a['name']); ?></td>
                        <td><?php echo htmlspecialchars($a['due']); ?></td>
                        <td><?php echo htmlspecialchars($a['pct']); ?></td>
                        <td><?php echo htmlspecialchars($a['score']); ?></td>
                        <td><?php echo htmlspecialchars($a['feedback']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="footer">myED &copy; 2026 - All rights reserved (unfortunately)</div>
</body>
</html>
