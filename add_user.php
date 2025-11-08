<?php
include 'auth.php';
include 'navbar.php';

if ($_SESSION['role'] !== 'admin') {
    echo "Access Denied. Only Admins can add users.";
    exit;
}


$conn = new mysqli("localhost", "root", "", "health_db");

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];


    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Username already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (full_name, username, password, role) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssss", $full_name, $username, $password, $role);

        if ($stmt->execute()) {
            $success = "User added successfully.";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add New User</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/adduser.css"
</head>

<body>
    <h2>Add New Staff</h2>

    <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        Full Name:<br>
        <input type="text" name="full_name" required><br><br>

        Username:<br>
        <input type="text" name="username" required><br><br>

        Password:<br>
        <input type="password" name="password" required><br><br>

        Role:<br>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="doctor">Doctor</option>
            <option value="clerk">Clerk</option>
        </select><br><br>

        <button type="submit">Add User</button>
    </form>

    <br>
    <a href="index.php">← Back to Dashboard</a>
</body>

</html>