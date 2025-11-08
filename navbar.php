<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current = basename($_SERVER['PHP_SELF']);
$user    = $_SESSION['user'] ?? '';
$role    = $_SESSION['role'] ?? '';
?>
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<nav class="navbar">
    <div class="nav-left">
        <a href="index.php" class="brand">
            <img src="images/healthsoft logo.jpg" alt="HealthSoft Logo" class="logo-img">
            <span class="brand-text">HealthSoft</span>
        </a>

        <a href="register.php" class="<?= $current === 'register.php' ? 'active' : '' ?>">Register</a>
        <a href="view_patients.php" class="<?= $current === 'view_patients.php' ? 'active' : '' ?>">Patients</a>
        <a href="add_visit.php" class="<?= $current === 'add_visit.php' ? 'active' : '' ?>">Record Visit</a>
        <a href="view_visits.php" class="<?= $current === 'view_visits.php' ? 'active' : '' ?>">Visits</a>
        <?php if ($role === 'admin'): ?>
            <a href="add_user.php" class="<?= $current === 'add_user.php' ? 'active' : '' ?>">Admin: Add User</a>
        <?php endif; ?>
    </div>

    <div class="nav-right">
        <span class="user-pill"><?= htmlspecialchars($user) ?> (<?= htmlspecialchars(ucfirst($role)) ?>)</span>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</nav>