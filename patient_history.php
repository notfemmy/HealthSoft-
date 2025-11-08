<?php
include 'auth.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("No patient selected.");
}

$patient_id = intval($_GET['id']);

$patient_sql = "SELECT * FROM patients WHERE id = $patient_id";
$patient_result = $conn->query($patient_sql);

if ($patient_result->num_rows == 0) {
    die("Patient not found.");
}

$patient = $patient_result->fetch_assoc();

$visits_sql = "SELECT * FROM visits WHERE patient_id = $patient_id ORDER BY visit_date DESC";
$visits_result = $conn->query($visits_sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient History - <?php echo htmlspecialchars($patient['full_name']); ?></title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/patient_history.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2>Patient History</h2>

        <div class="patient-info">
            <h3><?php echo htmlspecialchars($patient['full_name']); ?></h3>
            <p><strong>DOB:</strong> <?php echo htmlspecialchars($patient['dob']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient['gender']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($patient['phone']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($patient['address']); ?></p>
            <p><strong>Date Registered:</strong> <?php echo htmlspecialchars($patient['date_registered']); ?></p>
        </div>

        <h3>Visit History</h3>
        <?php if ($visits_result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Symptoms</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                </tr>
                <?php while ($visit = $visits_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($visit['visit_date']); ?></td>
                        <td><?php echo htmlspecialchars($visit['symptoms']); ?></td>
                        <td><?php echo htmlspecialchars($visit['diagnosis']); ?></td>
                        <td><?php echo htmlspecialchars($visit['treatment']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No visit records found.</p>
        <?php endif; ?>

        <br>
        <a href="view_patients.php" class="back-btn">← Back to Patients</a>
    </div>
</body>

</html>
<?php $conn->close(); ?>