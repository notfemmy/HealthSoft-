<?php
include 'auth.php';

$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE patients SET full_name = ?, dob = ?, gender = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $full_name, $dob, $gender, $phone, $address, $id);



    if ($stmt->execute()) {
        header("Location: view_patients.php");
        exit;
    } else {
        echo "Error updating patient: " . $stmt->error;
    }
}
