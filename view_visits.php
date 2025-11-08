<?php
$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT visits.*, patients.full_name 
        FROM visits 
        JOIN patients ON visits.patient_id = patients.id
        ORDER BY visits.visit_date ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Visit History</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/view_visits.css">
</head>

<body>
    <?php
    include 'navbar.php';
    include 'auth.php';
    ?>

    <h2>All Patient Visits</h2>

    <table>
        <tr>
            <th>Visit ID</th>
            <th>Patient Name</th>
            <th>Visit Date</th>
            <th>Symptoms</th>
            <th>Diagnosis</th>
            <th>Treatment</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['full_name'] ?></td>
                    <td><?= $row['visit_date'] ?></td>
                    <td><?= $row['symptoms'] ?></td>
                    <td><?= $row['diagnosis'] ?></td>
                    <td><?= $row['treatment'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No visits recorded yet.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>

<?php $conn->close(); ?>