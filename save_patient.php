<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "health_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date_registered = date("Y-m-d H:i:s");


    $stmt = $conn->prepare("INSERT INTO patients (full_name, dob, gender, phone, address, date_registered) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $full_name, $dob, $gender, $phone, $address, $date_registered);

    if ($stmt->execute()) {

        header("Location: view_patients.php");
        exit;
    } else {
        echo "Error saving patient: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
$conn->close();
