<!DOCTYPE html>
<html>
<head>
    <title>Account Creation</title>
</head>
<body>
    <h2>Create an Account</h2>
    <form action="newLogin.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Create Account">
    </form>
</body>
</html>

<?php
// Include the database connection script (db.php)
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // You should perform more input validation and sanitation here

    // Define password complexity requirements
    $minLength = 8;
    $requireUppercase = true;
    $requireLowercase = true;
    $requireDigit = true;
    $requireSpecialChar = true;

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Check password complexity
    $passwordIsValid = true;
    $passwordErrorMessage = "";

    if (strlen($password) < $minLength) {
        $passwordIsValid = false;
        $passwordErrorMessage = "Password must be at least $minLength characters long.";
    } else {
        if ($requireUppercase && !preg_match('/[A-Z]/', $password)) {
            $passwordIsValid = false;
            $passwordErrorMessage = "Password must contain at least one uppercase letter.";
        }
        if ($requireLowercase && !preg_match('/[a-z]/', $password)) {
            $passwordIsValid = false;
            $passwordErrorMessage = "Password must contain at least one lowercase letter.";
        }
        if ($requireDigit && !preg_match('/\d/', $password)) {
            $passwordIsValid = false;
            $passwordErrorMessage = "Password must contain at least one digit.";
        }
        if ($requireSpecialChar && !preg_match('/[^a-zA-Z\d]/', $password)) {
            $passwordIsValid = false;
            $passwordErrorMessage = "Password must contain at least one special character.";
        }
    }

    if ($passwordIsValid) {
        $insertQuery = "INSERT INTO Users (Username, PasswordHash) VALUES (?, ?)";
        $stmt = $mysqli->prepare($insertQuery);
        $stmt->bind_param("ss", $username, $passwordHash);

        if ($stmt->execute()) {
            echo "Account created successfully.";
        } else {
            echo "Error creating account: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: $passwordErrorMessage";
    }
}

$mysqli->close();
?>
