<?php
session_start();
$conn = new mysqli("localhost", "root", "", "health_db");
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_activity'] = time();
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Staff Login | HealthSoft</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="images/healthsoft logo.jpg" alt="HealthSoft Logo" class="header-logo">
            <span class="brand-text">HealthSoft</span>
        </div>
    </header>

    <main class="login-section">
        <div class="login-left">
            <img src="images/Lagos State Logo.png" alt="Lagos State Logo" class="lagos-logo">
            <h2>DIGITAL HEALTH RECORDS (HEALTHSOFT)</h2>
            <h3>LAGOS MINISTRY OF HEALTH</h3>
            <p>Health Data Management System</p>
            <a href="#" class="access-btn">Apply for Access</a>
        </div>

        <div class="login-right">
            <h2>Sign in to your account</h2>
            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password" required>

                <div class="options">
                    <label><input type="checkbox" name="remember"> Keep me logged in</label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">SIGN IN</button>
            </form>

            <p class="new-access">New to HealthSoft? <a href="#">Request Access</a></p>
        </div>
    </main>
</body>
</html>
