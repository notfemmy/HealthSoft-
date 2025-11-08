<?php
include 'auth.php';

$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Use prepared statement for safety
    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id);


    if ($stmt->execute()) {
        header("Location: view_patients.php");
        exit;
    } else {
        echo "Error deleting patient: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>