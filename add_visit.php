<?php

$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$patients = $conn->query("SELECT id, full_name FROM patients");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Patient</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/add_visit.css">
   
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php include 'auth.php'; ?>
    <h2>Record Patient Visit</h2>
    <form method="POST" action="save_visit.php">
        <label> Select Patient : </label><br>
        <select name="patient_id" required>
            <option value="">-- Select Patient --</option>
            <?php while ($row = $patients->fetch_assoc()) {
            ?>
                <option value="<?= $row['id'] ?>"><?= $row['full_name'] ?></option>
            <?php } ?>
        </select><br><br>

        <label>Visit Date:</label><br>
        <input type="date" name="visit_date" required><br><br>

        <label>Symptoms:</label><br>
        <textarea name="symptoms" required></textarea><br><br>

        <label>Diagnosis:</label><br>
        <textarea name="diagnosis" required></textarea><br><br>

        <label>Treatment:</label><br>
        <textarea name="treatment" required></textarea><br><br>

        <button type="submit"> Save Visit</button>
    </form>

</body>

</html>

<?php $conn->close(); ?>