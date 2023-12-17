<!DOCTYPE html>
<html>
<head>
    <title>Login or Create Account</title>
</head>
<body>
    <h2>Login or Create Account</h2>

    <ul>
        <li><a href="?action=login">Login</a></li>
        <li><a href="?action=create">Create Account</a></li>
    </ul>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === 'login') {
                include 'login.php'; // Include the login form
            } elseif ($action === 'create') {
                include 'newLogin.php'; // Include the account creation form
            }
        }
    }
    ?>
</body>
</html>



