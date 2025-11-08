<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$patient_id = $_POST['patient_id'];  
$visit_date = $_POST['visit_date'];
$symptoms  = $_POST['symptoms'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];

$sql = "INSERT INTO visits (patient_id, visit_date, symptoms, diagnosis, treatment)
        VALUES ('$patient_id', '$visit_date', '$symptoms', '$diagnosis', '$treatment')";

if ($conn->query($sql) === TRUE) {
    $message = "✅ Visit recorded successfully. Redirecting...";
    $redirect = true;
} else {
    $message = "❌ Error: " . $conn->error;
    $redirect = false;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visit Saved</title>
    <meta charset="UTF-8">
    <?php if ($redirect): ?>
        <meta http-equiv="refresh" content="3;url=view_visits.php">
    <?php endif; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
            background: #f9f9f9;
        }
        .msg {
            font-size: 18px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <p class="msg"><?php echo $message; ?></p>
    <a href="view_visits.php">Go to Visit Records</a>
</body>
</html>
