<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'auth.php';

$username = $_SESSION['user'] ?? "Guest";
$role = $_SESSION['role'] ?? "User";
$date = date("l, F j, Y");
$time = date("h:i A");

$quotes = [
    "Health is wealth. Take care of it today for a better tomorrow.",
    "Your body is your most priceless possession. Take care of it.",
    "A fit body, a calm mind, a house full of love. These things cannot be bought – they must be earned.",
    "Good health and good sense are two of life’s greatest blessings."
];

$random_quote = $quotes[array_rand($quotes)];

$hour = date("H");
if ($hour < 12) {
    $greeting = "Good morning";
} elseif ($hour < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Health Records Dashboard</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>

    <header class="dashboard-header">
        <h1><?php echo $greeting; ?>, <span class="highlight"><?php echo htmlspecialchars($username); ?></span>!</h1>
        <p class="subtitle">Health Record Management System</p>
        <p class="date-time">Today is <?php echo $date; ?> | Current Time: <?php echo $time; ?></p>
        <p class="role">You are logged in as: <b><?php echo ucfirst($role); ?></b></p>
    </header>

    <main class="dashboard-container">
        <section class="about card">
            <h2>🩺 About HealthSoft</h2>
            <p>
                <b>HealthSoft</b> is a cutting-edge Health Records Management System designed for the
                <b>Lagos State Ministry of Health</b>. It was created to provide a secure, reliable, and
                easy-to-use digital solution for managing patient health information across hospitals,
                clinics, and other healthcare facilities under the ministry.
            </p>

            <p>
                At its core, HealthSoft eliminates the inefficiencies of traditional paper-based
                records. It ensures that every patient’s registration, medical history, and clinical visits
                are stored digitally, making it easier for healthcare professionals to access
                accurate information at the right time.
            </p>

            <ul>
                <li>✔️ <b>Patient Registration</b> – Quick onboarding of new patients.</li>
                <li>✔️ <b>Visit Records</b> – Record and monitor each hospital or clinic visit.</li>
                <li>✔️ <b>Medical History</b> – Access complete patient histories instantly.</li>
                <li>✔️ <b>Search & Reports</b> – Retrieve data and generate insights with ease.</li>
                <li>✔️ <b>Secure Access</b> – Role-based login ensures only authorized staff handle sensitive data.</li>
            </ul>

            <p>
                Our vision is to create a future where every healthcare decision in Lagos State is backed by
                accurate, timely, and secure health data. With HealthSoft, healthcare professionals can focus
                less on paperwork and more on what truly matters—<b>saving lives and improving patient well-being</b>.
            </p>
        </section>


        <section class="actions">
            <a href="register.php" class="btn">Register New Patient</a>
            <a href="add_visit.php" class="btn">Record Patient Visit</a>
            <a href="view_patients.php" class="btn">View Patients</a>
            <a href="view_visits.php" class="btn">All Visits</a>
        </section>
        <section class="quote card">
            <h3>💡 Daily Health Tip</h3>
            <p><?php echo $random_quote; ?></p>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025 HealthSoft | Lagos State Ministry of Health</p>
    </footer>

</body>

</html>