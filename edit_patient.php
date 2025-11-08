<?php
include 'auth.php';


$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT  * FROM patients WHERE id = $id");

if ($result->num_rows !== 1) {
    echo "Patients not found.";
    exit;
}
$patient = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Patient</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/editpatient.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h2>Edit Patient Information</h2>

    <form method="POST" action="update_patients.php">
        <input type="hidden" name="id" value="<?= $patient['id']  ?>">

        Full Name:<br>
        <input type="text" name="full_name" value="<?= $patient['full_name'] ?>" required <br><br>

        Date of Birth:<br>
        <input type="date" name="dob" value="<?= $patient['dob'] ?>" required><br><br>

        Gender:<br>
        <select name="gender" required>
            <option value="Male" <?= $patient['gender'] === 'Male'  ? 'select' : '' ?>>Male</option>
            <option value="Female" <?= $patient['gender'] === 'Female'  ? 'select' : '' ?>>Female</option>
        </select><br><br>

        Phone Number:<br>
        <input type="text" name="phone" value="<?= $patient['phone'] ?>" required><br><br>

        Address:<br>
        <textarea name="address" required><?= $patient['address'] ?></textarea><br><br>


        <button type="submit">Update</button>
    </form>


    <br>
    <a href="view_patients.php">← Back to Patient List</a>
</body>

</html>